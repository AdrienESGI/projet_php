<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "recruteur") {
    header("Location: /projet_annuel/login.php");
    exit;
}

include("../includes/header.php");
?>

<h1>Bienvenue, Recruteur</h1>

<div class="presentation-box">
    <p>Gérez vos offres d’alternance, suivez les candidatures et trouvez les profils adaptés.</p>
</div>

<div class="shortcut-box">
    <h3>Actions rapides</h3>
    <div style="display:flex; gap: 15px; flex-wrap: wrap;">
        <a class="btn-contact" href="/projet_annuel/recruteur/publier_annonce.php">Publier une annonce</a>
        <a class="btn-contact" href="/projet_annuel/recruteur/mes_annonces.php">Mes annonces</a>
        <a class="btn-contact" href="/projet_annuel/recruteur/candidats.php">Voir les candidats</a>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
