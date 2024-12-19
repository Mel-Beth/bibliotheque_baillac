<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/head.html'; ?>
    <title>Messagerie - Bibliothèque de Baillac</title>
</head>
<body>
    <h1>Messagerie</h1>
    <table>
        <thead>
            <tr>
                <th>Expéditeur</th>
                <th>Sujet</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
                <tr>
                    <td><?= htmlspecialchars($message['expediteur']) ?></td>
                    <td><?= htmlspecialchars($message['sujet']) ?></td>
                    <td><?= htmlspecialchars($message['date_envoi']) ?></td>
                    <td><?= $message['lu'] ? 'Lu' : 'Non lu' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
