<?php
// Inclure le modèle Livre
require_once 'app/models/Livre.php';

class LivreController {

    private $livreModel;

    public function __construct() {
        // Créer une instance du modèle Livre
        $this->livreModel = new Livre();
    }

    // Méthode pour afficher la liste des livres
    public function listLivres() {
        // Récupérer tous les livres via le modèle
        $livres = $this->livreModel->getAllLivres();
        
        // Inclure la vue pour afficher la liste des livres
        include 'app/views/livres/list.php';
    }

    // Méthode pour afficher le formulaire de création de livre
    public function createLivre() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer les données du formulaire
            $title = $_POST['title'];
            $author = $_POST['author'];
            $year = $_POST['year'];
            
            // Appeler le modèle pour insérer le livre
            $this->livreModel->createLivre($title, $author, $year);
            
            // Rediriger après la création
            header('Location: /livres/list');
            exit;
        }
        
        // Inclure la vue pour afficher le formulaire de création
        include 'app/views/livres/create.php';
    }

    // Méthode pour afficher les détails d'un livre
    public function detailLivre() {
        // Récupérer l'ID du livre
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        // Récupérer les détails du livre
        $livre = $this->livreModel->getLivreById($id);

        if ($livre) {
            // Inclure la vue pour afficher les détails du livre
            include 'app/views/livres/detail.php';
        } else {
            // Si le livre n'existe pas, afficher une erreur
            include 'app/views/404.php';
        }
    }
}
?>
