<?php
include './config/database.php';

class Scanner {
    private $db;

    // Le constructeur prend l'objet PDO
    public function __construct($pdo) {
        if ($pdo === null) {
            throw new InvalidArgumentException("L'objet PDO ne doit pas être null.");
        }
        $this->db = $pdo;
    }

    // Méthode pour vérifier si un livre existe par son code et récupérer ses détails
    public function checkLivre($qrCode) {
        $query = "SELECT id_exemplaire, isbn,date_emprunt,id_adherent, statut FROM public.historique_transactions WHERE id_exemplaire = :code";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':code', $qrCode, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
