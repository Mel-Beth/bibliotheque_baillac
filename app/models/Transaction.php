<?php

class Transaction {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function countEmprunts() {
        $query = "SELECT COUNT(*) as total FROM public.historique_transactions WHERE date_retour > NOW()";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    public function countRetours() {
        $query = "SELECT COUNT(*) as total FROM public.historique_transactions WHERE date_retour <= NOW()";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    public function countLivresEnRetard() {
        $query = "SELECT COUNT(*) as total FROM public.historique_transactions WHERE date_retour < NOW()";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    // public function countMessagesNonLus() {
    //     $query = "SELECT COUNT(*) as total FROM public.messages WHERE lu = false";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    // }
}
