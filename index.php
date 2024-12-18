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
    // $messagesNonLus = $transactionModel->countMessagesNonLus();

    if (isset($_SESSION['role']) && ($_SESSION['role'] === 'responsable' || $_SESSION['role'] === 'responsable_site')) {
        require 'app/models/Employe.php';
        require 'app/controllers/EmployeController.php';
        include 'app/views/accueil_admin.php'; // Page admin
    } else {
        include 'app/views/accueil.php'; // Page d'accueil pour les bibliothécaires
    }
} elseif ($route[0] === 'emprunts') {
    require_once 'app/controllers/EmpruntsController.php';
    $empruntsController = new EmpruntsController($pdo);
    $empruntsController->index();
} elseif ($route[0] === 'scanner') {
    // Gestion du scanner
    require 'app/models/Scanner.php';
    require 'app/controllers/ScannerController.php';
    $scannerModel = new Scanner($pdo);

    if (isset($route[1]) && $route[1] === 'resultat') {
        include 'app/views/scanner/resultat.php';
    } elseif (isset($route[1]) && $route[1] === 'emprunter') {
        include 'app/views/scanner/emprunter.php';
    } else {
        include 'app/views/scanner/scan.php';
    }
} elseif ($route[0] === 'retours') {
    // Gestion des retours
    require_once 'app/controllers/RetoursController.php';
    $retoursController = new RetoursController();
    include 'app/views/livres/retours.php';
} elseif ($route[0] === 'retards') {
    // Gestion des retards
    require_once 'app/controllers/RetardsController.php';
    $retardsController = new RetardsController();
    include 'app/views/livres/retards.php';
// } elseif ($route[0] === 'messages') {
//     // Gestion des messages
//     require_once 'app/models/Message.php';
//     require_once 'app/controllers/MessageController.php';
//     $messageModel = new Message($pdo);
//     $messageController = new MessageController($messageModel);
//     $messageController->afficherMessages();
// } elseif ($route[0] === 'connexion') {
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
