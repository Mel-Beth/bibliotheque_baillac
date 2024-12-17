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

    public function afficherStatistiques() {
        $empruntsEnCours = $this->transactionModel->countEmprunts();
        $retoursEffectues = $this->transactionModel->countRetours();
        $livresEnTransit = $this->transactionModel->countLivresEnTransit();
        $totalLivres = $this->transactionModel->countTotalLivres();
    
        include 'app/views/accueil'; // Inclure la vue d'accueil
    }
    
    }

?>
