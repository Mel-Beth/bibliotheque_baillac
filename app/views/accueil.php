<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include 'includes/head.html'; ?>
    <title>Accueil - Bibliothèque de Baillac</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <li><a href="logout">Déconnexion</a></li>
    <div class="container-accueil">
        <!-- Section des informations globales -->
        <header class="header-accueil">
            <h1>Tableau de bord - Bibliothèque de Baillac</h1>
            <div class="welcome-message">
                <p>Bienvenue, <?= htmlspecialchars($_SESSION['employe_prenom']) ?> <?= htmlspecialchars($_SESSION['employe_nom']) ?> !</p>
                <p>Rôle : <?= htmlspecialchars($_SESSION['role']) ?></p>
            </div>
        </header>

        <!-- Section des chiffres clés -->
        <section class="key-metrics">
            <div class="metric">
                <h2>Total des emprunts</h2>
                <p><?= htmlspecialchars($empruntsEnCours) ?></p>
            </div>
            <div class="metric">
                <h2>Total des retours</h2>
                <p><?= htmlspecialchars($retoursEffectues) ?></p>
            </div>
            <div class="metric">
                <h2>Total des livres en transit</h2>
                <p><?= htmlspecialchars($totalTransactions - ($empruntsEnCours + $retoursEffectues)) ?></p>
            </div>
            <div class="metric">
                <h2>Total des livres disponibles</h2>
                <p><?= htmlspecialchars($totalLivres) ?></p>
            </div>
        </section>

        <!-- Bouton pour voir les détails -->
        <div class="details-button">
            <a href="details" class="btn">Voir les détails par bâtiment et étage</a>
        </div>

        <div class="scan-button">
            <a href="index.php?route=scanner">
                <button>Scanner un ouvrage</button>
            </a>
        </div>
    </div>
</body>

</html>