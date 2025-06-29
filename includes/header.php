<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Plateforme Alternance IT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/projet_annuel/assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="hero">
    <div class="hero-text">
        <h1>Plateforme Alternance IT</h1>
        <p class="subtitle">Développe tes compétences, postule, et trouve ton alternance.</p>
    </div>
</div>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="sidebar">
    <a href="/projet_annuel/index.php">Accueil</a>
    <a href="/projet_annuel/recherche.php">Recherche</a>
    <a href="/projet_annuel/creer_cv.php">Créer mon CV</a>
    <a href="/projet_annuel/ressources.php">Ressources</a>

    <?php if (isset($_SESSION["user_id"])): ?>
        <?php if ($_SESSION["role"] === "candidat"): ?>
            <a href="/projet_annuel/candidat/dashboard.php">Candidat</a>
            <a href="/projet_annuel/candidat/profil.php">Mon profil</a>
            <a href="/projet_annuel/candidat/messages.php">Messagerie</a>
            <a href="/projet_annuel/candidat/suivi_competences.php">Suivi de mes compétences</a>
            <a href="/projet_annuel/candidat/candidatures.php">Mes candidatures</a>
        <?php elseif ($_SESSION["role"] === "recruteur"): ?>
            <a href="/projet_annuel/recruteur/dashboard.php">Recruteur</a>
            <a href="/projet_annuel/recruteur/publier_annonce.php">Publier</a>
            <a href="/projet_annuel/recruteur/mes_annonces.php">Mes annonces</a>
            <a href="/projet_annuel/recruteur/candidats.php">Candidats</a>
        <?php elseif ($_SESSION["role"] === "admin"): ?>
            <a href="/projet_annuel/admin/dashboard.php">Admin</a>
            <a href="/projet_annuel/admin/utilisateurs.php">Utilisateurs</a>
            <a href="/projet_annuel/admin/annonces.php">Annonces</a>
        <?php endif; ?>
        <a href="/projet_annuel/logout.php">Déconnexion</a>
    <?php else: ?>
        <a href="/projet_annuel/login.php">Connexion</a>
        <a href="/projet_annuel/register.php">Inscription</a>
    <?php endif; ?>
</div>
