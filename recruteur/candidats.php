<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "recruteur") {
    header("Location: /projet_annuel/login.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE role = 'candidat' ORDER BY nom");
$stmt->execute();
$candidats = $stmt->fetchAll();

include("../includes/header.php");
?>

<h1>Liste des candidats</h1>

<?php if (count($candidats) > 0): ?>
    <?php foreach ($candidats as $c): ?>
        <div class="project">
            <h2><?= htmlspecialchars($c['nom']) ?></h2>
            <p><strong>Email :</strong> <?= htmlspecialchars($c['email']) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="shortcut-box">Aucun candidat enregistré.</div>
<?php endif; ?>

<?php include("../includes/footer.php"); ?>
