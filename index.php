<?php
// Démarrer la session si nécessaire
session_start();

// Inclure la connexion à la base de données
include 'config/database.php';  // Connexion à la base de données

// Gérer la route demandée
$request_uri = $_SERVER['REQUEST_URI'];

// Inclure l'en-tête commun (header)
include 'app/views/includes/head.php'; // Inclus dans chaque page pour l'en-tête

// Gérer la logique en fonction de la route
switch ($request_uri) {
    case '/':
        // Route d'accueil, afficher la liste des livres
        include 'app/controllers/LivreController.php';
        $livreController = new LivreController();
        $livreController->listLivres();
        break;

    case '/livres/list':
        // Afficher la liste des livres
        include 'app/controllers/LivreController.php';
        $livreController = new LivreController();
        $livreController->listLivres();
        break;

    case '/livres/create':
        // Formulaire pour ajouter un livre
        include 'app/controllers/LivreController.php';
        $livreController = new LivreController();
        $livreController->createLivre();
        break;

    case '/livres/detail':
        // Afficher les détails d'un livre
        include 'app/controllers/LivreController.php';
        $livreController = new LivreController();
        $livreController->detailLivre();
        break;

    case '/exemplaires/create':
        // Ajouter un exemplaire
        include 'app/controllers/ExemplaireController.php';
        $exemplaireController = new ExemplaireController();
        $exemplaireController->createExemplaire();
        break;

    case '/transactions/list':
        // Afficher la liste des transactions (emprunts/retours)
        include 'app/controllers/TransactionController.php';
        $transactionController = new TransactionController();
        $transactionController->listTransactions();
        break;

    case '/transactions/history':
        // Afficher l'historique des transactions
        include 'app/controllers/TransactionController.php';
        $transactionController = new TransactionController();
        $transactionController->historyTransaction();
        break;

    case '/employes/login':
        // Page de connexion des employés
        include 'app/controllers/EmployeController.php';
        $employeController = new EmployeController();
        $employeController->loginEmploye();
        break;

    case '/employes/list':
        // Afficher la liste des employés
        include 'app/controllers/EmployeController.php';
        $employeController = new EmployeController();
        $employeController->listEmployes();
        break;

    default:
        // Si l'URL n'est pas reconnue, afficher une page 404
        echo "Page non trouvée. Erreur 404.";
        break;
}

// Includer le pied de page (footer)
include 'app/views/includes/footer.php';
?>
