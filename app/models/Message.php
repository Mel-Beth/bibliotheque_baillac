<?php
class Message
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Compter les messages non lus
    public function countMessagesNonLus()
    {
        $query = "SELECT COUNT(*) as total FROM messages WHERE lu = 0";
        $result = $this->db->query($query);
        return $result->fetch()['total'];
    }

    // Récupérer tous les messages
    public function getMessages()
    {
        $query = "SELECT * FROM messages ORDER BY date_envoi DESC";
        return $this->db->query($query)->fetchAll();
    }
}
