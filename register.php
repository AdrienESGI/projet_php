<?php
session_start();
require_once("includes/config.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $mot_de_passe = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);
    $role = $_POST["role"];

    $check = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        $message = "❌ Cet email est déjà utilisé.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nom, $email, $mot_de_passe, $role]);
        $message = "✅ Inscription réussie. Vous pouvez vous connecter.";
    }
}
?>

<?php include("includes/header.php"); ?>

<div class="presentation-box">
    <h1 style="text-align:center;">Inscription</h1>

    <?php if ($message): ?>
        <div style="margin-bottom: 15px; color: <?= str_contains($message, 'réussie') ? 'green' : 'red' ?>;">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <form method="post" class="form-container">
        <label>Nom complet</label>
        <input type="text" name="nom" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Mot de passe</label>
        <input type="password" name="mot_de_passe" required>

        <label>Je suis :</label>
        <select name="role" required>
            <option value="candidat">Candidat</option>
            <option value="recruteur">Recruteur</option>
        </select>

        <button type="submit">S'inscrire</button>
    </form>
</div>

<?php include("includes/footer.php"); ?>
