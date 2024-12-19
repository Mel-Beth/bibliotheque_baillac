<?php
require_once 'app/models/EmpruntsModel.php';

class RetardsController
{
    public function index()
    {
        $db = new PDO('mysql:host=localhost;dbname=bibliotheque', 'root', '');
        $model = new EmpruntModel($db);
        $retards = $model->getRetards();
        include 'views/retards.php';
    }
}
?>
