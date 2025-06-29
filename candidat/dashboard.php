<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "candidat") {
    header("Location: /projet_annuel/login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Nombre de candidatures
$stmt = $pdo->prepare("SELECT COUNT(*) FROM candidatures WHERE candidat_id = ?");
$stmt->execute([$user_id]);
$total_candidatures = $stmt->fetchColumn();

// Nombre de compétences renseignées
$stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs_competences WHERE utilisateur_id = ?");
$stmt->execute([$user_id]);
$total_competences = $stmt->fetchColumn();

include("../includes/header.php");
?>

<h1>👋 Bienvenue sur ton espace candidat</h1>

<div class="presentation-box">
    <p>Ici, tu peux suivre tes candidatures, tes compétences et créer ton CV pour postuler facilement.</p>
</div>

<div class="shortcut-box">
    <h3>Résumé de ton profil</h3>
    <ul style="line-height: 1.8;">
        <li><strong>Candidatures envoyées :</strong> <?= $total_candidatures ?></li>
        <li><strong>Compétences renseignées :</strong> <?= $total_competences ?></li>
    </ul>
</div>

<div class="shortcut-box">
    <h3>Actions rapides</h3>
    <div style="display: flex; flex-direction: column; gap: 10px;">
        <a class="btn-contact" href="/projet_annuel/offres.php">Voir les offres</a>
        <a class="btn-contact" href="/projet_annuel/candidat/candidatures.php">Mes candidatures</a>
        <a class="btn-contact" href="/projet_annuel/candidat/suivi_competences.php">Suivi de mes compétences</a>
        <a class="btn-contact" href="/projet_annuel/creer_cv.php">Créer mon CV</a>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
