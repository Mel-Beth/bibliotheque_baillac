<?php
session_unset(); // Supprime toutes les variables de session
session_destroy(); // Détruit la session
header("Location: accueil"); // Redirigez vers la page d'accueil
exit();
?>
