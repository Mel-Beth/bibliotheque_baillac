<?php
// Démarrer la session
session_start();

// Inclure les fichiers nécessaires
require('config/database.php'); // Connexion à la base de données

// Vérification de la connexion pour accéder aux pages protégées
if (!isset($_SESSION['employe_id']) && (!isset($_GET['route']) || $_GET['route'] !== 'employes/login' && $_GET['route'] !== 'connexion')) {
    header('Location: index.php?route=connexion');  // Rediriger vers la page de connexion si non connecté
    exit;
}

// Récupérer la route
$route = isset($_GET["route"]) ? explode('/', $_GET["route"]) : [''];

// Routeur
if ($route[0] == "" || $route[0] == "accueil") {
    // Afficher la page d'accueil après la connexion
    include "app/views/accueil.php"; // Page d'accueil après la connexion

} elseif ($route[0] == "livres") {
    include "app/controllers/LivreController.php";
    $controller = new LivreController();
    if (isset($route[1])) {
        if ($route[1] == "list") {
            $controller->listLivres();
        } elseif ($route[1] == "create") {
            $controller->createLivre();
        } elseif ($route[1] == "detail") {
            $controller->detailLivre();
        } else {
            include "app/views/404.php";
        }
    } else {
        include "app/views/404.php";
    }

} elseif ($route[0] == "connexion") {  // Route pour la page de connexion
    include "app/models/Employe.php";
    include "app/controllers/EmployeController.php";

    // Utiliser la connexion à la base de données existante
    $employeModel = new Employe($pdo);  // Assurez-vous que $pdo est la connexion PDO correcte
    $controller = new EmployeController($employeModel);

    // Afficher la page de connexion
    $controller->loginEmploye();

} elseif ($route[0] == "employes") {
    include "app/models/Employe.php";
    include "app/controllers/EmployeController.php";

    // Utiliser la connexion à la base de données existante
    $employeModel = new Employe($pdo);
    $controller = new EmployeController($employeModel);

    // Traiter les sous-routes pour employes
    if (isset($route[1])) {
        if ($route[1] == "login") {
            $controller->loginEmploye();
        } elseif ($route[1] == "list") {
            // Vérifier si l'utilisateur est connecté et admin
            if (isset($_SESSION['employe_id']) && $_SESSION['role'] === '1') {
                $controller->listEmployes();
            } else {
                include "app/views/404.php";
            }
        } else {
            include "app/views/404.php";
        }
    } else {
        include "app/views/404.php";
    }

} elseif ($route[0] == "logout") {
    include 'app/controllers/Logout.php';
    $logoutController = new LogoutController();
    $logoutController->logout();

} else {
    include "app/views/404.php";
}

?>