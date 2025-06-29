<?php
session_start();
require_once("includes/config.php");
include("includes/header.php");

// Catégories principales
$categories = [
    'support' => 'Support',
    'dev' => 'Développement',
    'cyber' => 'Cybersécurité',
    'si' => 'Management de SI',
    'ia' => 'IA',
    'autres' => 'Autres'
];

$filtre = $_GET['cat'] ?? '';
$user_id = $_SESSION["user_id"] ?? null;
$role = $_SESSION["role"] ?? null;

// Requête selon filtre
if ($filtre && isset($categories[$filtre]) && $filtre !== 'autres') {
    $motcle = $categories[$filtre];
    $stmt = $pdo->prepare("
        SELECT a.*, u.nom AS recruteur
        FROM annonces a
        JOIN utilisateurs u ON u.id = a.recruteur_id
        WHERE a.titre LIKE ? OR a.description LIKE ?
        ORDER BY a.date_publication DESC
    ");
    $stmt->execute(["%$motcle%", "%$motcle%"]);
    $offres = $stmt->fetchAll();
} elseif ($filtre === 'autres') {
    $stmt = $pdo->query("
        SELECT a.*, u.nom AS recruteur
        FROM annonces a
        JOIN utilisateurs u ON u.id = a.recruteur_id
        WHERE titre NOT LIKE '%Support%'
          AND titre NOT LIKE '%Développement%'
          AND titre NOT LIKE '%Cybersécurité%'
          AND titre NOT LIKE '%SI%'
          AND titre NOT LIKE '%IA%'
        ORDER BY a.date_publication DESC
    ");
    $offres = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("
        SELECT a.*, u.nom AS recruteur
        FROM annonces a
        JOIN utilisateurs u ON u.id = a.recruteur_id
        ORDER BY a.date_publication DESC
    ");
    $offres = $stmt->fetchAll();
}

// Candidatures existantes
$mes_candidatures = [];
if ($user_id && $role === "candidat") {
    $stmt = $pdo->prepare("SELECT annonce_id FROM candidatures WHERE candidat_id = ?");
    $stmt->execute([$user_id]);
    $mes_candidatures = array_column($stmt->fetchAll(), 'annonce_id');
}
?>

<h1>Rechercher une alternance par catégorie</h1>

<!-- Filtres -->
<div class="form-container">
    <form method="get">
        <label>Catégorie</label>
        <select name="cat">
            <option value="">-- Toutes les offres --</option>
            <?php foreach ($categories as $key => $label): ?>
                <option value="<?= $key ?>" <?= ($filtre === $key) ? 'selected' : '' ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Rechercher</button>
    </form>
</div>

<!-- Résultat -->
<?php if (!empty($offres)): ?>
    <?php foreach ($offres as $o): ?>
        <div class="project">
            <h2><?= htmlspecialchars($o['titre']) ?></h2>
            <p><strong>Recruteur :</strong> <?= htmlspecialchars($o['recruteur']) ?> — <?= date("d/m/Y", strtotime($o['date_publication'])) ?></p>
            <p><?= nl2br(htmlspecialchars($o['description'])) ?></p>

            <?php if ($user_id && $role === "candidat"): ?>
                <?php if (in_array($o['id'], $mes_candidatures)): ?>
                    <a class="btn-contact" href="/projet_annuel/candidat/postuler.php?id=<?= $o['id'] ?>&action=retirer">Retirer ma candidature</a>
                <?php else: ?>
                    <a class="btn-contact" href="/projet_annuel/candidat/postuler.php?id=<?= $o['id'] ?>&action=postuler">Postuler</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="shortcut-box"><p>Aucune offre trouvée pour cette catégorie.</p></div>
<?php endif; ?>

<?php include("includes/footer.php"); ?>
