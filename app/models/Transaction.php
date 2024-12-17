<?php
// app/models/Transaction.php

class Transaction {
    private $pdo;

    // Le constructeur reçoit la connexion à la base de données
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour récupérer toutes les transactions depuis la table historique_transactions
    public function getAllTransactions() {
        $stmt = $this->pdo->prepare("SELECT * FROM historique_transactions");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
