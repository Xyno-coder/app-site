<?php
// Paramètres de connexion
$host = 'herogu.garageisep.com';
$db = 'dIr64sSdId_app_g9e';
$user = 't3S8KneeKd_app_g9e';
$pass = 'M7fboKJOxkHzSLnr';

$dsn = "mysql:host=$host;dbname=$db";

try {
    $bdd = new PDO($dsn, $user, $pass);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données !";
} catch (\PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}
?>
