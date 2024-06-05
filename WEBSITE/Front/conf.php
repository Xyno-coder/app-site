<?php
// Paramètres de connexion
$host = 'herogu.garageisep.com'; // Adresse du serveur
$db = 'dIr64sSdId_app_g9e'; // Nom de la base de données
$user = 't3S8KneeKd_app_g9e'; // Nom d'utilisateur de la base de données
$pass = 'M7fboKJOxkHzSLnr'; // Mot de passe de l'utilisateur de la base de données


$dsn = "mysql:host=$host;dbname=$db"

try {
    // Création de l'instance PDO
    $bdd = new PDO($dsn, $user, $pass);
    echo "Connexion réussie à la base de données !";
} catch (\PDOException $e) {
    // Gestion des erreurs de connexion
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
