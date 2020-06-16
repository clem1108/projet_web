<?php
session_start();
include_once('../base_donnee/pdo.php');
$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$nom_dossier = strtolower($nom . '_' . $prenom);
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
$requete = "DELETE FROM clients WHERE nom = \"$nom\" AND prenom = \"$prenom\"";
$query1 = $pdo->prepare($requete);
$query1->execute();
$_SESSION['IS_CONNECTED'] = FALSE;
if (isset($_SESSION['nom'])) {
    unset($_SESSION['nom']);
}
if (isset($_SESSION['prenom'])) {
    unset($_SESSION['prenom']);
}
if (isset($_SESSION['email'])) {
    unset($_SESSION['email']);
}
if (isset($_SESSION['table'])) {
    unset($_SESSION['table']);
}
if (isset($_SESSION['annonce'])) {
    unset($_SESSION['annonce']);
}
if (isset($_SESSION['parametre'])) {
    unset($_SESSION['parametre']);
}
if (isset($_SESSION['id_proprietaire'])) {
    unset($_SESSION['id_proprietaire']);
}
if (isset($_SESSION['id_annonce'])) {
    unset($_SESSION['id_annonce']);
}
if (isset($_SESSION['nom_annonce'])) {
    unset($_SESSION['nom_annonce']);
}
if (isset($_SESSION['prix_annonce'])) {
    unset($_SESSION['prix_annonce']);
}
if (isset($_SESSION['mes_annonces'])) {
    unset($_SESSION['mes_annonces']);
}
if (isset($_SESSION['recherche'])) {
    unset($_SESSION['recherche']);
}
header('Location: ../affichage/index.php');
exit;
?>