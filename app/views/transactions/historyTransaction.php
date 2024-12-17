<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des transactions</title>
</head>
<body>
    <h1>Historique des transactions</h1>
    <table>
        <tr>
            <th>Date d'emprunt</th>
            <th>ISBN</th>
            <th>Exemplaire</th>
            <th>Commentaire</th>
            <th>Date de retour</th>
        </tr>
        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?php echo $transaction['date_emprunt']; ?></td>
                <td><?php echo $transaction['isbn']; ?></td>
                <td><?php echo $transaction['id_exemplaire']; ?></td>
                <td><?php echo $transaction['commentaire']; ?></td>
                <td><?php echo $transaction['date_retour']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
