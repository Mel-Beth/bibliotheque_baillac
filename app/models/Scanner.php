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

    public function updateOrAddTransaction($exemplaireId, $adherentId, $dateRetour) {
        // Vérifier si le livre est déjà emprunté
        $query = "SELECT id_transaction FROM historique_transactions WHERE id_exemplaire = :exemplaire_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':exemplaire_id', $exemplaireId, PDO::PARAM_INT);
        $stmt->execute();
        $idTransaction = $stmt->fetchColumn();

        if ($idTransaction) {
            // Mettre à jour l'emprunt avec le nouvel adhérent
            $query = "UPDATE historique_transactions
                      SET id_adherent = :adherent_id, date_retour = :date_retour 
                      WHERE id_exemplaire = :exemplaire_id";
        } else {
            // Ajouter une nouvelle entrée dans l'historique des transactions
            $query = "INSERT INTO historique_transactions 
                      (id_exemplaire, id_adherent, date_emprunt, date_retour)
                      VALUES (:exemplaire_id, :adherent_id, NOW(), :date_retour)";
        }

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':exemplaire_id', $exemplaireId, PDO::PARAM_INT);
        $stmt->bindParam(':adherent_id', $adherentId, PDO::PARAM_INT);
        $stmt->bindParam(':date_retour', $dateRetour, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount();
    }
    public function retournerLivre($exemplaireId) {
        $query = "UPDATE historique_transactions 
                  SET date_retour = NOW()
                  WHERE id_exemplaire = :exemplaire_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':exemplaire_id', $exemplaireId, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->rowCount();
    }
    public function renouvelerEmprunt($exemplaireId, $ajoutDateRetour) {
        $query = "UPDATE historique_transactions 
                  SET date_retour = :ajoutDateRetour 
                  WHERE id_exemplaire = :exemplaire_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':exemplaire_id', $exemplaireId, PDO::PARAM_INT);
        $stmt->bindParam(':ajoutDateRetour', $ajoutDateRetour, PDO::PARAM_STR);

        $stmt->execute();
    
        return $stmt->rowCount();
    }
    
}