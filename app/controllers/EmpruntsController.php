<?php
require_once 'app/models/EmpruntsModel.php';

class EmpruntsController {
    private $empruntsModel;

    public function __construct($db) {
        $this->empruntsModel = new EmpruntsModel($db);
    }

    public function index() {
        $filtre = $_GET['filtre'] ?? ''; // Récupérer le filtre depuis l'URL
        $prenomEmploye = $_SESSION['employe_prenom'] ?? ''; // Nom de l'employé connecté

        // Appliquer le filtre ou afficher tous les emprunts par défaut
        if ($filtre === 'emprunts') {
            $emprunts = $this->empruntsModel->getEmpruntsByEmploye($prenomEmploye);
        } elseif ($filtre === 'transit') {
            $emprunts = $this->empruntsModel->getEmpruntsNotByEmploye($prenomEmploye);
        } else {
            // Par défaut, on affiche tous les emprunts
            $emprunts = $this->empruntsModel->getAllEmprunts();
        }

        include 'app/views/livres/emprunts.php'; // Charger la vue
    }
}
