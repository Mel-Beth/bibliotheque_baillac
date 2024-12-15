<?php
class Employe {
    private $db;

    // Le constructeur prend l'objet PDO
    public function __construct($database) {
        $this->db = $database;
    }

    // Méthode pour récupérer un employé par son email
    public function getEmployeByEmail($email) {
        $query = "SELECT * FROM employes WHERE email = :email";
        $stmt = $this->db->prepare($query);  // Utilisation de PDO pour préparer la requête
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Retourner les informations de l'employé si trouvé
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>