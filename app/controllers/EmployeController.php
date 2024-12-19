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

    // Connexion des employés
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

                if ($employe) {
                    if (password_verify($password, $employe['mot_de_passe'])) {
                        // Mise à jour des variables de session
                        $_SESSION['employe_id'] = $employe['id_employe'];
                        $_SESSION['employe_nom'] = $employe['nom'];
                        $_SESSION['employe_prenom'] = $employe['prenom'];
                        $_SESSION['role'] = $employe['role'];
                        $_SESSION['batiment'] = $employe['batiment'];
                        $_SESSION['etage'] = $employe['etage'];

                        // Redirection selon le rôle
                        if ($_SESSION['role'] === 'responsable' || $_SESSION['role'] === 'responsable_site') {
                            header('Location: accueil_admin');
                        } else {
                            header('Location: accueil');
                        }
                        exit;
                    } else {
                        $error = 'Mot de passe incorrect.';
                    }
                } else {
                    $error = 'Email incorrect ou non trouvé.';
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
        $telephone = trim($data['telephone']);
        $mot_de_passe = password_hash($data['mot_de_passe'], PASSWORD_BCRYPT);
        $role = $data['role'];
        $batiment = trim($data['batiment']);
        $etage = trim($data['etage']);

        if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($telephone) && !empty($role)) {
            $this->model->createEmploye($nom, $prenom, $email, $telephone, $mot_de_passe, $role, $batiment, $etage);
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

    // Réaffecter un employé à un nouvel étage
    public function reassignEmploye($id, $newEtage)
    {
        if (!empty($id) && !empty($newEtage)) {
            $this->model->updateEtage($id, $newEtage);
            header('Location: accueil_admin');
            exit;
        } else {
            echo "ID employé ou nouvel étage manquants pour la réaffectation.";
        }
    }

    // Réaffecter un employé à un nouveau bâtiment
    public function reassignBatiment($id, $newBatiment)
    {
        if (!empty($id) && !empty($newBatiment)) {
            $this->model->updateBatiment($id, $newBatiment);
            header('Location: accueil_admin');
            exit;
        } else {
            echo "ID employé ou nouveau bâtiment manquants pour la réaffectation.";
        }
    }

    // Récupérer tous les employés
    public function getAllEmployes()
    {
        return $this->model->getAllEmployes();
    }

    // Récupérer tous les bâtiments
    public function getAllBatiments()
    {
        return $this->model->getAllBatiments();
    }

    // Récupérer tous les étages
    public function getAllEtages()
    {
        return $this->model->getAllEtages();
    }
}

