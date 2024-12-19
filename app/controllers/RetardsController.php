<?php

require_once 'app/models/EmpruntsModel.php';

class RetardsController {
    private $empruntsModel;

    public function __construct($pdo) {
        $this->empruntsModel = new EmpruntsModel($pdo);
    }

    public function index() {
        // Récupération des retards
        $retards = $this->empruntsModel->getRetards();
        include 'app/views/livres/retards.php';
    }
}
