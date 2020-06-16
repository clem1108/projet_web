<?php
include_once('../base_donnee/pdo.php');
if(empty($_POST['nom']) or empty($_POST['prenom'])) {
    header('Location:../admin/index_admin.php');
    exit;
}
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$nom_dossier = strtolower($nom . '_' . $prenom);
$dossier = getcwd() . '/' . $nom_dossier;
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
$query1=$pdo->prepare($requete);
$query1->execute();
header('Location: ../admin/index_admin.php');
exit;
?>