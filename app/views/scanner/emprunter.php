<?php

$ajoutDateRetour = date('Y-m-d', strtotime('+14 days'));

$scannerModel = new Scanner($pdo);
$scannerController = new ScannerController($scannerModel);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $qrCode = $_POST['qr-result'];
    $adherentId = $_POST['adherent-id'];

    $message = $scannerController->emprunterLivre($qrCode, $adherentId);
    echo "<p>" . $message . "</p>";
} else {
    echo "<p>Méthode non autorisée.</p>";
}

$qrCode = $_GET['qr_code'];

?>
<div class="fixed-button">
    <button ><a href="../scanner">< Retour</a></button>
</div>

<form method='post' action=''>
<input type='hidden' name='qr-result' value='<?= htmlspecialchars($qrCode) ?>'>
<label for='adherent-id'>Numéro d'adhérent :</label>
<input type='text' id='adherent-id' name='adherent-id' required>
<button type='submit'>Emprunter</button>
</form>
