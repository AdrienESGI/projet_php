<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "recruteur") {
    header("Location: /projet_annuel/login.php");
    exit;
}

$recruteur_id = $_SESSION["user_id"];
$message = "";

// Suppression d'une annonce
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $pdo->prepare("DELETE FROM candidatures WHERE annonce_id = ?")->execute([$id]);
    $pdo->prepare("DELETE FROM annonces WHERE id = ? AND recruteur_id = ?")->execute([$id, $recruteur_id]);
    $message = "✅ Annonce supprimée.";
}

// Récupérer les annonces + candidatures
$stmt = $pdo->prepare("
    SELECT a.*, 
    (SELECT COUNT(*) FROM candidatures c WHERE c.annonce_id = a.id) AS total_candidatures
    FROM annonces a
    WHERE a.recruteur_id = ?
    ORDER BY a.date_publication DESC
");
$stmt->execute([$recruteur_id]);
$annonces = $stmt->fetchAll();

include("../includes/header.php");
?>

<h1>Mes annonces</h1>

<?php if ($message): ?>
    <div class="shortcut-box"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php if (count($annonces) > 0): ?>
    <?php foreach ($annonces as $a): ?>
        <div class="project">
            <h2><?= htmlspecialchars($a['titre']) ?></h2>
            <p><?= nl2br(htmlspecialchars($a['description'])) ?></p>
            <p><small>Publiée le <?= date("d/m/Y", strtotime($a['date_publication'])) ?></small></p>
            <p><strong>Candidatures reçues :</strong> <?= $a['total_candidatures'] ?></p>

            <a class="btn-contact" href="mes_annonces.php?delete=<?= $a['id'] ?>" onclick="return confirm('Supprimer cette annonce ?')">🗑 Supprimer</a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="shortcut-box">Aucune annonce encore publiée.</div>
<?php endif; ?>

<?php include("../includes/footer.php"); ?>
