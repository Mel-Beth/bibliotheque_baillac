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
            $scanner = new Scanner($pdo); // Assurez-vous que $pdo est défini

            // Vérification si le livre existe et récupération de ses détails
            $livre = $scanner->checkLivre($qrCode);
            var_dump($livre);

            echo "<div id='result-container'>";
            if ($livre) {
                echo "<h2>Le livre existe :</h2>";
                echo "<p>ID Exemplaire: " . htmlspecialchars($livre['id_exemplaire']) . "</p>";
                echo "<p>ISBN: " . htmlspecialchars($livre['isbn']) . "</p>";
                // echo "<p>État: " . htmlspecialchars($livre['état']) . "</p>";
                // echo "<p>Statut: " . htmlspecialchars($livre['statut']) . "</p>";

                if ($livre['statut'] === 'disponible') {
                    echo "<p>Le livre est disponible à la bibliothèque.</p>";
                } else {
                    echo "<p>Le livre est actuellement emprunté.</p>";
                }
            } else {
                echo "<p>Aucun livre trouvé avec ce code.</p>";
            }
            echo "</div>";
        } catch (Exception $e) {
            echo "<p>Erreur : " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p>Aucune donnée reçue.</p>";
    }
}

?>



</body>
</html>