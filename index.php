<?php
// Démarrer la session
session_start();

// Inclure les fichiers nécessaires
require_once 'config/database.php'; // Connexion à la base de données

// Vérification globale de connexion
if (!isset($_SESSION['employe_id']) && (!isset($_GET['route']) || $_GET['route'] !== 'connexion')) {
    header('Location: connexion');
    exit;
}

// Instancier les contrôleurs nécessaires
require_once "app/models/Transaction.php";
require_once "app/controllers/TransactionController.php";

$transactionModel = new Transaction($pdo);
$transactionController = new TransactionController($transactionModel);

// Récupérer la route
$route = isset($_GET["route"]) ? explode('/', $_GET["route"]) : [''];

// Routeur avec des conditions
if ($route[0] == "" || $route[0] == "accueil") {
    // Redirection en fonction du rôle de l'utilisateur après connexion
    if (isset($_SESSION['role']) && ($_SESSION['role'] === 'responsable' || $_SESSION['role'] === 'responsable_site')) {
        header('Location: accueil_admin'); // Rediriger vers accueil_admin.php
        exit;
    }
    // Page d'accueil classique
    $transactionController->afficherStatistiques();

} elseif ($route[0] == "accueil_admin") {
    // Vérification stricte pour les admins
    if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'responsable' && $_SESSION['role'] !== 'responsable_site')) {
        header('Location: accueil');
        exit;
    }
    // Afficher la page d'accueil admin
    include 'app/views/accueil_admin.php'; // Afficher la vue spécifique aux administrateurs

} elseif ($route[0] == "scanner") {
    // Route pour afficher la page scanner
    require_once "app/controllers/ScannerController.php";  // Inclure le contrôleur du scanner
    require_once "app/models/Scanner.php";  // Inclure le modèle du scanner

    $scannerModel = new Scanner($pdo); // Instancier le modèle du scanner
    $scannerController = new ScannerController($scannerModel); // Instancier le contrôleur du scanner

    $scannerController->afficherScanner(); // Afficher la page scanner

} elseif ($route[0] == "livres") {
    require_once "app/controllers/LivreController.php";
    $livreController = new LivreController();
    if (isset($route[1]) && $route[1] == "list") {
        $livreController->listLivres();
    } elseif (isset($route[1]) && $route[1] == "create") {
        $livreController->createLivre();
    } elseif (isset($route[1]) && $route[1] == "detail") {
        $livreController->detailLivre();
    } else {
        include "app/views/404.php";
    }

} elseif ($route[0] == "connexion") {
    require_once "app/models/Employe.php";
    require_once "app/controllers/EmployeController.php";

    $employeModel = new Employe($pdo);
    $employeController = new EmployeController($employeModel);
    $employeController->loginEmploye();

} elseif ($route[0] == "logout") {
    require_once "app/controllers/LogoutController.php";
    $logoutController = new LogoutController();
    $logoutController->logout();

} else {
    // Page 404
    include "app/views/404.php";
}
?>