<?php
class Employe
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    // Récupérer un employé par son email
    public function getEmployeByEmail($email)
    {
        $query = "SELECT * FROM employes WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les employés
    public function getAllEmployes()
    {
        $query = "SELECT * FROM employes ORDER BY id_employe";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Créer un nouvel employé
    public function createEmploye($nom, $prenom, $email, $telephone, $mot_de_passe, $role, $batiment, $etage)
    {
        $query = "INSERT INTO employes (nom, prenom, email, telephone, mot_de_passe, role, batiment, etage)
                  VALUES (:nom, :prenom, :email, :telephone, :mot_de_passe, :role, :batiment, :etage)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':mot_de_passe' => $mot_de_passe,
            ':role' => $role,
            ':batiment' => $batiment,
            ':etage' => $etage,
        ]);
    }

    // Supprimer un employé
    public function removeEmploye($id)
    {
        $query = "DELETE FROM employes WHERE id_employe = :id_employe";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id_employe' => $id]);
    }

    // Réaffecter un employé à un nouvel étage
    public function updateEtage($id, $newEtage)
    {
        $query = "UPDATE employes SET etage = :etage WHERE id_employe = :id_employe";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':etage' => $newEtage,
            ':id_employe' => $id,
        ]);
    }

    // Réaffecter un employé à un nouveau bâtiment
    public function updateBatiment($id, $newBatiment)
    {
        $query = "UPDATE employes SET batiment = :batiment WHERE id_employe = :id_employe";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':batiment' => $newBatiment,
            ':id_employe' => $id,
        ]);
    }

    // Réaffecter un employé à un nouveau bâtiment et un nouvel étage
    public function updateBatimentEtage($id, $newBatiment, $newEtage)
    {
        $query = "UPDATE employes SET batiment = :batiment, etage = :etage WHERE id_employe = :id_employe";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':batiment' => $newBatiment,
            ':etage' => $newEtage,
            ':id_employe' => $id,
        ]);
    }

    // Récupérer tous les bâtiments disponibles
    public function getAllBatiments()
    {
        $query = "SELECT DISTINCT batiment FROM employes ORDER BY batiment";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer tous les étages disponibles
    public function getAllEtages()
    {
        $query = "SELECT DISTINCT etage FROM employes ORDER BY etage";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
