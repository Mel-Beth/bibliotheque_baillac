<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/head.html'; ?>
    <title>Accueil Admin - Bibliothèque de Baillac</title>
</head>

<body>
    <div class="container-accueil">
        <!-- En-tête avec informations utilisateur -->
        <header class="header-accueil">
            <div class="welcome-message">
                <p>Bienvenue, <?= htmlspecialchars($_SESSION['employe_prenom'] ?? 'Administrateur') ?> <?= htmlspecialchars($_SESSION['employe_nom'] ?? '') ?> !</p>
                <p>Rôle : <?= htmlspecialchars($_SESSION['role'] === '1' ? 'Administrateur' : 'Responsable') ?></p>
                <p>Bâtiment : <?= htmlspecialchars($_SESSION['batiment'] ?? 'N/A') ?></p>
            </div>
            <!-- Bouton Déconnexion -->
            <div class="logout-btn">
                <a href="logout" title="Déconnexion">
                    <i class="fas fa-sign-out-alt"></i> <!-- Icône de déconnexion -->
                </a>
            </div>
        </header>

        <!-- Liste des employés -->
        <section class="table-container">
            <h2>Liste des employés</h2>
            <div class="scrollable-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Rôle</th>
                            <th>Bâtiment</th>
                            <th>Étage</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employes as $employe): ?>
                            <tr>
                                <td><?= htmlspecialchars($employe['id_employe']) ?></td>
                                <td><?= htmlspecialchars($employe['nom']) ?></td>
                                <td><?= htmlspecialchars($employe['prenom']) ?></td>
                                <td><?= htmlspecialchars($employe['email']) ?></td>
                                <td><?= htmlspecialchars($employe['telephone']) ?></td>
                                <td><?= $employe['role'] === 'responsable_site' ? 'Responsable Site' : ($employe['role'] === 'responsable' ? 'Responsable' : 'Bibliothécaire') ?></td>
                                <td><?= htmlspecialchars($employe['batiment']) ?></td>
                                <td><?= htmlspecialchars($employe['etage']) ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id_employe" value="<?= $employe['id_employe'] ?>">
                                        <button type="submit" name="action" value="delete">Supprimer</button>
                                    </form>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id_employe" value="<?= $employe['id_employe'] ?>">
                                        <select name="new_batiment" required>
                                            <option value="">Sélectionner un bâtiment</option>
                                            <?php foreach ($batiments as $batiment): ?>
                                                <option value="<?= htmlspecialchars($batiment['batiment']) ?>"><?= htmlspecialchars($batiment['batiment']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <select name="new_etage" required>
                                            <option value="">Sélectionner un étage</option>
                                            <?php foreach ($etages as $etage): ?>
                                                <option value="<?= htmlspecialchars($etage['etage']) ?>"><?= htmlspecialchars($etage['etage']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" name="action" value="reassign">Réaffecter</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Section principale -->
        <main class="key-metrics">
            <!-- Ajouter un employé -->
            <section class="glass-form left-align">
                <h2>Ajouter un employé</h2>
                <form method="POST">
                    <label>Nom :</label>
                    <input type="text" name="nom" required>
                    <label>Prénom :</label>
                    <input type="text" name="prenom" required>
                    <label>Email :</label>
                    <input type="email" name="email" required>
                    <label>Téléphone :</label>
                    <input type="text" name="telephone" required>
                    <label>Mot de passe :</label>
                    <input type="password" name="mot_de_passe" required>
                    <label>Rôle :</label>
                    <select name="role" required>
                        <option value="bibliothecaire">Bibliothécaire</option>
                        <option value="responsable">Responsable</option>
                        <option value="responsable_site">Responsable Site</option>
                    </select>
                    <label>Bâtiment :</label>
                    <select name="batiment" required>
                        <option value="">Sélectionner un bâtiment</option>
                        <?php foreach ($batiments as $batiment): ?>
                            <option value="<?= htmlspecialchars($batiment['batiment']) ?>"><?= htmlspecialchars($batiment['batiment']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label>Étage :</label>
                    <select name="etage" required>
                        <option value="">Sélectionner un étage</option>
                        <?php foreach ($etages as $etage): ?>
                            <option value="<?= htmlspecialchars($etage['etage']) ?>"><?= htmlspecialchars($etage['etage']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name="action" value="add">Ajouter</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
