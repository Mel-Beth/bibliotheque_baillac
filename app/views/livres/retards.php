<!DOCTYPE html>
<html lang="fr">
<head>
<?php include 'includes/head.html'; ?>

<title>Emprunts en cours</title>
    <link rel="stylesheet" href="assets/css/emprunts.css">
</head>
<body>
    <div class="container-emprunt">
        <header class="header-accueil">
            <div class="welcome-message">
                <p>Bienvenue, <?= htmlspecialchars($_SESSION['employe_prenom'] ?? '') ?> <?= htmlspecialchars($_SESSION['employe_nom'] ?? '') ?> !</p>
                <p>Rôle : <?= htmlspecialchars($_SESSION['role'] ?? '') ?></p>
                <p>Bâtiment : <?= htmlspecialchars($_SESSION['batiment'] ?? '') ?></p>
                <p>Étage : <?= htmlspecialchars($_SESSION['etage'] ?? '') ?></p>
            </div>
            <div class="logout-btn">
                <a href="logout" title="Déconnexion">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </header>

        <!-- Bouton Retour -->
        <div class="scan-button">
            <a href="accueil">
                <button class="btn">Retour à l'accueil</button>
            </a>
        </div>

        <div class="filters">
            <a href="retards" class="btn active">Tous</a>
        </div>

        <section class="emprunts-section">
            <?php if (!empty($retards)) : ?>
                <div class="emprunts-liste">
                    <?php foreach ($retards as $retard) : ?>
                        <div class="emprunt-item">
                            <h3><?= htmlspecialchars($retard['titre']) ?></h3>
                            <p>Retour prévu le : <strong><?= htmlspecialchars($retard['date_retour']) ?></strong></p>
                            <p>Emprunté par : <strong><?= htmlspecialchars($retard['employe_prenom'] . ' ' . $retard['employe_nom']) ?></strong></p>
                            <p style="color: red;">En retard !</p>
                            <a href="index.php?route=livres/detail&isbn=<?= urlencode($retard['isbn']) ?>" class="btn">
                                Détails >
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="no-emprunts">Aucun livre en retard.</p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
