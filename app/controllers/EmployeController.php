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

    // connexion des employés
    public function loginEmploye()
    {
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            if (empty($email) || empty($password)) {
                $error = 'Veuillez remplir tous les champs.';
            } else {
                $employe = $this->model->getEmployeByEmail($email);

                if ($employe && password_verify($password, $employe['mot_de_passe'])) {
                    $_SESSION['employe_id'] = $employe['id_employe'];
                    $_SESSION['employe_nom'] = $employe['nom'];
                    $_SESSION['employe_prenom'] = $employe['prenom'];
                    $_SESSION['role'] = $employe['role'];

                    if ($employe['role'] === 'responsable' || $employe['role'] === 'responsable_site') {
                        header('Location: accueil_admin');
                    } else {
                        header('Location: accueil');
                    }
                    exit;
                } else {
                    $error = 'Email ou mot de passe incorrect.';
                }
            }
        }
        include 'app/views/employes/loginEmploye.php';
    }

    // Ajouter un employé
    public function addEmploye($data)
    {
        $nom = trim($data['nom']);
        $prenom = trim($data['prenom']);
        $email = trim($data['email']);
        $mot_de_passe = password_hash($data['mot_de_passe'], PASSWORD_BCRYPT);
        $role = $data['role'];
        $section = trim($data['section']);

        if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($data['mot_de_passe']) && !empty($role)) {
            $this->model->createEmploye($nom, $prenom, $email, $mot_de_passe, $role, $section);
            header('Location: accueil_admin');
            exit;
        } else {
            echo "Veuillez remplir tous les champs requis pour l'ajout.";
        }
    }

    // Supprimer un employé
    public function deleteEmploye($id)
    {
        if (!empty($id)) {
            $this->model->removeEmploye($id);
            header('Location: accueil_admin');
            exit;
        } else {
            echo "ID employé manquant pour la suppression.";
        }
    }

    // Réaffecter un employé à une nouvelle section
    public function reassignEmploye($id, $newSection)
    {
        if (!empty($id) && !empty($newSection)) {
            $this->model->updateSection($id, $newSection);
            header('Location: accueil_admin');
            exit;
        } else {
            echo "ID employé ou nouvelle section manquants pour la réaffectation.";
        }
    }
}

?>
