<?php

require_once 'app/models/EmpruntsModel.php';

class RetoursController {
    private $empruntsModel;

    public function __construct($pdo) {
        $this->empruntsModel = new EmpruntsModel($pdo);
    }

    public function index() {
        // Récupération des retours
        $retours = $this->empruntsModel->getRetours();
        include 'app/views/livres/retours.php';
    }
}
