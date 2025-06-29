<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "candidat") {
    header("Location: /projet_annuel/login.php");
    exit;
}

$candidat_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("
    SELECT a.id, a.titre, a.description, a.date_publication, u.nom AS recruteur
    FROM candidatures c
    JOIN annonces a ON a.id = c.annonce_id
    JOIN utilisateurs u ON u.id = a.recruteur_id
    WHERE c.candidat_id = ?
    ORDER BY c.date_candidature DESC
");
$stmt->execute([$candidat_id]);
$candidatures = $stmt->fetchAll();

include("../includes/header.php");
?>

<h1>Mes candidatures</h1>

<?php if (isset($_GET["msg"])): ?>
    <div class="shortcut-box"><?= htmlspecialchars($_GET["msg"]) ?></div>
<?php endif; ?>

<?php if (count($candidatures) > 0): ?>
    <?php foreach ($candidatures as $c): ?>
        <div class="project">
            <h2><?= htmlspecialchars($c['titre']) ?></h2>
            <p><strong>Recruteur :</strong> <?= htmlspecialchars($c['recruteur']) ?> — <?= date("d/m/Y", strtotime($c['date_publication'])) ?></p>
            <p><?= nl2br(htmlspecialchars($c['description'])) ?></p>
            <a class="btn-contact" href="/projet_annuel/candidat/postuler.php?id=<?= $c['id'] ?>&action=retirer">Retirer ma candidature</a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="shortcut-box"><p>Vous n'avez encore postulé à aucune offre.</p></div>
<?php endif; ?>

<?php include("../includes/footer.php"); ?>
