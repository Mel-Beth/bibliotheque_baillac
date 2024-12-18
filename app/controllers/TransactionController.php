<?php

class TransactionController {
    private $transactionModel;

    public function __construct($transactionModel) {
        $this->transactionModel = $transactionModel;
    }

    // Méthode pour emprunter un livre
    public function emprunterLivre($idAdherent, $idEmploye, $isbn, $idExemplaire) {
        $employe = $this->getEmployeById($idEmploye);
        $exemplaire = $this->getExemplaireById($idExemplaire);

        if ($employe['etage'] !== $exemplaire['etage']) {
            $this->transactionModel->mettreAJourEtatLivre($idExemplaire, 'En transit');
        }

        $dateRetour = date('Y-m-d', strtotime('+30 days'));
        $commentaire = "Emprunt du livre. Livre en transit.";
        $this->transactionModel->ajouterTransaction($idAdherent, $idEmploye, $isbn, $idExemplaire, $commentaire, $dateRetour);

        $this->afficherHistorique($idAdherent);
    }

    // Méthode pour retourner un livre
    public function retournerLivre($idAdherent, $idEmploye, $isbn, $idExemplaire) {
        $this->transactionModel->mettreAJourEtatLivre($idExemplaire, 'Bon état');
        $commentaire = "Retour du livre";
        $this->transactionModel->ajouterTransaction($idAdherent, $idEmploye, $isbn, $idExemplaire, $commentaire, date('Y-m-d'));
        $this->afficherHistorique($idAdherent);
    }

    // Afficher les statistiques
    public function afficherStatistiques() {
        $empruntsEnCours = $this->transactionModel->countEmprunts() ?? 0;
        $retoursEffectues = $this->transactionModel->countRetours() ?? 0;
        $livresEnRetard = $this->transactionModel->countLivresEnRetard() ?? 0;
        $messagesNonLus = $this->transactionModel->countMessagesNonLus() ?? 0;

        include 'app/views/accueil.php';
    }

    private function getEmployeById($idEmploye) {
        return $this->transactionModel->getEmployeById($idEmploye);
    }

    private function getExemplaireById($idExemplaire) {
        return $this->transactionModel->getExemplaireById($idExemplaire);
    }

    public function afficherHistorique($idAdherent) {
        $transactions = $this->transactionModel->getHistoriqueTransactions($idAdherent);
        include 'app/views/HistoriqueTransaction.php';
    }
}
