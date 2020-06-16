<?php
session_start();
include_once('../base_donnee/pdo.php');
if(empty($_POST['nom']) or empty($_POST['prix'])) {
    if ($_SESSION['table'] == 'client') {
        header('Location:../annonce/mes_annonces.php');
        exit;
    } else {
        header('Location:../admin/index_admin.php');
        exit;
    }
}
$nom = htmlspecialchars($_POST['nom']);
$prix = htmlspecialchars($_POST['prix']);

$query1 = $pdo->prepare('SELECT * FROM annonces');
$query1->execute();
$liste_annonces = $query1->fetchAll();
foreach ($liste_annonces as $annonce) {
    $nom_test = $annonce['nom'];
    $prix_test = $annonce['prix'];
    if ($nom == $nom_test and $prix == $prix_test) {
        $ville = $annonce['ville'];
    }
}
$nom_dossier = strtolower($nom . '_' . $ville);
$dossier = getcwd() . '/../' . $nom_dossier;
if (file_exists($dossier)) {
    $objets = scandir($dossier);
    foreach ($objets as $objet) {
        if ($objet != "." and $objet != "..") {
            unlink($dossier . '/' . $objet);
        }
    }
    reset($objets);
    rmdir($dossier);
}
$requete = "DELETE FROM annonces WHERE nom = \"$nom\" AND prix = \"$prix\"";
$query2=$pdo->prepare($requete);
$query2->execute();
if ($_SESSION['table'] == 'client') {
    header('Location: ../annonce/mes_annonces.php');
    exit;
} else {
    header('Location: ../admin/index_admin.php');
    exit;
}
?>