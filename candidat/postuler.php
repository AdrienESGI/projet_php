<?php
session_start();
require_once("../includes/config.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "candidat") {
    header("Location: /projet_annuel/login.php");
    exit;
}

$candidat_id = $_SESSION["user_id"];
$annonce_id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
$action = $_GET["action"] ?? "postuler";

// Vérifie que l'annonce existe
$stmt = $pdo->prepare("SELECT * FROM annonces WHERE id = ?");
$stmt->execute([$annonce_id]);
$annonce = $stmt->fetch();

if (!$annonce) {
    header("Location: /projet_annuel/candidat/candidatures.php?msg=Offre introuvable.");
    exit;
}

// Vérifie si le candidat a déjà postulé
$check = $pdo->prepare("SELECT id FROM candidatures WHERE candidat_id = ? AND annonce_id = ?");
$check->execute([$candidat_id, $annonce_id]);
$existe = $check->fetch();

if ($action === "postuler") {
    if (!$existe) {
        $insert = $pdo->prepare("INSERT INTO candidatures (candidat_id, annonce_id) VALUES (?, ?)");
        $insert->execute([$candidat_id, $annonce_id]);
        $message = "✅ Candidature envoyée.";
    } else {
        $message = "⚠️ Vous avez déjà postulé à cette offre.";
    }
} elseif ($action === "retirer") {
    if ($existe) {
        $delete = $pdo->prepare("DELETE FROM candidatures WHERE candidat_id = ? AND annonce_id = ?");
        $delete->execute([$candidat_id, $annonce_id]);
        $message = "❌ Candidature retirée avec succès.";
    } else {
        $message = "⚠️ Vous n'avez pas postulé à cette offre.";
    }
} else {
    $message = "⚠️ Action invalide.";
}

header("Location: /projet_annuel/candidat/candidatures.php?msg=" . urlencode($message));
exit;
