<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include 'includes/head.html'; ?>
    <title>Accueil - Bibliothèque de Baillac</title>
</head>

<body>
    <div class="container-accueil">
        <header class="header-accueil">
            <div class="welcome-message">
                <p>Bienvenue, <?= htmlspecialchars($_SESSION['employe_prenom'] ?? '') ?> <?= htmlspecialchars($_SESSION['employe_nom'] ?? '') ?> !</p>
                <p>Rôle : <?= htmlspecialchars($_SESSION['role'] ?? '') ?></p>
                <p>Bâtiment : <?= htmlspecialchars($_SESSION['batiment'] ?? '') ?></p>
                <p>Étage : <?= htmlspecialchars($_SESSION['etage'] ?? '') ?></p>
            </div>
            <!-- Bouton Déconnexion -->
            <div class="logout-btn">
                <a href="logout" title="Déconnexion">
                    <i class="fas fa-sign-out-alt"></i> <!-- Icône de déconnexion -->
                </a>
            </div>
        </header>


        <section class="key-metrics">
            <div class="metric">
                <h2>Total des emprunts</h2>
                <p><?= htmlspecialchars($empruntsEnCours ?? 0) ?></p>
                <a href="emprunts" class="btn">Détails</a>
            </div>
            <div class="metric">
                <h2>Total des retours</h2>
                <p><?= htmlspecialchars($retoursEffectues ?? 0) ?></p>
                <a href="retours" class="btn">Détails</a>
            </div>
            <div class="metric">
                <h2>Total des retards</h2>
                <p><?= htmlspecialchars($livresEnRetard ?? 0) ?></p>
                <a href="retards" class="btn">Détails</a>
            </div>
            <div class="metric">
                <h2>Messagerie</h2>
                <p>Messages non lus: <?= htmlspecialchars($messagesNonLus ?? 0) ?></p>
                <a href="messages" class="btn">Voir tous</a>
            </div>
        </section>

        <div class="scan-button">
            <a href="scanner">
                <button>Scanner un ouvrage</button>
            </a>
        </div>
    </div>
</body>

</html>