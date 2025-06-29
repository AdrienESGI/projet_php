<?php
session_start();
require_once("includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "candidat") {
    header("Location: login.php");
    exit;
}

require_once("vendor/tcpdf/tcpdf.php");

$user_id = $_SESSION["user_id"];

$stmt = $pdo->prepare("SELECT nom, email FROM utilisateurs WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$profil = $pdo->prepare("SELECT * FROM profil_utilisateur WHERE utilisateur_id = ?");
$profil->execute([$user_id]);
$info = $profil->fetch();

$comp = $pdo->prepare("
    SELECT c.nom, uc.niveau
    FROM utilisateurs_competences uc
    JOIN competences c ON c.id = uc.competence_id
    WHERE uc.utilisateur_id = ?
    ORDER BY c.nom
");
$comp->execute([$user_id]);
$competences = $comp->fetchAll();

$xp = $pdo->prepare("SELECT * FROM experiences_professionnelles WHERE utilisateur_id = ? ORDER BY date_debut DESC");
$xp->execute([$user_id]);
$experiences = $xp->fetchAll();

class CustomPDF extends TCPDF {
    public function Header() {}
    public function Footer() {}
}

$pdf = new CustomPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetMargins(10, 10, 10);
$pdf->AddPage();

// === Bloc 1 : construire la colonne gauche dans un buffer ===
$colGauche = '';

$colGauche .= "<h2 style='text-align:center; font-size:14pt; font-weight:bold'>{$user['nom']}</h2>";
$colGauche .= "<p style='text-align:center; font-size:10pt'>{$user['email']}</p>";

if (!empty($info["ville"])) $colGauche .= "<p style='text-align:center'>{$info['ville']}</p>";
if (!empty($info["linkedin"])) $colGauche .= "<p style='text-align:center'><a href='{$info['linkedin']}'>{$info['linkedin']}</a></p>";
if (!empty($info["portfolio"])) $colGauche .= "<p style='text-align:center'><a href='{$info['portfolio']}'>{$info['portfolio']}</a></p>";

if ($competences) {
    $colGauche .= "<h3 style='text-align:center; font-size:12pt; margin-top:10px;'>Compétences</h3>";
    $colGauche .= "<ul style='font-size:9pt;'>";
    foreach ($competences as $c) {
        $stars = str_repeat("★", $c["niveau"]) . str_repeat("☆", 5 - $c["niveau"]);
        $colGauche .= "<li>{$c['nom']} {$stars}</li>";
    }
    $colGauche .= "</ul>";
}

$pdf->SetFillColor(245, 245, 245);
$pdf->Rect(10, 10, 60, 277, 'F');
$pdf->SetXY(10, 15);
$pdf->writeHTMLCell(60, 0, 10, 15, $colGauche, 0, 1, false, true, 'J', true);

// === Bloc 2 : colonne droite fluide ===
$pdf->SetXY(75, 15);
$colDroite = '';

if (!empty($info["objectif"])) {
    $colDroite .= "<h3 style='font-size:13pt;'>Profil professionnel</h3>";
    $colDroite .= "<p style='font-size:11pt;'>{$info["objectif"]}</p><br>";
}

if (!empty($info["ecole"]) || !empty($info["niveau_etude"])) {
    $colDroite .= "<h3 style='font-size:13pt;'>Formation</h3><ul style='font-size:11pt;'>";
    if (!empty($info["niveau_etude"])) $colDroite .= "<li>Niveau : {$info["niveau_etude"]}</li>";
    if (!empty($info["ecole"])) $colDroite .= "<li>École : {$info["ecole"]}</li>";
    $colDroite .= "</ul><br>";
}

if ($experiences && count($experiences) > 0) {
    $colDroite .= "<h3 style='font-size:13pt;'>Expériences professionnelles</h3>";
    foreach ($experiences as $xp) {
        $date = "{$xp['date_debut']} → " . ($xp['date_fin'] ?: "Aujourd’hui");
        $desc = !empty($xp["description"]) ? "<p>{$xp['description']}</p>" : "";
        $colDroite .= "<p><strong>{$xp['poste']} — {$xp['entreprise']}</strong><br><em>{$date}</em>{$desc}</p>";
    }
}

$pdf->writeHTMLCell(0, 0, 75, 15, $colDroite, 0, 1, false, true, 'L', true);

// Export
$pdf->Output("cv_" . strtolower(str_replace(" ", "_", $user["nom"])) . ".pdf", "I");
?>
