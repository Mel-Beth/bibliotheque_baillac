<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('includes/head.html'); ?>
</head>

<body>

<?php



// Exemple d'utilisation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération du QR Code
    $qrCode = null;

    if (isset($_POST['qr-result']) && !empty($_POST['qr-result'])) {
        $qrCode = $_POST['qr-result'];
    } elseif (isset($_POST['manual-result']) && !empty($_POST['manual-result'])) {
        $qrCode = $_POST['manual-result'];
    }

    // Vérification si le QR Code a été défini
    if ($qrCode !== null) {
        // Instanciation de la classe Scanner
        try {
            $scanner = new Scanner($pdo); 

            $livre = $scanner->checkLivre($qrCode);

            echo "<div id='result-container'>";
            if ($livre) {
                
                var_dump($livre);
                if ($livre['id_transaction'] && $livre['date_retour'] > date('y-m-d')) {
                    
                    include './app/views/scanner/emprunte.php';
                    
                } else {
                    
                    include './app/views/scanner/disponible.php';
                }
            } else {
                echo "<p>Aucun livre trouvé avec ce code : </p>";
                echo $qrCode;
            }
            echo "</div>";
        } catch (Exception $e) {
            echo "<p>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p>Aucune donnée reçue .</p>";
    }
}

?>



</body>
</html>