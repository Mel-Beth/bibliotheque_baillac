<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Employés - Bibliothèque de Baillac</title>
    <?php include('includes/head.html'); ?>
</head>
<body>
    <h1>Liste des Employés</h1>

    <!-- Bouton pour afficher le formulaire d'ajout d'employé -->
    <button onclick="document.getElementById('addEmployeForm').style.display='block'">
        Ajouter un employé
    </button>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
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
                            <?php 
                                // Si role est '1', on affiche Administrateur, sinon Bibliothécaire
                                // A adapter selon votre logique de rôle
                                echo ($employe['role'] === '1') ? 'Administrateur' : 'Bibliothécaire'; 
                            ?>
                        </td>
                        <td>
                            <!-- Bouton pour supprimer l'employé -->
                            <form method="POST" action="accueil_admin" style="display:inline;">
                                <input type="hidden" name="action" value="deleteEmploye">
                                <input type="hidden" name="id_employe" value="<?= $employe['id_employe'] ?>">
                                <button type="submit">Supprimer</button>
                            </form>

                            <!-- Bouton pour réaffecter l'employé -->
                            <button onclick="showReassignForm(<?= $employe['id_employe'] ?>)">Réaffecter</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Aucun employé trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Formulaire d'ajout d'employé (par défaut caché) -->
    <div id="addEmployeForm" style="display:none; border:1px solid #ccc; margin-top:20px; padding:10px;">
        <h2>Ajouter un nouvel employé</h2>
        <form method="POST" action="accueil_admin">
            <input type="hidden" name="action" value="addEmploye">
            <div>
                <label for="nom">Nom:</label>
                <input type="text" name="nom" id="nom" required>
            </div>
            <div>
                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" id="prenom" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" required>
            </div>
            <div>
                <label for="role">Rôle:</label>
                <select name="role" id="role">
                    <option value="1">Administrateur</option>
                    <option value="2">Bibliothécaire</option>
                </select>
            </div>
            <div>
                <label for="section">Section:</label>
                <input type="text" name="section" id="section">
            </div>
            <button type="submit">Ajouter</button>
            <button type="button" onclick="document.getElementById('addEmployeForm').style.display='none'">
                Annuler
            </button>
        </form>
    </div>

    <!-- Formulaire de réaffectation d'employé (caché par défaut) -->
    <div id="reassignEmployeForm" style="display:none; border:1px solid #ccc; margin-top:20px; padding:10px;">
        <h2>Réaffecter un employé</h2>
        <form method="POST" action="accueil_admin">
            <input type="hidden" name="action" value="reassignEmploye">
            <input type="hidden" name="id_employe" id="idEmployeReassi
