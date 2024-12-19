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

        $employeModel = new Employe($pdo);
        $employeController = new EmployeController($employeModel);

        // Récupérer les employés, bâtiments et étages
        $employes = $employeController->getAllEmployes();
        $batiments = $employeController->getAllBatiments();
        $etages = $employeController->getAllEtages();

        include 'app/views/accueil_admin.php'; // Page admin
    } else {
        include 'app/views/accueil.php'; // Page d'accueil pour les bibliothécaires
    }
} elseif ($route[0] === 'accueil_admin') {
    if (isset($_SESSION['role']) && ($_SESSION['role'] === 'responsable' || $_SESSION['role'] === 'responsable_site')) {
        require 'app/models/Employe.php';
        require 'app/controllers/EmployeController.php';

        $employeModel = new Employe($pdo);
        $employeController = new EmployeController($employeModel);

        // Gestion des actions POST (ajout, suppression, réaffectation)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'add':
                        $employeController->addEmploye($_POST);
                        break;
                    case 'delete':
                        $employeController->deleteEmploye($_POST['id_employe']);
                        break;
                    case 'reassignBatiment':
                        $employeController->reassignBatiment($_POST['id_employe'], $_POST['new_batiment']);
                        break;
                    case 'reassignEtage':
                        $employeController->reassignEtage($_POST['id_employe'], $_POST['new_etage']);
                        break;
                    case 'reassignBatimentEtage':
                        if (isset($_POST['new_batiment'], $_POST['new_etage'])) {
                            $employeController->reassignBatimentEtage($_POST['id_employe'], $_POST['new_batiment'], $_POST['new_etage']);
                        }
                        break;
                }
            }
        }

        // Récupérer les employés, bâtiments et étages
        $employes = $employeController->getAllEmployes();
        $batiments = $employeController->getAllBatiments();
        $etages = $employeController->getAllEtages();

        include 'app/views/accueil_admin.php'; // Inclure la vue admin
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
    $retoursController->index();
} elseif ($route[0] === 'retards') {
    require_once 'app/controllers/RetardsController.php';
    $retardsController = new RetardsController($pdo);
    $retardsController->index();
} elseif ($route[0] === 'scanner') {
    require "app/models/Scanner.php";
    require "app/controllers/ScannerController.php";
    $scannerModel = new Scanner($pdo);

    if (isset($route[1]) || $route == '') {
        switch ($route[1]) {
            case 'resultat':
                include 'app/views/scanner/resultat.php';
                break;
            case 'emprunter':
                include 'app/views/scanner/emprunter.php';
                break;
            case 'ajout_exemplaire':
                include 'app/views/scanner/ajout_exemplaire.php';
                break;
            default:
                include 'views/404.php';
                break;
        }
    } else {
        include 'app/views/scanner/scan.php';
    }
} elseif ($route[0] === 'livres') {
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
    require_once 'app/models/Message.php';
    require_once 'app/controllers/MessageController.php';
    $messageModel = new Message($pdo);
    $messageController = new MessageController($messageModel);
    $messageController->afficherMessages();
} elseif ($route[0] === 'connexion') {
    require_once 'app/models/Employe.php';
    require_once 'app/controllers/EmployeController.php';
    $employeModel = new Employe($pdo);
    $employeController = new EmployeController($employeModel);
    $employeController->loginEmploye();
} elseif ($route[0] === 'logout') {
    require_once 'app/controllers/LogoutController.php';
    $logoutController = new LogoutController();
    $logoutController->logout();
} else {
    include 'app/views/404.php';
}
