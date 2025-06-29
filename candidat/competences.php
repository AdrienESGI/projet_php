<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "candidat") {
    header("Location: /login.php");
    exit;
}

$message = "";

// Ajouter une compétence
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $competence_id = $_POST["competence"];
    $niveau = $_POST["niveau"];

    // Vérifie si la compétence existe déjà pour cet utilisateur
    $check = $pdo->prepare("SELECT id FROM utilisateurs_competences WHERE utilisateur_id = ? AND competence_id = ?");
    $check->execute([$_SESSION["user_id"], $competence_id]);

    if ($check->rowCount() > 0) {
        $message = "Cette compétence est déjà enregistrée.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO utilisateurs_competences (utilisateur_id, competence_id, niveau) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION["user_id"], $competence_id, $niveau]);
        $message = "Compétence ajoutée avec succès.";
    }
}

// Liste des compétences disponibles
$competences = $pdo->query("SELECT * FROM competences ORDER BY categorie, nom")->fetchAll();

// Compétences du candidat
$mes_competences = $pdo->prepare("SELECT uc.*, c.nom, c.categorie 
    FROM utilisateurs_competences uc 
    JOIN competences c ON uc.competence_id = c.id 
    WHERE uc.utilisateur_id = ?
    ORDER BY c.categorie, c.nom");
$mes_competences->execute([$_SESSION["user_id"]]);
$liste = $mes_competences->fetchAll();

include("../includes/header.php");
?>

<h1>Mes compétences</h1>

<?php if ($message): ?>
    <div class="presentation-box"><?= $message ?></div>
<?php endif; ?>

<div class="form-container">
    <form method="post">
        <label>Compétence</label>
        <select name="competence" required>
            <option value="">-- Choisir une compétence --</option>
            <?php foreach ($competences as $comp): ?>
                <option value="<?= $comp['id'] ?>"><?= $comp['categorie'] ?> — <?= $comp['nom'] ?></option>
            <?php endforeach; ?>
        </select>

        <label>Niveau (1 = Débutant, 5 = Expert)</label>
        <select name="niveau" required>
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>

        <button type="submit">Ajouter la compétence</button>
    </form>
</div>

<div class="skills-container">
    <h2 style="text-align:center; color:#00c853">Compétences enregistrées</h2>
    <?php foreach ($liste as $skill): ?>
        <div class="skill-box">
            <h3><?= htmlspecialchars($skill['nom']) ?> <small>(<?= htmlspecialchars($skill['categorie']) ?>)</small></h3>
            <div class="stars">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?= $i <= $skill["niveau"] ? "★" : "☆" ?>
                <?php endfor; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include("../includes/footer.php"); ?>
