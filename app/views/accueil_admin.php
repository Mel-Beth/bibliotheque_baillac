<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil Administrateur</title>
    <link rel="stylesheet" href="assets/css/style.css"> 
</head>
<body>
    <h1>Bienvenue Administrateur de la Bibliothèque Baillac</h1>

    <!-- ajout employe -->
    <section>
        <h2>Ajouter un employé</h2>
        <form method="POST">
            <label>Nom :</label>
            <input type="text" name="nom" required>
            <label>Prénom :</label>
            <input type="text" name="prenom" required>
            <label>Email :</label>
            <input type="email" name="email" required>
            <label>Mot de passe :</label>
            <input type="password" name="mot_de_passe" required>
            <label>Rôle (1=Admin, 2=Employé) :</label>
            <input type="number" name="role" min="1" max="2" required>
            <label>Section :</label>
            <input type="text" name="section" required>
            <button type="submit" name="action" value="add">Ajouter</button>
        </form>
    </section>

  
    <section>
        <h2>Liste des employés</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employes as $employe): ?>
                    <tr>
                        <td><?= htmlspecialchars($employe['id_employe']); ?></td>
                        <td><?= htmlspecialchars($employe['nom']); ?></td>
                        <td><?= htmlspecialchars($employe['prenom']); ?></td>
                        <td><?= htmlspecialchars($employe['email']); ?></td>
                        <td><?= $employe['role'] === '1' ? 'Administrateur' : 'Employé'; ?></td>
                        <td><?= htmlspecialchars($employe['section']); ?></td>
                        <td>
                            <!-- supression -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id_employe" value="<?= $employe['id_employe']; ?>">
                                <button type="submit" name="action" value="delete">Supprimer</button>
                            </form>
                            <!-- reafectation -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id_employe" value="<?= $employe['id_employe']; ?>">
                                <input type="text" name="new_section" placeholder="Nouvelle section" required>
                                <button type="submit" name="action" value="reassign">Réaffecter</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <p><a href="index.php?route=logout">Se déconnecter</a></p>
</body>
</html>
