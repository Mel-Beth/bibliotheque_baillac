<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('includes/head.html'); ?>
</head>

<body class="emprunter-page">
<div class="fixed-button">
    <button ><a href="scanner">< Retour</a></button>
</div>
<?php
$scannerModel = new Scanner($pdo);
$scannerController = new ScannerController($scannerModel); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['qrCode']) && !empty($_POST['qrCode'])) {
        $qrCode = $_POST['qrCode'];

        if (isset($_POST['etat']) && isset($_POST['isbn'])) {
            $etat = $_POST['etat'];
            $isbn = $_POST['isbn'];
            $message = $scannerController->ajoutExemplaire($qrCode, $etat, $isbn); 
            echo "<p>" . $message . "</p>";
        }
    }
}
?>

<form method='post' action=''>
    
    <input type='hidden' name='qrCode' value="<?= $qrCode ?>">
    <input type='text' name='isbn' placeholder="Entrez ISBN" required>
    
    <select name="etat">
        <option value="Bon état">Bon état</option>
        <option value="État moyen">État moyen</option>
        <option value="Mauvais état">Mauvais état</option>
    </select>
    
    
    <button type='submit'>Ajouter</button>
    
</form>

</body>
</html>