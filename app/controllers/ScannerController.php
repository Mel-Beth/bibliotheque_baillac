<?php

class ScannerController {
    private $scannerModel;

    public function __construct($scannerModel) {
        $this->scannerModel = $scannerModel;
    }

    public function checkLivre($code) {
        return $this->scannerModel->checkLivre($code);
    }

    public function checkAdherent($adherentId) {
        return $this->scannerModel->checkAdherent($adherentId);
    }

    public function emprunterLivre($qrCode, $adherentId) {
        $ajoutDateRetour = date('Y-m-d', strtotime('+14 days'));

        if ($this->checkAdherent($adherentId)) {
            $livre = $this->checkLivre($qrCode);
            if ($livre) {
                $id_employe = $_SESSION['employe_id'];
                $result = $this->scannerModel->updateOrAddTransaction($livre['id_exemplaire'], $adherentId, $ajoutDateRetour, $id_employe);
                if ($result) {
                    return "Le livre a été emprunté avec succès par l'adhérent numéro : " . htmlspecialchars($adherentId);
                } else {
                    return "Une erreur est survenue lors de la mise à jour de la transaction.";
                }
            } else {
                return "Aucun livre trouvé avec ce code : " . htmlspecialchars($qrCode);
            }
        } else {
            return "Numéro d'adhérent invalide. Veuillez réessayer avec un numéro d'adhérent valide. ";
        }
    }
    public function retournerLivre($exemplaireId) {
        $id_employe = $_SESSION['employe_id'];
        $result = $this->scannerModel->retournerLivre($exemplaireId, $id_employe);
        if ($result) {
            return "Le livre a été retourné avec succès.";
        } else {
            return "Une erreur est survenue lors du retour du livre.";
        }
    }
    public function renouvelerEmprunt($exemplaireId) {
        $id_employe = $_SESSION['employe_id'];
        $ajoutDateRetour = date('Y-m-d', strtotime('+14 days'));
        $result = $this->scannerModel->renouvelerEmprunt($exemplaireId, $ajoutDateRetour, $id_employe);
        if ($result) {
            return "L'emprunt a été renouvelé avec succès pour 14 jours supplémentaires.";
        } else {
            return "Une erreur est survenue lors du renouvellement de l'emprunt.";
        }
    }
    public function ajoutExemplaire($qrCode, $etat, $isbn) {
        
        $result = $this->scannerModel->ajoutExemplaire($qrCode, $etat, $isbn);
        if ($result) {
            return "L'exemplaire a été ajouté avec succès.";
        } else {
            return "Une erreur est survenue.";
        }
    }
    
}