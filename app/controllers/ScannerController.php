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
                $result = $this->scannerModel->updateOrAddTransaction($livre['id_exemplaire'], $adherentId, $ajoutDateRetour);
                if ($result) {
                    return "Le livre a été emprunté avec succès par l'adhérent numéro : " . htmlspecialchars($adherentId);
                } else {
                    return "Une erreur est survenue lors de la mise à jour de la transaction.";
                }
            } else {
                return "Aucun livre trouvé avec ce code : " . htmlspecialchars($qrCode);
            }
        } else {
            return "Numéro d'adhérent invalide. Veuillez réessayer avec un numéro d'adhérent valide.";
        }
    }
    public function retournerLivre($exemplaireId) {
        $result = $this->scannerModel->retournerLivre($exemplaireId);
        if ($result) {
            return "Le livre a été retourné avec succès.";
        } else {
            return "Une erreur est survenue lors du retour du livre.";
        }
    }
}