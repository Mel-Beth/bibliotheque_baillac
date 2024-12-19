<!DOCTYPE html>
<html lang="fr">
<head>
<?php include 'includes/head.html'; ?>

<title>Emprunts en cours</title>
    <link rel="stylesheet" href="assets/css/emprunts.css">
</head>


<body class="emprunts-page">
    <div class="container-emprunt">
        <!-- En-tête avec informations utilisateur -->
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

        <!-- Liste des emprunts -->
        <section class="emprunts-section">
            <?php if (!empty($emprunts)) : ?>
                <div class="emprunts-liste">
                    <?php foreach ($emprunts as $emprunt) : ?>
                        <div class="emprunt-item">
                            <h3><?= htmlspecialchars($emprunt['titre']) ?></h3>
                            <p>Emprunté le : <strong><?= htmlspecialchars($emprunt['date_emprunt']) ?></strong></p>
                            <p>Sorti par : <strong><?= htmlspecialchars($emprunt['employe_prenom'] . ' ' . $emprunt['employe_nom']) ?></strong></p>
                            <a href="index.php?route=livres/detail&isbn=<?= urlencode($emprunt['isbn']) ?>" class="btn">
                                Détails >
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p class="no-emprunts">Aucun emprunt trouvé.</p>
            <?php endif; ?>
        </section>

        
    </div>
</body>

</html>
