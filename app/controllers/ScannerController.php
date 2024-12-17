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




// require_once 'database.php';

// <?php
// class ScannerController {
//     private $scannerModel;

//     // Le constructeur prend le modèle Scanner
//     public function __construct($scannerModel) {
//         $this->scannerModel = $scannerModel;
//     }

//     // Méthode pour vérifier le code du livre
//     public function checkLivre($code) {
//         $livre = $this->scannerModel->getLivreByCode($code);
//         if ($livre) {
//             return $livre;
//         } else {
//             return null;
//         }
//     }
// }
// ?>
