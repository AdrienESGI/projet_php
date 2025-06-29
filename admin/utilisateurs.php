<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: /projet_annuel/login.php");
    exit;
}

// Filtrage
$filtre = $_GET['role'] ?? 'tous';
$recherche = $_GET['q'] ?? '';

// Requête SQL dynamique
$sql = "SELECT * FROM utilisateurs WHERE 1=1";
$params = [];

if ($filtre !== 'tous') {
    $sql .= " AND role = ?";
    $params[] = $filtre;
}

if (!empty($recherche)) {
    $sql .= " AND (nom LIKE ? OR email LIKE ?)";
    $params[] = "%$recherche%";
    $params[] = "%$recherche%";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$utilisateurs = $stmt->fetchAll();

include("../includes/header.php");
?>

<h1>👥 Gestion des utilisateurs</h1>

<!-- Barre de recherche et filtres -->
<div class="form-container">
    <form method="get" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center;">
        <select name="role">
            <option value="tous" <?= $filtre === 'tous' ? 'selected' : '' ?>>Tous</option>
            <option value="candidat" <?= $filtre === 'candidat' ? 'selected' : '' ?>>Candidats</option>
            <option value="recruteur" <?= $filtre === 'recruteur' ? 'selected' : '' ?>>Recruteurs</option>
            <option value="admin" <?= $filtre === 'admin' ? 'selected' : '' ?>>Administrateurs</option>
        </select>

        <input type="text" name="q" placeholder="Rechercher nom ou email" value="<?= htmlspecialchars($recherche) ?>">
        <button type="submit">🔍 Rechercher</button>
    </form>
</div>

<!-- Liste des utilisateurs -->
<?php if (count($utilisateurs) > 0): ?>
    <?php foreach ($utilisateurs as $u): ?>
        <div class="project">
            <h2><?= htmlspecialchars($u['nom']) ?> <small style="color:#aaa">(<?= $u['role'] ?>)</small></h2>
            <p><strong>Email :</strong> <?= htmlspecialchars($u['email']) ?></p>
            <form method="post" action="supprimer_utilisateur.php" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                <input type="hidden" name="id" value="<?= $u['id'] ?>">
                <button class="btn-contact" type="submit">🗑 Supprimer</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="shortcut-box">
        <p>Aucun utilisateur trouvé avec les filtres actuels.</p>
    </div>
<?php endif; ?>

<?php include("../includes/footer.php"); ?>
