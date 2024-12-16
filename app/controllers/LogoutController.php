<?php

class LogoutController
{
    public function logout()
    {
        // Démarrer la session si elle n'est pas déjà démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Détruire toutes les variables de session
        $_SESSION = [];

        // Détruire la session
        session_destroy();

        // Rediriger vers la page de connexion
        header("Location: connexion");
        exit;
    }
}

?>
