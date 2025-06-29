<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "recruteur") {
    header("Location: /projet_annuel/login.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = trim($_POST["titre"]);
    $description = trim($_POST["description"]);

    if ($titre && $description) {
        $stmt = $pdo->prepare("INSERT INTO annonces (recruteur_id, titre, description) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION["user_id"], $titre, $description]);
        $message = "✅ Annonce publiée avec succès !";
    } else {
        $message = "⚠️ Tous les champs sont requis.";
    }
}

include("../includes/header.php");
?>

<h1>Publier une annonce</h1>

<?php if ($message): ?>
    <div class="shortcut-box"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="form-container">
    <form method="post">
        <label>Titre</label>
        <input type="text" name="titre" required>

        <label>Description</label>
        <textarea name="description" required></textarea>

        <button type="submit">Publier</button>
    </form>
</div>

<?php include("../includes/footer.php"); ?>
