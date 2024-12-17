<?php
// Démarrer la session
session_start();

// Inclure les fichiers nécessaires
require_once 'config/database.php'; // Connexion à la base de données

// Vérification globale de connexion
if (!isset($_SESSION['employe_id']) && (!isset($_GET['route']) || $_GET['route'] !== 'connexion')) {
    header('Location: connexion');  // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit;
}

// Récupérer la route
$route = isset($_GET["route"]) ? explode('/', $_GET["route"]) : [''];

// Routeur avec des conditions
if ($route[0] == "" || $route[0] == "accueil") {
    // Vérifier le rôle de l'utilisateur et afficher la page d'accueil appropriée
    if (isset($_SESSION['role']) && ($_SESSION['role'] === 'responsable' || $_SESSION['role'] === 'responsable_site')) {
        // Si l'utilisateur est responsable ou responsable_site, rediriger vers accueil_admin
        require('app/models/Employe.php');
        require('app/controllers/EmployeController.php');

        include 'app/views/accueil_admin.php'; // Page d'accueil des administrateurs
    } else {
        // Pour les autres rôles (bibliothécaires), afficher la page d'accueil classique avec les transactions
        require_once "app/models/Transaction.php";
        require_once "app/controllers/TransactionController.php";

        $transactionModel = new Transaction($pdo);
        $transactionController = new TransactionController($transactionModel);

        // Appeler la méthode afficherStatistiques pour afficher les statistiques classiques
        $transactionController->afficherStatistiques();
    }
} elseif ($route[0] == "accueil_admin") {
    // Vérification stricte pour les admins (responsable ou responsable_site)
    if (isset($_SESSION['role']) && ($_SESSION['role'] === 'responsable' || $_SESSION['role'] === 'responsable_site')) {
        require('app/models/Employe.php');
        require('app/controllers/EmployeController.php');
        include 'app/views/accueil_admin.php'; // Page spécifique aux administrateurs
    } else {
        // Si l'utilisateur n'est pas un administrateur, rediriger vers la page d'accueil classique
        header('Location: accueil');
        exit;
    }
} elseif ($route[0] == "scanner") {
    // Route pour afficher la page scanner
    require_once "app/controllers/ScannerController.php";
    require_once "app/models/Scanner.php";

    $scannerModel = new Scanner($pdo); // Instancier le modèle du scanner
    $scannerController = new ScannerController($scannerModel); // Instancier le contrôleur du scanner

    $scannerController->afficherScanner(); // Afficher la page scanner

} elseif ($route[0] == "livres") {
    // Route pour gérer les livres (afficher, ajouter, créer, etc.)
    require_once "app/controllers/LivreController.php";
    $livreController = new LivreController();

    if (isset($route[1]) && $route[1] == "list") {
        $livreController->listLivres();
    } elseif (isset($route[1]) && $route[1] == "create") {
        $livreController->createLivre();
    } elseif (isset($route[1]) && $route[1] == "detail") {
        $livreController->detailLivre();
    } else {
        include "app/views/404.php"; // Si aucune route spécifique n'est trouvée
    }
} elseif ($route[0] == "connexion") {
    // Route pour gérer la connexion des employés
    require_once "app/models/Employe.php";
    require_once "app/controllers/EmployeController.php";

    $employeModel = new Employe($pdo);
    $employeController = new EmployeController($employeModel);
    $employeController->loginEmploye();
} elseif ($route[0] == "logout") {
    // Route pour gérer la déconnexion
    require_once "app/controllers/LogoutController.php";
    $logoutController = new LogoutController();
    $logoutController->logout();
} else {
    // Page 404 pour les routes non définies
    include "app/views/404.php";
}
