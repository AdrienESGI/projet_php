<?php
session_start();
require_once("includes/config.php");
include("includes/header.php");

// Récupération utilisateur connecté
$user_id = $_SESSION["user_id"] ?? null;
$role = $_SESSION["role"] ?? null;

// Liste des compétences
$competences = $pdo->query("SELECT * FROM competences ORDER BY categorie, nom")->fetchAll();

// Filtres
$competence_id = $_GET['competence'] ?? '';
$niveau = $_GET['niveau'] ?? '';
$filtre_active = $competence_id && $niveau;

// Offres
if ($filtre_active) {
    $stmt = $pdo->prepare("
        SELECT DISTINCT a.*, u.nom AS recruteur
        FROM annonces a
        JOIN utilisateurs u ON u.id = a.recruteur_id
        JOIN annonces_competences ac ON a.id = ac.annonce_id
        WHERE ac.competence_id = ? AND ac.niveau_minimum <= ?
        ORDER BY a.date_publication DESC
    ");
    $stmt->execute([$competence_id, $niveau]);
} else {
    $stmt = $pdo->query("
        SELECT a.*, u.nom AS recruteur
        FROM annonces a
        JOIN utilisateurs u ON u.id = a.recruteur_id
        ORDER BY a.date_publication DESC
    ");
}
$offres = $stmt->fetchAll();

// Récupérer les candidatures de l'utilisateur
$mes_candidatures = [];
if ($user_id && $role === "candidat") {
    $candidats_stmt = $pdo->prepare("SELECT annonce_id FROM candidatures WHERE candidat_id = ?");
    $candidats_stmt->execute([$user_id]);
    $mes_candidatures = array_column($candidats_stmt->fetchAll(), 'annonce_id');
}
?>

<h1>Offres d'alternance IT</h1>

<!-- Formulaire de recherche -->
<div class="form-container">
    <form method="get" action="offres.php">
        <label>Compétence</label>
        <select name="competence" required>
            <option value="">-- Choisir --</option>
            <?php foreach ($competences as $c): ?>
                <option value="<?= $c['id'] ?>" <?= ($c['id'] == $competence_id) ? 'selected' : '' ?>>
                    <?= $c['categorie'] ?> — <?= $c['nom'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Niveau minimum requis</label>
        <select name="niveau" required>
            <option value="">-- Niveau --</option>
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>" <?= ($i == $niveau) ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>

        <button type="submit">Rechercher</button>
    </form>
</div>

<?php if ($filtre_active): ?>
    <div class="presentation-box">
        <p>🔎 Résultats pour la compétence <strong><?= $competences[array_search($competence_id, array_column($competences, 'id'))]['nom'] ?? '' ?></strong> (niveau ≥ <?= $niveau ?>)</p>
    </div>
<?php endif; ?>

<!-- Affichage des offres -->
<?php foreach ($offres as $o): ?>
    <div class="project">
        <h2><?= htmlspecialchars($o['titre']) ?></h2>
        <p><strong>Publié par :</strong> <?= htmlspecialchars($o['recruteur']) ?> — <?= date("d/m/Y", strtotime($o['date_publication'])) ?></p>
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

<?php include("includes/footer.php"); ?>
