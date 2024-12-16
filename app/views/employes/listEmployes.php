<<head>
    <?php include('includes/head.html'); ?>
    <title>Liste des Employés - Bibliothèque de Baillac</title>
</head>
<body>
    <h1>Liste des Employés</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($employes)) : ?>
                <?php foreach ($employes as $employe) : ?>
                    <tr>
                        <td><?= htmlspecialchars($employe['id_employe']) ?></td>
                        <td><?= htmlspecialchars($employe['nom']) ?></td>
                        <td><?= htmlspecialchars($employe['prenom']) ?></td>
                        <td><?= htmlspecialchars($employe['email']) ?></td>
                        <td>
                            <?= $employe['role'] === '1' ? 'Administrateur' : 'Bibliothécaire' ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" style="text-align: center;">Aucun employé trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
