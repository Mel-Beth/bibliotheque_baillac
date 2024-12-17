<?php

class Transaction {
    private $db;

    // Le constructeur prend l'objet PDO
    public function __construct($database) {
        $this->db = $database;
    }

    // Compter les emprunts en cours
    public function countEmprunts() {
        $query = "SELECT COUNT(*) as total FROM public.historique_transactions WHERE date_retour > NOW()";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Compter les livres retournés
    public function countRetours() {
        $query = "SELECT COUNT(*) as total FROM public.historique_transactions WHERE date_retour <= NOW()";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    // Compter les livres en transit
    public function countLivresEnTransit() {
        $query = "SELECT COUNT(*) AS total FROM public.historique_transactions ht
                  JOIN public.exemplaires e ON ht.id_exemplaire = e.id_exemplaire
                  WHERE e.etat = 'En transit'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0; // Retourne 0 si aucun résultat
    }

    // Compter le total des transactions
    public function countTotalTransactions() {
        $query = "SELECT COUNT(*) AS total FROM public.historique_transactions";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0; // Retourne 0 si aucune transaction
    }

    // Compter le total des livres disponibles
    public function countTotalLivres() {
        $query = "SELECT COUNT(*) AS total FROM public.exemplaires";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0; // Retourne 0 si aucun livre
    }
}
?>
