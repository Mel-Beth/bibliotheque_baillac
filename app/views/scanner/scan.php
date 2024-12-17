<head>
    <?php include('includes/head.html'); ?>
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>

<body>
    <div class="section-scan">
        <div class="container">
            <h1>Scanner QR Code</h1>
            <div id="reader"></div>

            <form id="scan-form" method="post" action="scanner/resultat">
                <input type="hidden" name="qr-result" id="result">
                <p>Si le scan ne fonctionne pas, entrez manuellement le contenu du QR code :</p>
                <input type="text" name="manual-result" placeholder="Entrez le QR code ici">
                <button type="submit">Envoyer</button>
            </form>
        </div>
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
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            });
        html5QrcodeScanner.render(onScanSuccess, onScanError);
    </script>

</body>

</html>