<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('includes/head.html'); ?>
</head>

<body>
<div class="fixed-button">
    <button ><a href="scanner">< Retour</a></button>
</div>
<?php
$ajoutDateRetour = date('Y-m-d', strtotime('+14 days'));
$scannerModel = new Scanner($pdo);
 $scannerController = new ScannerController($scannerModel); 
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération du QR Code
    $qrCode = null;

    if (isset($_POST['qr-result']) && !empty($_POST['qr-result'])) {
        $qrCode = $_POST['qr-result'];
    } elseif (isset($_POST['manual-result']) && !empty($_POST['manual-result'])) {
        $qrCode = $_POST['manual-result'];
    }elseif (isset($_POST['action']) && $_POST['action'] == 'retour'){          
        $exemplaireId = $_POST['exemplaire-id'];
        $message = $scannerController->retournerLivre($exemplaireId);
        echo "<p>" . $message . "</p>"; 
    }elseif ($_POST['action'] == 'renouveler') {
         $exemplaireId = $_POST['exemplaire-id']; 
         $message = $scannerController->renouvelerEmprunt($exemplaireId);
          echo "<p>" . $message . "</p>" 
    ; }

    // Vérification si le QR Code a été défini
    if ($qrCode !== null) {
        try {
            $scanner = new Scanner($pdo); 

            $livre = $scanner->checkLivre($qrCode);

            echo "<div id='result-container'>";
            if ($livre) {
                if ($livre['id_transaction'] && $livre['date_retour'] > date('Y-m-d')) {
                    include './app/views/scanner/emprunte.php';
                } else {
                    include './app/views/scanner/disponible.php';
                }
            } else {
                echo "<p>Aucun livre trouvé avec ce code : </p>" ."<p>". htmlspecialchars($qrCode) ."</p>";
                ?>
                <div class="ajout-exemplaire">
                    <form action="scanner/ajout_exemplaire" method="post">
                        <input type="hidden" value="<?= $qrCode ?>" name="qrCode">
                        <button type='submit'>Ajouter Nouvelle Exemplaire</button>
                    </form>
                </div>
                
                
                <?PHP
            }
            echo "</div>";
        } catch (Exception $e) {
            echo "<p>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } 
}
?>

</body>
</html>
