
    <div class="container">
        <h1>Emprunté</h1>
        <div class="book-photo">Photo de l'ouvrage</div>
        <table>
            <tr>
                <td>ISBN</td>
                <td><?= htmlspecialchars($livre['isbn']) ?></td>
            </tr>
            <tr>
                <td>N° Exemplaire</td>
                <td><?=htmlspecialchars($livre['id_exemplaire']) ?></td>
            </tr>
            <tr>
                <td>Emprunté le</td>
                <td><?=htmlspecialchars($livre['date_emprunt']) ?></td>
            </tr>
            <tr>
                <td>Par</td>
                <td><?=htmlspecialchars($livre['nom_employe']) ?></td>
            </tr>
            <tr>
                <td>État</td>
                <td><?=htmlspecialchars($livre['etat']) ?></td>
            </tr>
        </table>
        <button class="renew">Renouveler emprunt</button>
        <button class="return">Retour Bibliothèque</button>
    </div>
