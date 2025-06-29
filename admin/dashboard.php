<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: /projet_annuel/login.php");
    exit;
}

include("../includes/header.php");
?>

<h1>Tableau de bord Administrateur</h1>

<div class="presentation-box">
    <p>Bienvenue, administrateur. Vous avez un accès complet à la gestion des utilisateurs, des annonces, et au suivi de l’activité du site.</p>
</div>

<div class="shortcut-box">
    <h3>Actions disponibles</h3>
    <a class="btn-contact" href="/projet_annuel/admin/utilisateurs.php">Gérer les utilisateurs</a>
    <a class="btn-contact" href="/projet_annuel/admin/annonces.php">Gérer les annonces</a>
    <a class="btn-contact" href="/projet_annuel/ressources.php">Consulter les ressources</a>
</div>

<?php include("../includes/footer.php"); ?>
