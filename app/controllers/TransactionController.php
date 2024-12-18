<?php

class TransactionController {
    private $transactionModel;

    public function __construct($transactionModel) {
        $this->transactionModel = $transactionModel;
    }

    // Méthode pour emprunter un livre
    public function emprunterLivre($idAdherent, $idEmploye, $isbn, $idExemplaire) {
        // Récupérer les informations de l'employé et de l'exemplaire
        $employe = $this->getEmployeById($idEmploye);
        $exemplaire = $this->getExemplaireById($idExemplaire);
        
        // Vérifier si l'employé est responsable de l'étage
        if ($employe['etage'] !== $exemplaire['etage']) {
            // Si l'employé n'est pas responsable, marquer le livre comme en transit
            $this->transactionModel->mettreAJourEtatLivre($idExemplaire, 'En transit');
        }

        // Ajouter la transaction d'emprunt
        $dateRetour = date('Y-m-d', strtotime('+30 days')); // Exemple : 30 jours pour le retour
        $commentaire = "Emprunt du livre. Livre en transit.";
        $this->transactionModel->ajouterTransaction($idAdherent, $idEmploye, $isbn, $idExemplaire, $commentaire, $dateRetour);

        // Afficher l'historique ou rediriger selon les besoins
        $this->afficherHistorique($idAdherent);
    }

    // Méthode pour retourner un livre
    public function retournerLivre($idAdherent, $idEmploye, $isbn, $idExemplaire) {
        // Mettre à jour l'état du livre comme "retourné"
        $this->transactionModel->mettreAJourEtatLivre($idExemplaire, 'Bon état');
        
        // Ajouter la transaction de retour
        $commentaire = "Retour du livre";
        $this->transactionModel->ajouterTransaction($idAdherent, $idEmploye, $isbn, $idExemplaire, $commentaire, date('Y-m-d'));

        // Afficher l'historique ou rediriger selon les besoins
        $this->afficherHistorique($idAdherent);
    }

    // Afficher l'historique des transactions
    public function afficherHistorique($idAdherent) {
        $transactions = $this->transactionModel->getHistoriqueTransactions($idAdherent);
        include 'app/views/HistoriqueTransaction.php'; // Inclure la vue pour afficher l'historique
    }

    // Afficher les statistiques d'emprunts en cours, de livres en transit et de retours
    public function afficherStatistiques() {
        $empruntsEnCours = $this->transactionModel->countEmprunts();
        $retoursEffectues = $this->transactionModel->countRetours();
        $livresEnRetard = $this->transactionModel->countLivresEnRetard();
        $totalLivres = $this->transactionModel->countTotalLivres();
    
        // Si l'utilisateur est administrateur, on redirige vers la page d'accueil admin
        if (isset($_SESSION['role']) && ($_SESSION['role'] === 'responsable' || $_SESSION['role'] === 'responsable_site')) {
            // Page spécifique à l'admin
            include 'app/views/accueil_admin.php';
        } else {
            // Page d'accueil classique
            include 'app/views/accueil.php';
        }
    }

    // Méthodes supplémentaires pour récupérer des informations (ex. employé, exemplaire) si nécessaire
    private function getEmployeById($idEmploye) {
        // Implémentation pour récupérer un employé par son ID
        return $this->transactionModel->getEmployeById($idEmploye);
    }

    private function getExemplaireById($idExemplaire) {
        // Implémentation pour récupérer un exemplaire par son ID
        return $this->transactionModel->getExemplaireById($idExemplaire);
    }
}

?>
