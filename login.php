<?php
session_start();
require_once("includes/config.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $mot_de_passe = $_POST["mot_de_passe"] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($mot_de_passe, $user["mot_de_passe"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["role"] = $user["role"];

        // Redirection selon le rôle
        switch ($user["role"]) {
            case "admin":
                header("Location: /projet_annuel/admin/dashboard.php");
                break;
            case "recruteur":
                header("Location: /projet_annuel/recruteur/dashboard.php");
                break;
            case "candidat":
                header("Location: /projet_annuel/candidat/dashboard.php");
                break;
            default:
                $message = "Rôle utilisateur inconnu.";
        }
        exit;
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>

<?php include("includes/header.php"); ?>

<h1>Connexion</h1>

<div class="form-container">
    <?php if ($message): ?>
        <div class="shortcut-box" style="color: red;"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post" action="/projet_annuel/login.php">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Mot de passe</label>
        <input type="password" name="mot_de_passe" required>

        <button type="submit">Se connecter</button>
    </form>
</div>

<?php include("includes/footer.php"); ?>
