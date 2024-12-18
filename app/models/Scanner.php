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
}