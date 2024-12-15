<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('includes/head.html'); ?>
    <title>Connexion - Bibliothèque de Baillac</title>
</head>

<body>
    <div class="container-login">
        <!-- Logo -->
        <div class="logo-login">
            <img src="assets/images/logo.jpg" alt="Logo Bibliothèque de Baillac">
        </div>

        <!-- Titre -->
        <h2 class="title-login">Bibliothèque de Baillac</h2>

        <!-- Affichage de l'erreur -->
        <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form action="connexion" method="POST" class="form-login">
            <label for="identifiant" class="label-login">Identifiant</label>
            <input type="text" id="identifiant" name="email" class="input-login" placeholder="Entrez votre identifiant" required>

            <label for="password" class="label-login">Mot de passe</label>
            <input type="password" id="password" name="password" class="input-login" placeholder="Entrez votre mot de passe" required>

            <!-- Option mémoriser -->
            <div class="remember-login">
                <label>
                    <input type="checkbox" name="remember" class="checkbox-login">
                    Mémoriser l'identifiant
                </label>
            </div>

            <!-- Bouton -->
            <button type="submit" class="btn-login">Se connecter</button>
        </form>

    </div>
</body>

</html>