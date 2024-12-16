<?php

class AccueilController
{
    private $transactionModel;

    public function __construct($transactionModel)
    {
        $this->transactionModel = $transactionModel;

        // Vérifier si la session est déjà démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {
        // Récupérer les chiffres globaux de la bibliothèque
        $totalEmprunts = $this->transactionModel->countEmprunts();
        $totalRetours = $this->transactionModel->countRetours();
        $totalTransits = $this->transactionModel->countTransits();
        $totalLivres = $this->transactionModel->countLivres();

        // Charger la vue avec les données
        include 'app/views/accueil.php';
    }
}
?>
