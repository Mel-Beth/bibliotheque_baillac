<?php

class Transaction
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function countEmprunts()
    {
        $query = "SELECT COUNT(*) AS total FROM transactions WHERE statut = 'emprunté'";
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function countRetours()
    {
        $query = "SELECT COUNT(*) AS total FROM transactions WHERE statut = 'retourné'";
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function countTransits()
    {
        $query = "SELECT COUNT(*) AS total FROM transactions WHERE statut = 'en transit'";
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function countLivres()
    {
        $query = "SELECT COUNT(*) AS total FROM livres";
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
?>
