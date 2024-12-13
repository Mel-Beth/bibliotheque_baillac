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
if ($request_uri == '/') {
    // Route d'accueil, afficher la liste des livres
    include 'app/controllers/LivreController.php';
    $livreController = new LivreController();
    $livreController->listLivres();
} elseif ($request_uri == '/livres/list') {
    // Afficher la liste des livres
    include 'app/controllers/LivreController.php';
    $livreController = new LivreController();
    $livreController->listLivres();
} elseif ($request_uri == '/livres/create') {
    // Formulaire pour ajouter un livre
    include 'app/controllers/LivreController.php';
    $livreController = new LivreController();
    $livreController->createLivre();
} elseif ($request_uri == '/livres/detail') {
    // Afficher les détails d'un livre
    include 'app/controllers/LivreController.php';
    $livreController = new LivreController();
    $livreController->detailLivre();
} elseif ($request_uri == '/exemplaires/create') {
    // Ajouter un exemplaire
    include 'app/controllers/ExemplaireController.php';
    $exemplaireController = new ExemplaireController();
    $exemplaireController->createExemplaire();
} elseif ($request_uri == '/transactions/list') {
    // Afficher la liste des transactions (emprunts/retours)
    include 'app/controllers/TransactionController.php';
    $transactionController = new TransactionController();
    $transactionController->listTransactions();
} elseif ($request_uri == '/transactions/history') {
    // Afficher l'historique des transactions
    include 'app/controllers/TransactionController.php';
    $transactionController = new TransactionController();
    $transactionController->historyTransaction();
} elseif ($request_uri == '/employes/login') {
    // Page de connexion des employés
    include 'app/controllers/EmployeController.php';
    $employeController = new EmployeController();
    $employeController->loginEmploye();
} elseif ($request_uri == '/employes/list') {
    // Afficher la liste des employés
    include 'app/controllers/EmployeController.php';
    $employeController = new EmployeController();
    $employeController->listEmployes();
} else {
    // Si l'URL n'est pas reconnue, afficher une page 404
    echo "Page non trouvée. Erreur 404.";
}

// Includer le pied de page (footer)
include 'app/views/includes/footer.php';
?>
