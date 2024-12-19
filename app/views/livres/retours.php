<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/head.html'; ?>
    <title>Retours - Bibliothèque de Baillac</title>
</head>
<body>
    <h1>Liste des Retours effectués</h1>
    <table>
        <tr>
            <th>Date de retour</th>
            <th>Date d'emprunt</th>
            <th>ISBN</th>
            <th>ID Exemplaire</th>
        </tr>
        <?php foreach ($retours as $retour): ?>
            <tr>
                <td><?= htmlspecialchars($retour['date_retour']) ?></td>
                <td><?= htmlspecialchars($retour['date_emprunt']) ?></td>
                <td><?= htmlspecialchars($retour['isbn']) ?></td>
                <td><?= htmlspecialchars($retour['id_exemplaire']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
