<?php
// Démarrer la session
session_start();

// Inclure les fichiers nécessaires
require_once 'config/database.php'; // Connexion à la base de données

// Vérification de la connexion pour accéder aux pages protégées
if (!isset($_SESSION['employe_id']) && (!isset($_GET['route']) || $_GET['route'] !== 'employes/login' && $_GET['route'] !== 'connexion')) {
    header('Location: connexion');  // Rediriger vers la page de connexion si non connecté
    exit;
}

// Récupérer la route
$route = isset($_GET["route"]) ? explode('/', $_GET["route"]) : [''];

// Routeur avec des conditions
if ($route[0] == "" || $route[0] == "accueil") {
    // Si l'utilisateur est un administrateur (responsable ou responsable_site), on le redirige vers accueil_admin
    if (isset($_SESSION['role']) && ($_SESSION['role'] === 'responsable' || $_SESSION['role'] === 'responsable_site')) {
        header('Location: accueil_admin'); // Rediriger vers la page d'accueil admin
        exit;
    }

    // Si ce n'est pas un admin, afficher la page d'accueil classique
    require_once "app/models/Transaction.php"; // Assure-toi d'inclure le modèle Transaction une seule fois
    require_once "app/controllers/AccueilController.php";

    $transactionModel = new Transaction($pdo); // Utilise l'objet $pdo pour la base de données
    $controller = new AccueilController($transactionModel);
    $controller->afficherStatistiques();

} elseif ($route[0] == "accueil_admin") {
    // Afficher la page d'accueil spécifique aux administrateurs
    require_once "app/views/accueil_admin.php";  // La page d'accueil des administrateurs

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

    $employeModel = new Employe($pdo);  // Assurez-vous que $pdo est la connexion PDO correcte
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
    include "app/models/Scanner.php";
    include "app/controllers/ScannerController.php";
    // $scannerController = new ScannerController();
    // $scannerController->scanner();


} elseif ($route[0] == "logout") {
    include "app/controllers/LogoutController.php";
    $logoutController = new LogoutController();
    $logoutController->logout();

} else {
    // Si la route ne correspond à rien
    include "app/views/404.php";
}


?>
