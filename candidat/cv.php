<?php
require 'config.php';

// Récupère le nom de la page actuelle
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon CV - Adrien Guillon</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <!-- Barre latérale -->
<div class="sidebar">
    <a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Accueil</a>
    <a href="cv.php" class="<?php echo ($current_page == 'cv.php') ? 'active' : ''; ?>">Mon CV</a>
    <a href="competences.php" class="<?php echo ($current_page == 'competences.php') ? 'active' : ''; ?>">Compétences</a>
    <a href="projets.php" class="<?php echo ($current_page == 'projets.php') ? 'active' : ''; ?>">Projets</a>
    <a href="contact.php" class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">Contact</a>
</div>
    <!-- Contenu principal -->
    <div class="main-content">
        <h1>Mon <span>CV</span></h1>

        <!-- À propos de moi -->
        <section class="presentation-box">
            <h2>À propos de moi</h2>
            <p>
                Fort de <strong>12 ans d'expérience</strong> en tant que chef sommelier, je suis en reconversion vers l'informatique avec une spécialisation en développement web.
                Actuellement en alternance chez <strong>OTS</strong>, je travaille sur des projets concrets en <strong>PHP</strong> et <strong>HTML</strong> pour automatiser
                la correction de fichiers <strong>CSV</strong> à l'aide de scripts <strong>Python</strong>.
            </p>
        </section>

        <!-- Expériences professionnelles -->
        <section class="presentation-box">
            <h2>Expériences Professionnelles</h2>

            <div class="cv-section">
                <h3><strong>Alternant Support IT - OTS</strong></h3>
                <p>Septembre 2024 - Aujourd'hui</p>
                <p>Création d'un site en PHP et HTML pour automatiser la correction de fichiers CSV grâce à un script Python.</p>
            </div>

            <div class="cv-section">
                <h3><strong>Chef Sommelier - Hôtel La Villa Florentine</strong></h3>
                <p>Mars 2022 - Septembre 2024</p>
                <p>Gestion de la cave, élaboration de la carte des vins et management d'une équipe de 10 personnes.</p>
            </div>

            <div class="cv-section">
                <h3><strong>Sommelier - Restaurant Léon de Lyon</strong></h3>
                <p>Juin 2021 - Mars 2022</p>
                <p>Service et conseil client pour l'accord mets et vins dans un établissement gastronomique.</p>
            </div>
        </section>

        <!-- Formation -->
        <section class="presentation-box">
            <h2>Formation</h2>
            <div class="cv-section">
                <h3><strong>Bachelor Chef de Projet Logiciel et Réseau - ESGI Aix-en-Provence</strong></h3>
                <p>2024 - 2027</p>
                <p>Formation informatique en alternance, développement des compétences générales de l'IT, (CSS, PHP, HTML, C, C++, Python etc...) </p>

            </div>
        </section>

        <!-- Retour à l'accueil -->
        <div style="margin-top: 20px;">
            <a href="index.php" class="btn-contact">← Retour à l'accueil</a>
        </div>
    </div>
</body>
</html>
