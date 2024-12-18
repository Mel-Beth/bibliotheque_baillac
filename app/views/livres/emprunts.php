<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include 'includes/head.html'; ?>
    <title>Emprunts en cours</title>
</head>
<body>
    <div class="container-accueil">
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
                    <i class="fas fa-sign-out-alt"></i> <!-- Icône de déconnexion -->
                </a>
            </div>
        </header>

        <!-- En-têtes -->
        <section class="section-header">
            <h1>Emprunts en cours</h1>
            <h2>Bat.<?= htmlspecialchars($_SESSION['batiment'] ?? '') ?> / <?= htmlspecialchars($_SESSION['etage'] ?? '') ?> - Sci-Fi</h2>
        </section>

        <!-- Liste des emprunts -->
        <section class="key-metrics">
            <?php if (!empty($emprunts)) : ?>
                <div class="emprunts-liste">
                    <?php foreach ($emprunts as $emprunt) : ?>
                        <div class="metric emprunt-item">
                            <!-- Titre du livre -->
                            <h3><?= htmlspecialchars($emprunt['titre']) ?></h3>
                            <p>Emprunté le : <strong><?= htmlspecialchars($emprunt['date_emprunt']) ?></strong></p>
                            <p>Sorti par : <strong><?= htmlspecialchars($emprunt['employe_prenom'] . ' ' . $emprunt['employe_nom']) ?></strong></p>
                            <!-- Bouton Détails -->
                            <a href="index.php?route=livres/detail&isbn=<?= urlencode($emprunt['isbn']) ?>" class="btn">
                                Détails >
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <!-- Message si aucun emprunt -->
                <p class="no-emprunts">Aucun emprunt en cours.</p>
            <?php endif; ?>
        </section>

        <!-- Bouton Retour -->
        <div class="scan-button">
            <a href="index.php">
                <button>Retour à l'accueil</button>
            </a>
        </div>
    </div>
</body>
</html>
