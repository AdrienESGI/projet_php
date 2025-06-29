<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "recruteur") {
    header("Location: /login.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $competences = $_POST["competence"];
    $niveaux = $_POST["niveau"];

    $pdo->beginTransaction();

    try {
        $stmt = $pdo->prepare("INSERT INTO annonces (recruteur_id, titre, description) VALUES (?, ?, ?)");
        $stmt->execute([$_SESSION["user_id"], $titre, $description]);
        $annonce_id = $pdo->lastInsertId();

        $stmt_comp = $pdo->prepare("INSERT INTO annonces_competences (annonce_id, competence_id, niveau_minimum) VALUES (?, ?, ?)");
        foreach ($competences as $index => $id) {
            $niveau = $niveaux[$index];
            $stmt_comp->execute([$annonce_id, $id, $niveau]);
        }

        $pdo->commit();
        $message = "Annonce publiée avec succès.";
    } catch (Exception $e) {
        $pdo->rollBack();
        $message = "Erreur : " . $e->getMessage();
    }
}

$competences = $pdo->query("SELECT * FROM competences ORDER BY categorie, nom")->fetchAll();

include("../includes/header.php");
?>

<h1>Publier une annonce</h1>
<div class="form-container">
    <?php if ($message): ?><p><?= $message ?></p><?php endif; ?>

    <form method="post">
        <label>Titre</label>
        <input type="text" name="titre" required>

        <label>Description</label>
        <textarea name="description" required></textarea>

        <label>Compétences requises</label>
        <div id="competence-list">
            <div>
                <select name="competence[]" required>
                    <?php foreach ($competences as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['categorie'] ?> — <?= $c['nom'] ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="niveau[]" required>
                    <?php for ($i = 1; $i <= 5; $i++): ?><option value="<?= $i ?>"><?= $i ?></option><?php endfor; ?>
                </select>
            </div>
        </div>

        <button type="submit">Publier</button>
    </form>
</div>

<?php include("../includes/footer.php"); ?>
