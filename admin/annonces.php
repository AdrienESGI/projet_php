<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: /login.php");
    exit;
}

// Suppression d'une annonce si demandée
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["annonce_id"])) {
    $stmt = $pdo->prepare("DELETE FROM annonces WHERE id = ?");
    $stmt->execute([$_POST["annonce_id"]]);
    $message = "Annonce supprimée.";
}

// Récupération des annonces
$annonces = $pdo->query("
    SELECT a.id, a.titre, a.description, a.date_publication, u.nom AS recruteur
    FROM annonces a
    JOIN utilisateurs u ON a.recruteur_id = u.id
    ORDER BY a.date_publication DESC
")->fetchAll();

include("../includes/header.php");
?>

<h1>Gestion des annonces</h1>
<?php if (!empty($message)) : ?>
    <div class="presentation-box"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<?php foreach ($annonces as $a): ?>
    <div class="project">
        <h2><?= htmlspecialchars($a["titre"]) ?></h2>
        <p><strong>Recruteur :</strong> <?= htmlspecialchars($a["recruteur"]) ?> — <em><?= date("d/m/Y", strtotime($a["date_publication"])) ?></em></p>
        <p><?= nl2br(htmlspecialchars($a["description"])) ?></p>
        <form method="post" onsubmit="return confirm('Supprimer cette annonce ?')">
            <input type="hidden" name="annonce_id" value="<?= $a["id"] ?>">
            <button class="btn-contact" type="submit">Supprimer</button>
        </form>
    </div>
<?php endforeach; ?>

<?php include("../includes/footer.php"); ?>
