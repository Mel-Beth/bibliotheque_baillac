<div class="page-rendu">
    <div class="container">
        <h1>Rendu</h1>
        <div class="book-photo"><img height="150px" src="assets/images/livre.webp" alt="Photo de l'ouvrage"></div>
        <table>
            <tr>
                <td>ISBN</td>
                <td><?= htmlspecialchars($livre['isbn']) ?></td>
            </tr>
            <tr>
                <td>État</td>
                <td><?= htmlspecialchars($livre['etat']) ?></td>
            </tr>
            <tr>
                <td>N° Exemplaire</td>
                <td><?= htmlspecialchars($livre['id_exemplaire']) ?></td>
            </tr>
            <?php
            if ($livre['id_transaction']) {
                ?>
                <tr>
                    <td>Rendu le</td>
                    <td><?= htmlspecialchars($livre['date_retour'] ?? 'null') ?></td>
                </tr>
                <tr>
                    <td>Récupéré par</td>
                    <td><?= htmlspecialchars($livre['prenom_employe']) ?> <?= htmlspecialchars($livre['nom_employe']) ?></td>
                </tr>
                <?php
            } else {
                echo 'aucune transaction';
            }
            ?>
        </table>
        <button class="borrow"><a href="./scanner/emprunter?qr_code=<?=$qrCode?>">Emprunter</a></button>
    </div>
</div>

