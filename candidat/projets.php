<?php
require 'config.php'; // Inclusion des paramètres globaux

// Récupère le nom de la page actuelle
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Projets</title>
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
        <h1>Mes <span>Projets</span></h1>

        <!-- Projet Poseidon -->
        <section class="project">
            <h2>Projet <span>Poseidon</span></h2>
            <p>
            Lors de mon alternance chez <strong>OTS</strong>, avec Yanis Lahmadi Braconnier qui est dans la classe ESGI 1 A, nous avons conçu une solution d'automatisation pour corriger les erreurs dans les fichiers CSV. Ce projet a permis d'améliorer l'efficacité des processus métiers. Yanis était en charge d'établir le script Python et j'étais en charge de concevoir le backend et le frontend du site qui allait héberger le script.

            </p>
            <ul>
                <li><strong>Technologies utilisées :</strong> PHP, HTML, Python, MySQL</li>
                <li><strong>Objectif :</strong> Automatiser la correction des fichiers CSV avec un script Python intégré</li>
                <li><strong>Résultats :</strong> Réduction de 80% du temps de correction</li>
            </ul>
            <div class="project-image">
                <img src="images/poseidon.jpeg" alt="Projet Poseidon" />
            </div>
        </section>

        <!-- Projet Secondaire -->
        <section class="project">
            <h2>Projet <span>Secondaire</span></h2>
            <p>
                En cours de création d'un site vitrine pour ma compagne afin qu'elle puisse lancer sa nouvelle activitée de Coach sportive.
            </p>
            <ul>
                <li><strong>Technologies utilisées :</strong> PHP, HTML/CSS</li>
                <li><strong>Objectif :</strong> Mise en ligne rapide d'un site performant afin de permettre sa promotion.</li>
            </ul>
        </section>

        <!-- Ligne décorative -->
        <div class="line"></div>

        <!-- Bouton retour -->
        <a href="index.php" class="btn-contact">← Retour à l'accueil</a>
    </div>
</body>
</html>
