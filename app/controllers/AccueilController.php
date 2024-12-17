<?php
// Inclure le modèle Transaction (une seule fois)
require_once 'app/models/Transaction.php';

class AccueilController
{
    private $transactionModel;

    public function __construct($transactionModel)
    {
        $this->transactionModel = $transactionModel;
    }

    public function afficherStatistiques()
    {
        // Utiliser les méthodes du modèle Transaction pour obtenir les statistiques
        $totalTransactions = $this->transactionModel->countEmprunts() + $this->transactionModel->countRetours() + $this->transactionModel->countTransits();
        $empruntsEnCours = $this->transactionModel->countEmprunts();
        $retoursEffectues = $this->transactionModel->countRetours();
        $totalLivres = $this->transactionModel->countLivres();

        // Transmettre les données à la vue
        include "app/views/accueil.php";
    }
}
?>
