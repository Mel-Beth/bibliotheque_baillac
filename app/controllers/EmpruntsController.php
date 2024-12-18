<?php
require_once 'app/models/EmpruntsModel.php';

class EmpruntsController
{
    private $empruntsModel;

    public function __construct($pdo)
    {
        $this->empruntsModel = new EmpruntsModel($pdo);
    }

    // Méthode pour afficher les emprunts en cours
    public function index()
    {
        $emprunts = $this->empruntsModel->getEmpruntsEnCours();
        include 'app/views/livres/emprunts.php';
    }
}
