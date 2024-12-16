<?php
// Démarrer la session
session_start();

// Inclure les fichiers nécessaires
require 'config/database.php'; // Connexion à la base de données

// Vérification de la connexion pour accéder aux pages protégées
if (!isset($_SESSION['employe_id']) && (!isset($_GET['route']) || $_GET['route'] !== 'employes/login' && $_GET['route'] !== 'connexion')) {
    header('Location: index.php?route=connexion'); // Rediriger vers la page de connexion si non connecté
    exit;
}

// Récupérer la route
$route = isset($_GET["route"]) ? explode('/', $_GET["route"]) : [''];

// Routeur avec des conditions
if ($route[0] == "" || $route[0] == "accueil") {
    // Afficher la page d'accueil après la connexion
    include "app/models/Transaction.php";
    include "app/controllers/AccueilController.php";

    $transactionModel = new Transaction($pdo);
    $controller = new AccueilController($transactionModel);
    $controller->index();

} elseif ($route[0] == "livres") {
    include "app/controllers/LivreController.php";
    $controller = new LivreController();

    if (isset($route[1]) && $route[1] == "list") {
        $controller->listLivres();
    } elseif (isset($route[1]) && $route[1] == "create") {
        $controller->createLivre();
    } elseif (isset($route[1]) && $route[1] == "detail") {
        $controller->detailLivre();
    } else {
        include "app/views/404.php";
    }

} elseif ($route[0] == "connexion") {
    // Route pour la connexion
    include "app/models/Employe.php";
    include "app/controllers/EmployeController.php";

    $employeModel = new Employe($pdo);
    $controller = new EmployeController($employeModel);
    $controller->loginEmploye();

} elseif ($route[0] == "employes") {
    include "app/models/Employe.php";
    include "app/controllers/EmployeController.php";
} elseif ($route[0] == "employes") {
    include "app/models/Employe.php";
    include "app/controllers/EmployeController.php";

    $employeModel = new Employe($pdo);
    $controller = new EmployeController($employeModel);

    if (isset($route[1]) && $route[1] == "login") {
        $controller->loginEmploye();
    } elseif (isset($route[1]) && $route[1] == "list") {
        if (isset($_SESSION['employe_id']) && $_SESSION['role'] === '1') {
            $controller->listEmployes();
        } else {
            include "app/views/404.php";
        }
    } else {
        include "app/views/404.php";
    }

} elseif ($route[0] == "scanner") {
    include "app/controllers/ScannerController.php";
    $scannerController = new ScannerController();
    $scannerController->scanner();

} elseif ($route[0] == "logout") {
    include "app/controllers/LogoutController.php";
    $logoutController = new LogoutController();
    $logoutController->logout();

} else {
    // Si la route ne correspond à rien
    include "app/views/404.php";
}
