<?php

if (!isset($_SESSION['employe_id'])) {
    echo "Vous n'êtes pas connecté.";
    exit;
} else {
    echo "Bienvenue, " . $_SESSION['employe_nom'] . " " . $_SESSION['employe_prenom'];
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('includes/head.html'); ?>
    <title>Bibliothèque de Baillac</title>
</head>

<body>
<li><a href="logout">Déconnexion</a></li>

<!-- <div class="user-header">
    <img src="<?php echo $user['photo']; ?>" alt="Photo de profil">
    <h2><?php echo $user['nom'] . ' ' . $user['prenom']; ?></h2>
    <p>Responsable de Section - <?php echo 'Bat. ' . $user['batiment'] . ' / Étage : ' . $user['etage']; ?></p>
</div>

<div class="section emprunts">
    <h3>Emprunts en cours</h3>
    <p>Science-Fiction : <?php echo $nbEmpruntsSciFi; ?> | Partout : <?php echo $nbEmpruntsTotal; ?></p>
    <a href="index.php?route=details&type=emprunts" class="details-btn">Détails</a>
</div>

<div class="section retours">
    <h3>Historique des retours</h3>
    <p>Cette semaine : <?php echo $nbRetoursSemaine; ?> / 40 prévus</p>
    <a href="index.php?route=details&type=retours" class="details-btn">Détails</a>
</div>

<div class="section transit">
    <h3>En transit</h3>
    <p>Étage actuel : <?php echo $nbTransitEtage; ?> | Autres : <?php echo $nbTransitAilleurs; ?></p>
    <a href="index.php?route=details&type=transit" class="details-btn">Détails</a>
</div>

<div class="scan-button">
    <a href="index.php?route=scanner">
        <button>Scanner un ouvrage</button>
    </a>
</div> -->

</body>
</html>
