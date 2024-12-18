<?php
require_once 'app/models/EmpruntsModel.php';

class RetoursController
{
    public function index()
    {
        $db = new PDO('mysql:host=localhost;dbname=bibliotheque', 'root', '');
        $model = new EmpruntModel($db);
        $retours = $model->getRetours();
        include 'views/retours.php';
    }
}
?>
