<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "candidat") {
    header("Location: /projet_annuel/login.php");
    exit;
}

// Suppression individuelle
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $competence_id = intval($_GET['delete']);

    // Supprimer la compétence du suivi du candidat
    $stmt = $pdo->prepare("DELETE FROM utilisateurs_competences WHERE utilisateur_id = ? AND competence_id = ?");
    $stmt->execute([$_SESSION["user_id"], $competence_id]);

    // Si compétence personnalisée ET plus utilisée → on la supprime de la table competences
    $check = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs_competences WHERE competence_id = ?");
    $check->execute([$competence_id]);
    $count = $check->fetchColumn();

    $check_cat = $pdo->prepare("SELECT categorie FROM competences WHERE id = ?");
    $check_cat->execute([$competence_id]);
    $categorie = $check_cat->fetchColumn();

    if ($count == 0 && $categorie === 'Personnalisée') {
        $pdo->prepare("DELETE FROM competences WHERE id = ?")->execute([$competence_id]);
    }

    header("Location: suivi_competences.php");
    exit;
}

// Sauvegarde des compétences
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pdo->prepare("DELETE FROM utilisateurs_competences WHERE utilisateur_id = ?")->execute([$_SESSION["user_id"]]);

    if (!empty($_POST['competences']) && is_array($_POST['competences'])) {
        $stmt = $pdo->prepare("INSERT INTO utilisateurs_competences (utilisateur_id, competence_id, niveau) VALUES (?, ?, ?)");
        foreach ($_POST['competences'] as $competence_id => $niveau) {
            $niveau = max(1, min(5, intval($niveau)));
            $stmt->execute([$_SESSION["user_id"], $competence_id, $niveau]);
        }
    }

    if (!empty($_POST['nouvelle'])) {
        $new_nom = trim($_POST['nouvelle']);
        if ($new_nom !== '') {
            $insert = $pdo->prepare("INSERT INTO competences (nom, categorie) VALUES (?, 'Personnalisée')");
            $insert->execute([$new_nom]);
        }
    }
}

// Chargement
$competences = $pdo->query("SELECT * FROM competences ORDER BY categorie, nom")->fetchAll();

$stmt = $pdo->prepare("SELECT competence_id, niveau FROM utilisateurs_competences WHERE utilisateur_id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$niveaux = [];
foreach ($stmt->fetchAll() as $row) {
    $niveaux[$row['competence_id']] = $row['niveau'];
}

include("../includes/header.php");
?>

<h1>Suivi de mes compétences</h1>

<form method="post" class="form-container">
    <table style="width:100%; border-collapse: collapse;">
        <thead>
            <tr style="background:#1b1b1b;">
                <th style="padding:8px;">Compétence</th>
                <th style="padding:8px;">Niveau</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($competences as $c): 
            $id = $c['id'];
            $niveau = $niveaux[$id] ?? 1;
        ?>
            <tr style="border-bottom:1px solid #333;">
                <td style="padding:6px 10px;">
                    <a href="?delete=<?= $id ?>" onclick="return confirm('Supprimer cette compétence ?')" style="color:red; margin-right:8px;">🗑</a>
                    <?= htmlspecialchars($c['nom']) ?> <small>(<?= $c['categorie'] ?>)</small>
                </td>
                <td style="padding:6px 10px;">
                    <div style="display:flex; align-items:center; gap:10px;">
                        <button type="button" onclick="changerNiveau(<?= $id ?>, -1)">➖</button>
                        <div id="stars-<?= $id ?>" style="font-size: 1.2rem;">
                            <?= str_repeat('⭐', $niveau) . str_repeat('☆', 5 - $niveau) ?>
                        </div>
                        <button type="button" onclick="changerNiveau(<?= $id ?>, 1)">➕</button>
                        <input type="hidden" name="competences[<?= $id ?>]" id="niveau-<?= $id ?>" value="<?= $niveau ?>">
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h3 style="margin-top:20px;">➕ Ajouter une compétence personnalisée</h3>
    <input type="text" name="nouvelle" placeholder="Ex: Laravel, Docker, etc.">
    <button type="submit">Enregistrer</button>
</form>

<script>
function changerNiveau(id, change) {
    const input = document.getElementById("niveau-" + id);
    let val = parseInt(input.value);
    val = Math.max(1, Math.min(5, val + change));
    input.value = val;

    let stars = "";
    for (let i = 1; i <= 5; i++) {
        stars += i <= val ? "⭐" : "☆";
    }
    document.getElementById("stars-" + id).innerText = stars;
}
</script>

<?php include("../includes/footer.php"); ?>
