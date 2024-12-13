<?php

    // Configuration de la base de données
    $host = 'localhost'; // Adresse du serveur
    $port = 5432; // Port du serveur
    $dbname = 'bibliotheque_baillac'; // Nom de la base de données
    $username = 'postgres'; // Nom d'utilisateur
    $password = 'postgres'; // Mot de passe

try {

    // Connexion à la base de données avec PDO
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $username, $password);

    // Configuration des attributs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {

    die("Erreur de connexion ou de requête : " . $e->getMessage());
}

?>