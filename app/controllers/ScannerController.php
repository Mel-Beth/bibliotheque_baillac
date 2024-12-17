<?php


if (!isset($route[0]) || $route[0] == 'scanner') {
    if (isset($route[1]) || $route == '') {
        switch ($route[1]) {
            
            case 'resultat':
                include 'app/views/scanner/resultat.php';
                break;
            case 'inscription':
                
                include 'views/connexion/inscription_form.php';
                break;
            default:
                include 'views/404.php';
                break;
        }
    }else {
        include 'app/views/scanner/scan.php';
    }
}
