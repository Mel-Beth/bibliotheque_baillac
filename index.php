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
switch ($route[0]) {
    
    case "":
    case "accueil":
        // Afficher la page d'accueil après la connexion
        include "app/views/accueil.php"; // Page d'accueil après la connexion
        break;

    case "livres":
        include "app/controllers/LivreController.php";
        $controller = new LivreController();
        if (isset($route[1])) {
            switch ($route[1]) {
                case "list":
                    $controller->listLivres();
                    break;
                case "create":
                    $controller->createLivre();
                    break;
                case "detail":
                    $controller->detailLivre();
                    break;
                default:
                    include "app/views/404.php";
            }
        } else {
            include "app/views/404.php";
        }
        break;

    case "connexion":  // Route pour la page de connexion
        include "app/models/Employe.php";
        include "app/controllers/EmployeController.php";

        // Utiliser la connexion à la base de données existante
        $employeModel = new Employe($pdo);  // Assurez-vous que $pdo est la connexion PDO correcte
        $controller = new EmployeController($employeModel);

        // Afficher la page de connexion
        $controller->loginEmploye();
        break;

    case "employes":
        include "app/models/Employe.php";
        include "app/controllers/EmployeController.php";

        // Utiliser la connexion à la base de données existante
        $employeModel = new Employe($pdo);
        $controller = new EmployeController($employeModel);

        // Traiter les sous-routes pour employes
        if (isset($route[1])) {
            switch ($route[1]) {
                case "login":
                    $controller->loginEmploye();
                    break;
                case "list":
                    // Vérifier si l'utilisateur est connecté et admin
                    if (isset($_SESSION['employe_id']) && $_SESSION['role'] === '1') {
                        $controller->listEmployes();
                    } else {
                        include "app/views/404.php";
                    }
                    break;
                default:
                    include "app/views/404.php";
            }
        } else {
            include "app/views/404.php";
        }
        break;

    case "logout":
        include 'app/controllers/LogoutController.php';
        $logoutController = new LogoutController();
        $logoutController->logout();
        break;

    default:
        include "app/views/404.php";
}

?>
