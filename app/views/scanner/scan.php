<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scanner QR Code</title>
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <style>
        .container {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        #reader {
            width: 100%;
            max-width: 350px;
            margin: 0 auto;
        }
        .hidden {
            display: none;
        }
        form {
            width: 100%;
            max-width: 350px;
            margin-top: 20px;
        }
        input[type="text"], button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
        }
        button:hover {
            background-color: #0056b3;
        }
        #result-container {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Scanner QR Code</h1>
    <div id="reader"></div>

    <form id="scan-form" method="post" action="">
        <input type="hidden" name="qr-result" id="result">
        <p>Si le scan ne fonctionne pas, entrez manuellement le contenu du QR code :</p>
        <input type="text" name="manual-result" placeholder="Entrez le QR code ici">
        <button type="submit">Envoyer</button>
    </form>

    <?php
    if (isset($_POST['qr-result']) && !empty($_POST['qr-result'])) {
        $qrResult = $_POST['qr-result'];
        echo "<div id='result-container'>";
        echo "<h2>Contenu du QR Code:</h2>";
        echo "<p>" . htmlspecialchars($qrResult) . "</p>";
        echo "</div>";
    } elseif (isset($_POST['manual-result']) && !empty($_POST['manual-result'])) {
        $manualResult = $_POST['manual-result'];
        echo "<div id='result-container'>";
        echo "<h2>Contenu du QR Code (entrée manuelle):</h2>";
        echo "<p>" . htmlspecialchars($manualResult) . "</p>";
        echo "</div>";
    } else {
        echo "<p>Aucune donnée reçue.</p>";
    }
    ?>
</div>

<script type="text/javascript">
    function onScanSuccess(decodedText, decodedResult) {
        console.log(`Scan result: ${decodedText}`);
        document.getElementById('result').value = decodedText;
        document.getElementById('scan-form').submit();
    }

    function onScanError(errorMessage) {
        console.error(`Scan error: ${errorMessage}`);
    }

    const html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: { width: 250, height: 250 } });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>

</body>
</html>
