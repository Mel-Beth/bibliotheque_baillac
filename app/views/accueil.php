<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include 'includes/head.html'; ?>
    <title>Accueil - Bibliothèque de Baillac</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="container-accueil">
        <!-- Section des informations globales -->
        <header class="header-accueil">
            <h1>Tableau de bord - Bibliothèque de Baillac</h1>
            <div class="welcome-message">
                <p>Bienvenue, <?= htmlspecialchars($_SESSION['employe_prenom']) ?> <?= htmlspecialchars($_SESSION['employe_nom']) ?> !</p>
                <p>Rôle : <?= htmlspecialchars($_SESSION['role']) ?></p>
                <p>Bâtiment : <?= htmlspecialchars($_SESSION['batiment']) ?></p>
                <p>Étage : <?= htmlspecialchars($_SESSION['etage']) ?></p>
                <li><a href="logout">Déconnexion</a></li>
            </div>
        </header>

        <!-- Section des chiffres clés -->
        <section class="key-metrics">
            <div class="metric">
                <h2>Total des emprunts</h2>
                <p><?= htmlspecialchars($empruntsEnCours) ?></p>
                <a href="details" class="btn">Détails</a>
            </div>
            <div class="metric">
                <h2>Total des retours</h2>
                <p><?= htmlspecialchars($retoursEffectues) ?></p>
                <a href="details" class="btn">Détails</a>
            </div>
            <div class="metric">
                <h2>Total des retards</h2>
                <p><?= htmlspecialchars($livresEnRetard) ?></p>
                <a href="details" class="btn">Détails</a>
            </div>
            <div class="metric">
                <h2>Messagerie</h2>
                <p>Messages non lus: </p> <a href="messages" class="btn">Voir tous</a>
            </div>
        </section>
        </section>

        <!-- Bouton pour scanner un ouvrage -->
        <div class="scan-button">
            <a href="scanner">
                <button>Scanner un ouvrage</button>
            </a>
        </div>
    </div>
</body>

</html>