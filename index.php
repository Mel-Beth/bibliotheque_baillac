<?php
// Démarrer la session
session_start();

// Inclure les fichiers nécessaires
require_once 'config/database.php'; // Connexion à la base de données
require_once 'app/models/Transaction.php'; // Inclure le modèle Transaction

// Vérification globale de connexion
if (!isset($_SESSION['employe_id']) && (!isset($_GET['route']) || $_GET['route'] !== 'connexion')) {
    header('Location: connexion');
    exit;
}

// Récupérer la route depuis l'URL
$route = isset($_GET['route']) ? explode('/', $_GET['route']) : [''];

// Routeur principal avec des if imbriqués
if ($route[0] === '' || $route[0] === 'accueil') {
    // Accueil : vérifier le rôle pour afficher la bonne page
    $transactionModel = new Transaction($pdo);

    // Récupérer les statistiques pour l'accueil
    $empruntsEnCours = $transactionModel->countEmprunts();
    $retoursEffectues = $transactionModel->countRetours();
    $livresEnRetard = $transactionModel->countLivresEnRetard();

    if (isset($_SESSION['role']) && ($_SESSION['role'] === 'responsable' || $_SESSION['role'] === 'responsable_site')) {
        require 'app/models/Employe.php';
        require 'app/controllers/EmployeController.php';
        include 'app/views/accueil_admin.php'; // Page admin
    } else {
        include 'app/views/accueil.php'; // Page d'accueil pour les bibliothécaires
    }
} elseif ($route[0] === 'accueil_admin') {
    // Page spécifique pour les administrateurs
    if (isset($_SESSION['role']) && ($_SESSION['role'] === 'responsable' || $_SESSION['role'] === 'responsable_site')) {
        require 'app/models/Employe.php';
        require 'app/controllers/EmployeController.php';
        include 'app/views/accueil_admin.php';
    } else {
        header('Location: accueil');
        exit;
    }
} elseif ($route[0] === 'emprunts') {
    require_once 'app/controllers/EmpruntsController.php';
    $empruntsController = new EmpruntsController($pdo);
    $empruntsController->index();
} elseif ($route[0] === 'retours') {
    require_once 'app/controllers/RetoursController.php';
    $retoursController = new RetoursController($pdo);
    $retoursController->index(); // Modification : appeler le contrôleur pour afficher les retours
} elseif ($route[0] === 'retards') {
    require_once 'app/controllers/RetardsController.php';
    $retardsController = new RetardsController($pdo);
    $retardsController->index(); // Modification : appeler le contrôleur pour afficher les retards
} elseif ($route[0] == 'scanner') {
    require "app/models/Scanner.php";
    require "app/controllers/ScannerController.php";
    $scannerModel = new Scanner($pdo); // Instancier le modèle du scanner
    // $scannerController = new ScannerController($scannerModel); // Instancier le contrôleur du scanner

    if (isset($route[1]) || $route == '') {
        switch ($route[1]) {

            case 'resultat':
                include 'app/views/scanner/resultat.php';
                break;
            case 'emprunter':
                include 'app/views/scanner/emprunter.php';
                break;
            default:
                include 'views/404.php';
                break;
        }
    } else {
        include 'app/views/scanner/scan.php';
    }
} elseif ($route[0] === 'livres') {
    // Gestion des livres
    require_once 'app/controllers/LivreController.php';
    $livreController = new LivreController();

    if (isset($route[1]) && $route[1] === 'list') {
        $livreController->listLivres();
    } elseif ($route[1] === 'create') {
        $livreController->createLivre();
    } elseif ($route[1] === 'detail') {
        $livreController->detailLivre();
    } else {
        include 'app/views/404.php';
    }
} elseif ($route[0] === 'messages') {
    // Gestion des messages
    require_once 'app/models/Message.php';
    require_once 'app/controllers/MessageController.php';
    $messageModel = new Message($pdo);
    $messageController = new MessageController($messageModel);
    $messageController->afficherMessages();
} elseif ($route[0] === 'connexion') {
    // Connexion
    require_once 'app/models/Employe.php';
    require_once 'app/controllers/EmployeController.php';
    $employeModel = new Employe($pdo);
    $employeController = new EmployeController($employeModel);
    $employeController->loginEmploye();
} elseif ($route[0] === 'logout') {
    // Déconnexion
    require_once 'app/controllers/LogoutController.php';
    $logoutController = new LogoutController();
    $logoutController->logout();
} else {
    // Page 404 pour les routes non reconnues
    include 'app/views/404.php';
}
