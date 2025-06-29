<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "candidat") {
    header("Location: /projet_annuel/login.php");
    exit;
}

$user_id = $_SESSION["user_id"];
$message = "";

// Enregistrement ou mise à jour des infos personnelles
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_profil"])) {
    $date_naissance = $_POST["date_naissance"] ?: null;
    $ville = trim($_POST["ville"]);
    $ecole = trim($_POST["ecole"]);
    $niveau = trim($_POST["niveau_etude"]);
    $objectif = trim($_POST["objectif"]);
    $linkedin = trim($_POST["linkedin"]);
    $portfolio = trim($_POST["portfolio"]);

    $check = $pdo->prepare("SELECT utilisateur_id FROM profil_utilisateur WHERE utilisateur_id = ?");
    $check->execute([$user_id]);

    if ($check->rowCount() > 0) {
        $update = $pdo->prepare("UPDATE profil_utilisateur SET date_naissance=?, ville=?, ecole=?, niveau_etude=?, objectif=?, linkedin=?, portfolio=? WHERE utilisateur_id=?");
        $update->execute([$date_naissance, $ville, $ecole, $niveau, $objectif, $linkedin, $portfolio, $user_id]);
    } else {
        $insert = $pdo->prepare("INSERT INTO profil_utilisateur (utilisateur_id, date_naissance, ville, ecole, niveau_etude, objectif, linkedin, portfolio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert->execute([$user_id, $date_naissance, $ville, $ecole, $niveau, $objectif, $linkedin, $portfolio]);
    }

    $message = "✅ Profil mis à jour.";
}

// Ajout d'une nouvelle expérience
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_experience"])) {
    $poste = trim($_POST["poste"]);
    $entreprise = trim($_POST["entreprise"]);
    $date_debut = $_POST["date_debut"] ?: null;
    $date_fin = $_POST["date_fin"] ?: null;
    $description = trim($_POST["description"]);

    $stmt = $pdo->prepare("INSERT INTO experiences_professionnelles (utilisateur_id, poste, entreprise, date_debut, date_fin, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $poste, $entreprise, $date_debut, $date_fin, $description]);

    $message = "✅ Expérience ajoutée.";
}

// Suppression d'une expérience
if (isset($_GET["delete_exp"])) {
    $id = intval($_GET["delete_exp"]);
    $pdo->prepare("DELETE FROM experiences_professionnelles WHERE id = ? AND utilisateur_id = ?")->execute([$id, $user_id]);
    $message = "❌ Expérience supprimée.";
}

// Chargement des infos
$profil = $pdo->prepare("SELECT * FROM profil_utilisateur WHERE utilisateur_id = ?");
$profil->execute([$user_id]);
$data = $profil->fetch();

$experiences = $pdo->prepare("SELECT * FROM experiences_professionnelles WHERE utilisateur_id = ? ORDER BY date_debut DESC");
$experiences->execute([$user_id]);
$xp_list = $experiences->fetchAll();

include("../includes/header.php");
?>

<h1>Gérer mon profil</h1>

<?php if ($message): ?>
    <div class="shortcut-box"><?= htmlspecialchars($message) ?></div>
<?php endif; ?>

<div class="presentation-box">
    <h2>Informations personnelles</h2>
    <form method="post" class="form-container">
        <input type="hidden" name="update_profil" value="1">

        <label>Date de naissance</label>
        <input type="date" name="date_naissance" value="<?= $data['date_naissance'] ?? '' ?>">

        <label>Ville</label>
        <input type="text" name="ville" value="<?= $data['ville'] ?? '' ?>">

        <label>École</label>
        <input type="text" name="ecole" value="<?= $data['ecole'] ?? '' ?>">

        <label>Niveau d’étude</label>
        <select name="niveau_etude">
            <option value="">-- Sélectionner --</option>
            <?php
            $niveaux = ["Bac", "Bac+1", "Bac+2", "Bac+3", "Bac+4", "Bac+5", "Autre"];
            foreach ($niveaux as $niv) {
                $selected = ($data["niveau_etude"] ?? '') === $niv ? 'selected' : '';
                echo "<option value='$niv' $selected>$niv</option>";
            }
            ?>
        </select>

        <label>Objectif professionnel</label>
        <textarea name="objectif"><?= $data['objectif'] ?? '' ?></textarea>

        <label>LinkedIn</label>
        <input type="url" name="linkedin" value="<?= $data['linkedin'] ?? '' ?>">

        <label>Portfolio / Site</label>
        <input type="url" name="portfolio" value="<?= $data['portfolio'] ?? '' ?>">

        <button type="submit">Enregistrer mes informations</button>
    </form>
</div>

<div class="shortcut-box">
    <h2>Expériences professionnelles</h2>

    <?php if (count($xp_list) > 0): ?>
        <?php foreach ($xp_list as $xp): ?>
            <div class="project">
                <h3><?= htmlspecialchars($xp['poste']) ?> — <?= htmlspecialchars($xp['entreprise']) ?></h3>
                <p>
                    <strong>De :</strong> <?= $xp['date_debut'] ?> —
                    <strong>à :</strong> <?= $xp['date_fin'] ?: "Aujourd'hui" ?>
                </p>
                <p><?= nl2br(htmlspecialchars($xp['description'])) ?></p>
                <a class="btn-contact" href="?delete_exp=<?= $xp['id'] ?>" onclick="return confirm('Supprimer cette expérience ?')">🗑 Supprimer</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune expérience enregistrée.</p>
    <?php endif; ?>
</div>

<div class="presentation-box">
    <h2>Ajouter une expérience</h2>
    <form method="post" class="form-container">
        <input type="hidden" name="add_experience" value="1">

        <label>Poste</label>
        <input type="text" name="poste" required>

        <label>Entreprise</label>
        <input type="text" name="entreprise" required>

        <label>Date de début</label>
        <input type="date" name="date_debut">

        <label>Date de fin</label>
        <input type="date" name="date_fin">

        <label>Description</label>
        <textarea name="description"></textarea>

        <button type="submit">Ajouter cette expérience</button>
    </form>
</div>

<?php include("../includes/footer.php"); ?>
