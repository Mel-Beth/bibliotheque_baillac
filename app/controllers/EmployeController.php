<?php

class EmployeController
{
    private $model;

    public function __construct($employeModel)
    {
        $this->model = $employeModel;

        // Vérifier si la session est déjà démarrée
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function loginEmploye()
    {
        $error = '';
    
        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nettoyer les entrées utilisateur
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
    
            // Vérification des champs vides
            if (empty($email) || empty($password)) {
                $error = 'Veuillez remplir tous les champs.';
            } else {
                // Récupérer l'employé via le modèle
                $employe = $this->model->getEmployeByEmail($email);
    
                    
                // Vérifier les informations d'identification
                if ($employe && password_verify($password, $employe['mot_de_passe'])) {
                    // Connexion réussie, enregistrement dans la session
                    $_SESSION['employe_id'] = $employe['id_employe'];
                    $_SESSION['employe_nom'] = $employe['nom'];
                    $_SESSION['employe_prenom'] = $employe['prenom'];
                    $_SESSION['role'] = $employe['role'];
      
                    // Rediriger vers la page d'accueil
                    header('Location: accueil');  // Utilisez une redirection complète avec la route
                    exit;
                } else {
                    // Si l'email ou mot de passe est incorrect
                    $error = 'Email ou mot de passe incorrect.';
                }
            }
        }
    
        // Afficher le formulaire de connexion avec message d'erreur
        include 'app/views/employes/loginEmploye.php';
    }
    

}
?>