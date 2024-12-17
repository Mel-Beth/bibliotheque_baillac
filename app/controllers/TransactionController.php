<?php
// app/controllers/TransactionController.php

class TransactionController {
    private $transactionModel;

    // Le constructeur reçoit une instance du modèle Transaction
    public function __construct($transactionModel) {
        $this->transactionModel = $transactionModel;
    }

    // Méthode pour afficher les statistiques
    public function afficherStatistiques() {
        // Par exemple, récupérons des données du modèle et les affichons
        $transactions = $this->transactionModel->getAllTransactions(); // Méthode à définir dans le modèle Transaction
        include 'app/views/statistiques.php'; // Vue qui affichera les statistiques
    }
}
?>
