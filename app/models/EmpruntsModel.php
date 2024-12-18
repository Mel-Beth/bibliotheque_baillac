<?php
class EmpruntsModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Emprunts par employé connecté
    public function getEmpruntsByEmploye($prenomEmploye) {
        $query = "SELECT l.titre, ht.date_emprunt, ht.date_retour, e.isbn, emp.prenom AS employe_prenom, emp.nom AS employe_nom
                  FROM historique_transactions ht
                  JOIN exemplaires e ON ht.id_exemplaire = e.id_exemplaire
                  JOIN livres l ON e.isbn = l.isbn
                  JOIN employes emp ON ht.id_employe = emp.id_employe
                  WHERE emp.prenom = :prenom AND ht.date_retour >= CURRENT_DATE";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['prenom' => $prenomEmploye]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Emprunts par les autres employés
    public function getEmpruntsNotByEmploye($prenomEmploye) {
        $query = "SELECT l.titre, ht.date_emprunt, ht.date_retour, e.isbn, emp.prenom AS employe_prenom, emp.nom AS employe_nom
                  FROM historique_transactions ht
                  JOIN exemplaires e ON ht.id_exemplaire = e.id_exemplaire
                  JOIN livres l ON e.isbn = l.isbn
                  JOIN employes emp ON ht.id_employe = emp.id_employe
                  WHERE emp.prenom != :prenom AND ht.date_retour >= CURRENT_DATE";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['prenom' => $prenomEmploye]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tous les emprunts non retournés
    public function getAllEmprunts() {
        $query = "SELECT l.titre, ht.date_emprunt, ht.date_retour, e.isbn, emp.prenom AS employe_prenom, emp.nom AS employe_nom
                  FROM historique_transactions ht
                  JOIN exemplaires e ON ht.id_exemplaire = e.id_exemplaire
                  JOIN livres l ON e.isbn = l.isbn
                  JOIN employes emp ON ht.id_employe = emp.id_employe
                  WHERE ht.date_retour >= CURRENT_DATE";
        return $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}
