<?php
include './config/database.php';

class Scanner {
    private $db;
    
    public function __construct($pdo) {
        if ($pdo === null) {
            throw new InvalidArgumentException("L'objet PDO ne doit pas être null.");
        }
        $this->db = $pdo;
    }

    public function checkLivre($qrCode) {
        $query = "SELECT 
        ht.id_transaction as id_transaction,
        em.nom AS nom_employe, 
        em.prenom AS prenom_employe, 
        e.id_exemplaire, 
        e.etat, 
        e.isbn,
        ht.date_emprunt,
        ht.date_retour, 
        ad.nom as nom_adherent,
        ad.prenom as prenom_adherent
        FROM exemplaires e
        LEFT JOIN public.historique_transactions ht ON e.id_exemplaire = ht.id_exemplaire
        LEFT JOIN public.employes em ON ht.id_employe = em.id_employe
        LEFT JOIN public.adherents ad ON ht.id_adherent = ad.id_adherent
        
        WHERE e.id_exemplaire = :code";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':code', $qrCode, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function checkAdherent($adherentId) {
        $query = "SELECT COUNT(*) FROM adherents WHERE id_adherent = :adherent_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':adherent_id', $adherentId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function updateOrAddTransaction($exemplaireId, $adherentId, $dateRetour, $id_employe) {
        
        $query = "SELECT id_transaction FROM historique_transactions WHERE id_exemplaire = :exemplaire_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':exemplaire_id', $exemplaireId, PDO::PARAM_INT);
        $stmt->execute();
        $idTransaction = $stmt->fetchColumn();

        if ($idTransaction) {
            // Mettre à jour l'emprunt avec le nouvel adhérent
            $query = "UPDATE historique_transactions
                      SET id_adherent = :adherent_id, 
                      date_retour = :date_retour,
                      id_employe = :id_employe
                      WHERE id_exemplaire = :exemplaire_id";
        } else {
            // Ajouter une nouvelle entrée dans l'historique des transactions
            $query = "INSERT INTO historique_transactions 
                      (id_exemplaire, id_adherent, date_emprunt, date_retour, id_employe)
                      VALUES (:exemplaire_id, :adherent_id, NOW(), :date_retour, :id_employe)";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':exemplaire_id', $exemplaireId, PDO::PARAM_INT);
        $stmt->bindParam(':adherent_id', $adherentId, PDO::PARAM_INT);
        $stmt->bindParam(':date_retour', $dateRetour, PDO::PARAM_STR);
        $stmt->bindParam(':id_employe', $id_employe, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }
    public function retournerLivre($exemplaireId, $id_employe) {
        $query = "UPDATE historique_transactions 
                  SET date_retour = NOW(),
                  id_employe = :id_employe

                  WHERE id_exemplaire = :exemplaire_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':exemplaire_id', $exemplaireId, PDO::PARAM_INT);
        $stmt->bindParam(':id_employe', $id_employe, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->rowCount();
    }
    public function renouvelerEmprunt($exemplaireId, $ajoutDateRetour, $id_employe) {
        $query = "UPDATE historique_transactions 
                  SET date_retour = :ajoutDateRetour,
                  id_employe = :id_employe
                  WHERE id_exemplaire = :exemplaire_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':exemplaire_id', $exemplaireId, PDO::PARAM_INT);
        $stmt->bindParam(':ajoutDateRetour', $ajoutDateRetour, PDO::PARAM_STR);
        $stmt->bindParam(':id_employe', $id_employe, PDO::PARAM_INT);

        $stmt->execute();
    
        return $stmt->rowCount();
    }
    public function ajouterLivreEtExemplaire($isbn, $annee_publication, $resume, $nombre_de_pages, $langue, $chemin_img, $qrCode, $etat, $titre, $genre, $auteur, $editeur) {
        try {
            // Démarre une transaction
            $this->db->beginTransaction();
    
            // Ajout du livre dans la table livres
            $queryLivre = "INSERT INTO livres (isbn, annee_publication, resume, nombre_de_pages, langue, chemin_img, titre, genre, auteur, editeur) 
                           VALUES (:isbn, :annee_publication, :resume, :nombre_de_pages, :langue, :chemin_img, :titre, :genre, :auteur, :editeur)";
            $stmtLivre = $this->db->prepare($queryLivre);
            $stmtLivre->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            $stmtLivre->bindParam(':annee_publication', $annee_publication, PDO::PARAM_INT);
            $stmtLivre->bindParam(':resume', $resume, PDO::PARAM_STR);
            $stmtLivre->bindParam(':nombre_de_pages', $nombre_de_pages, PDO::PARAM_INT);
            $stmtLivre->bindParam(':langue', $langue, PDO::PARAM_STR);
            $stmtLivre->bindParam(':chemin_img', $chemin_img, PDO::PARAM_STR);
            $stmtLivre->bindParam(':titre', $titre, PDO::PARAM_STR);
            $stmtLivre->bindParam(':genre', $genre, PDO::PARAM_STR);
            $stmtLivre->bindParam(':auteur', $auteur, PDO::PARAM_STR);
            $stmtLivre->bindParam(':editeur', $editeur, PDO::PARAM_STR);
            $stmtLivre->execute();
    
            // Ajout de l'exemplaire dans la table exemplaires
            $queryExemplaire = "INSERT INTO exemplaires (id_exemplaire, etat, isbn) VALUES (:qr_code, :etat, :isbn)";
            $stmtExemplaire = $this->db->prepare($queryExemplaire);
            $stmtExemplaire->bindParam(':qr_code', $qrCode, PDO::PARAM_STR);
            $stmtExemplaire->bindParam(':etat', $etat, PDO::PARAM_STR);
            $stmtExemplaire->bindParam(':isbn', $isbn, PDO::PARAM_STR);
            
            $stmtExemplaire->execute();
    
            // Valide la transaction
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            // En cas d'erreur, annule la transaction
            $this->db->rollBack();
            throw $e;
        }
    }
    
}