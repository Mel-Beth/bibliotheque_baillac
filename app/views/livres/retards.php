<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/head.html'; ?>
    <title>Retards - Bibliothèque de Baillac</title>
</head>
<body>
    <h1>Liste des Retards</h1>
    <table>
        <tr>
            <th>Date d'emprunt</th>
            <th>ISBN</th>
            <th>ID Exemplaire</th>
            <th>ID Adhérent</th>
        </tr>
        <?php foreach ($retards as $retard): ?>
            <tr>
                <td><?= htmlspecialchars($retard['date_emprunt']) ?></td>
                <td><?= htmlspecialchars($retard['isbn']) ?></td>
                <td><?= htmlspecialchars($retard['id_exemplaire']) ?></td>
                <td><?= htmlspecialchars($retard['id_adherent']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
