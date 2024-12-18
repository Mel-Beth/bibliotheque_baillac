<?php
class EmpruntsModel
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Récupérer les emprunts en cours
    public function getEmpruntsEnCours()
    {
        $query = "SELECT ht.date_emprunt, e.id_exemplaire, l.titre, l.isbn, emp.prenom AS employe_prenom, emp.nom AS employe_nom
                  FROM public.historique_transactions ht
                  JOIN public.exemplaires e ON ht.id_exemplaire = e.id_exemplaire
                  JOIN public.livres l ON e.isbn = l.isbn
                  JOIN public.employes emp ON ht.id_employe = emp.id_employe
                  WHERE ht.date_retour > NOW()";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
