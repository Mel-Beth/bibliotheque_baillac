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

        <!-- Filtres -->
        <div class="filters">
            <a href="emprunts&filtre=emprunts" class="btn <?= isset($_GET['filtre']) && $_GET['filtre'] == 'emprunts' ? 'active' : '' ?>">Emprunts</a>
            <a href="emprunts&filtre=transit" class="btn <?= isset($_GET['filtre']) && $_GET['filtre'] == 'transit' ? 'active' : '' ?>">En Transit</a>
            <a href="emprunts" class="btn <?= empty($_GET['filtre']) ? 'active' : '' ?>">Tous</a>
        </div>
        <section class="emprunts-section">
            <?php if (!empty($retours)) : ?>
                <div class="emprunts-liste">
                    <?php foreach ($retours as $retour) : ?>
                        <div class="emprunt-item">
                            <h3><?= htmlspecialchars($retour['titre']) ?></h3>
                            <p>Retour prévu le : <strong><?= htmlspecialchars($retour['date_retour']) ?></strong></p>
                            <p>Emprunté par : <strong><?= htmlspecialchars($retour['employe_prenom'] . ' ' . $retour['employe_nom']) ?></strong></p>
                            <a href="index.php?route=livres/detail&isbn=<?= urlencode($retour['isbn']) ?>" class="btn">
                                Détails >
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="no-emprunts">Aucun retour prévu.</p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
