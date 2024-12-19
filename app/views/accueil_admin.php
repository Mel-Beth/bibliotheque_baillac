<?php include 'includes/head.html'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    
    <title>Accueil Admin- Bibliothèque de Baillac</title>
    <link rel="stylesheet" href="">
</head>

<body>
    
        <h1>Bienvenue Administrateur de la Bibliothèque Baillac</h1>
    

    <main class="content-layout">
        <!-- ajout employe -->
        <section class="container-accueil left-align">
            <form method="POST" class="glass-form">
                <h2 class="glass-form-title">Ajouter un employé</h2>
                <label class="form-label">Nom :</label>
                <input type="text" name="nom" class="form-input" required>
                <label class="form-label">Prénom :</label>
                <input type="text" name="prenom" class="form-input" required>
                <label class="form-label">Email :</label>
                <input type="email" name="email" class="form-input" required>
                <label class="form-label">Mot de passe :</label>
                <input type="password" name="mot_de_passe" class="form-input" required>
                <label class="form-label">Rôle</label>
                <input type="number" name="role" min="1" max="2" class="form-input" required>
                <label class="form-label">Batiment</label>
                <input type="text" name="batiment" class="form-input" required>
                <button type="submit" name="action" value="add" class="form-button">Ajouter</button>
            </form>
        </section>

        <!-- Liste des employés -->
        <section class="table-container">
            <h2 class="glass-form-title">Liste des employés</h2>
            <div class="scrollable-table">
                <table class="employee-table">
                    <thead>
                        <tr class="table-row-header">
                            <th class="table-header">ID</th>
                            <th class="table-header">Nom</th>
                            <th class="table-header">Prénom</th>
                            <th class="table-header">Email</th>
                            <th class="table-header">Rôle</th>
                            <th class="table-header">Batiment</th>
                            <th class="table-header">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employes as $employe) : ?>
                            <tr class="table-row">
                                <td class="table-cell"><?= htmlspecialchars($employe['id_employe']); ?></td>
                                <td class="table-cell"><?= htmlspecialchars($employe['nom']); ?></td>
                                <td class="table-cell"><?= htmlspecialchars($employe['prenom']); ?></td>
                                <td class="table-cell"><?= htmlspecialchars($employe['email']); ?></td>
                                <td class="table-cell"><?= $employe['role'] === '1' ? 'Administrateur' : 'Employé'; ?></td>
                                <td class="table-cell"><?= htmlspecialchars($employe['batiment']); ?></td>
                                <td class="table-cell">
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id_employe" value="<?= $employe['id_employe']; ?>">
                                        <button type="submit" name="action" value="delete" class="form-button">Supprimer</button>
                                    </form>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id_employe" value="<?= $employe['id_employe']; ?>">
                                        <input type="text" name="new_section" placeholder="Nouvelle section" class="form-input" required>
                                        <button type="submit" name="action" value="reassign" class="form-button">Réaffecter</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <p class="logout"><a href="logout" class="logout-link">Se déconnecter</a></p>
</body>
</html>
