<?php
$host = "localhost";
$dbname = "alternance_it"; // ⬅️ remplace par le nom exact de ta base
$user = "root";
$pass = ""; // ⬅️ mot de passe MySQL s'il y en a un

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
