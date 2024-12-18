<div class="page-emprunte">
    <div class="container">
        <h1>Emprunté</h1>
        <div class="book-photo"><img height="150px" src="assets/images/livre.webp" alt="Photo de l'ouvrage"></div>
        <table>
            <tr>
                <td>ISBN</td>
                <td><?= htmlspecialchars($livre['isbn']) ?></td>
            </tr>
            <tr>
                <td>N° Exemplaire</td>
                <td><?= htmlspecialchars($livre['id_exemplaire']) ?></td>
            </tr>
            <tr>
                <td>Emprunté le</td>
                <td><?= htmlspecialchars($livre['date_emprunt']) ?></td>
            </tr>
            <tr>
                <td>Date de Retour</td>
                <td><?= htmlspecialchars($livre['date_retour']) ?></td>
            </tr>
            <tr>
                <td>Par</td>
                <td><?= htmlspecialchars($livre['prenom_employe']) ?> <?= htmlspecialchars($livre['nom_employe']) ?>
                </td>
            </tr>
            <tr>
                <td>État</td>
                <td><?= htmlspecialchars($livre['etat']) ?></td>
            </tr>
        </table>
        <form method='post' action='scanner/resultat'> <input type='hidden' name='exemplaire-id' value='<?= htmlspecialchars($livre['id_exemplaire']) ?>'> <input type='hidden' name='action' value='renouveler'> <button type='submit' class="renew">Renouveler emprunt</button> </form>


        <!-- retour button  -->
        <form method='post' action='scanner/resultat'> 
            <input type='hidden' name='exemplaire-id' value='<?= htmlspecialchars($livre['id_exemplaire']) ?>'> 
            <input type='hidden' name='action' value='retour'>
            <button type='submit' class="return">Retourner à la Bibliothèque</button> 
            </form>
    </div>
</div>


<?php

 

    
