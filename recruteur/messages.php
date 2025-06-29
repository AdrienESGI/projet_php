<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: /login.php");
    exit;
}

$user_id = $_SESSION["user_id"];

// Liste des utilisateurs à qui écrire (sauf soi-même)
$destinataires = $pdo->prepare("SELECT id, nom FROM utilisateurs WHERE id != ?");
$destinataires->execute([$user_id]);

// Envoi d’un message
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dest = $_POST["destinataire"];
    $contenu = trim($_POST["contenu"]);

    if (!empty($contenu)) {
        $stmt = $pdo->prepare("INSERT INTO messages (expediteur_id, destinataire_id, contenu) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $dest, $contenu]);
    }
}

// Récupération des messages reçus
$messages = $pdo->prepare("
    SELECT m.*, u.nom AS expediteur_nom
    FROM messages m
    JOIN utilisateurs u ON u.id = m.expediteur_id
    WHERE m.destinataire_id = ?
    ORDER BY m.date_envoi DESC
");
$messages->execute([$user_id]);

include("../includes/header.php");
?>

<h1>Messagerie interne</h1>

<div class="form-container">
    <form method="post">
        <label>Destinataire</label>
        <select name="destinataire" required>
            <?php foreach ($destinataires as $d): ?>
                <option value="<?= $d['id'] ?>"><?= htmlspecialchars($d['nom']) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Message</label>
        <textarea name="contenu" required></textarea>

        <button type="submit">Envoyer</button>
    </form>
</div>

<h2 style="text-align:center; color:#00c853">Messages reçus</h2>

<?php foreach ($messages as $msg): ?>
    <div class="project">
        <p><strong><?= htmlspecialchars($msg['expediteur_nom']) ?></strong> <em>(<?= $msg['date_envoi'] ?>)</em></p>
        <p><?= nl2br(htmlspecialchars($msg['contenu'])) ?></p>
    </div>
<?php endforeach; ?>

<?php include("../includes/footer.php"); ?>
