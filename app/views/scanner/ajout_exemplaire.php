<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('includes/head.html'); ?>
</head>

<body class="emprunter-page">
<div class="fixed-button">
    <button><a href="scanner">< Retour</a></button>
</div>
<?php
$scannerModel = new Scanner($pdo);
$scannerController = new ScannerController($scannerModel); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['qrCode']) && !empty($_POST['qrCode'])) {
        $qrCode = $_POST['qrCode'];

        // Récupération de toutes les variables du formulaire
        $etat = $_POST['etat'] ?? null;
        $isbn = $_POST['isbn'] ?? null;
        $titre = $_POST['titre'] ?? null;
        $genre = $_POST['genre'] ?? null;
        $auteur = $_POST['auteur'] ?? null;
        $editeur = $_POST['editeur'] ?? null;
        $nombre_de_pages = $_POST['nombre_de_pages'] ?? null;
        $annee_publication = $_POST['annee_publication'] ?? null;
        $resume = $_POST['resume'] ?? null;
        $langue = $_POST['langue'] ?? null;
        $chemin_img = '';

        // Appel de la méthode ajoutExemplaire avec toutes les variables
        if (isset($etat) && isset($isbn) && isset($qrCode) && isset($titre) && isset($genre) && isset($auteur) && isset($editeur) && isset($nombre_de_pages) && isset($annee_publication) && isset($resume) && isset($langue)) {
            // Appel de la méthode ajoutExemplaire avec tous les paramètres requis
            $message = $scannerController->ajoutExemplaire($qrCode, $etat, $isbn, $titre, $genre, $auteur, $editeur, $nombre_de_pages, $annee_publication, $resume, $langue, $chemin_img); 
            echo "<p>" . htmlspecialchars($message) . "</p>"; // Sécurisation de l'affichage
        } else {
            echo "<p>Veuillez remplir tous les champs requis.</p>"; // Message d'erreur si des champs sont manquants
        }
    }
}
?>

<form method='post' action=''>
    <input type='hidden' name='qrCode' value="<?= htmlspecialchars($qrCode ?? '') ?>">
    <input type='text' name='isbn' placeholder="Entrez ISBN" required>
    <input type='text' name='titre' placeholder="Titre" required>
    <input type='text' name='genre' placeholder="Genre">
    <input type='text' name='auteur' placeholder="Auteur">
    <input type='text' name='editeur' placeholder="Editeur">
    
    <input type="number" name="nombre_de_pages" placeholder="Nombre de pages">
    <input type="number" name="annee_publication" placeholder="Année publication">

    <textarea id="resume" name="resume" placeholder="Résumé"></textarea>
    
    <select name="etat">
        <option value="Bon état">Bon état</option>
        <option value="État moyen">État moyen</option>
        <option value="Mauvais état">Mauvais état</option>
    </select>
    
    <select name="langue">
        <option value="Français">Français</option>
        <option value="Anglais">Anglais</option>
        <option value="Espagnol">Espagnol</option>
        <option value="Allemand">Allemand</option>
        <option value="Italien">Italien</option>
    </select>
    
    <button type='submit'>Ajouter</button>
</form>

</body>
</html>