<?php
session_start();
include_once('../base_donnee/pdo.php');
if(empty($_POST['nom']) or empty($_POST['prix']) or empty($_POST['ville']) or empty($_POST['description']) or empty($_POST['status']) or empty($_POST['categorie'])) {
    unset($_SESSION['nom_annonce']);
    unset($_SESSION['prix_annonce']);
    if ($_SESSION['table'] == 'client') {
        header('Location: ../client/profil.php');
        exit;
    } else {
        header('Location: ../admin/index_admin.php');
        exit;
    }
}
$ancien_nom = $_SESSION['nom_annonce'];
$ancien_prix = $_SESSION['prix_annonce'];
$nom = htmlspecialchars($_POST['nom']);
$ville = htmlspecialchars($_POST['ville']);
$prix = htmlspecialchars($_POST['prix']);
$heure_local = getdate();
$seconde = $heure_local['seconds'];
$minute = $heure_local['minutes'];
$heure = $heure_local['hours'];
$jour = $heure_local['mday'];
$mois = $heure_local['mon'];
$annee = $heure_local['year'];
$date = "$annee-$mois-$jour $heure:$minute:$seconde";
$description = htmlspecialchars($_POST['description']);
$status = htmlspecialchars($_POST['status']);
$categorie = htmlspecialchars($_POST['categorie']);

$query1 = $pdo->prepare('SELECT * FROM annonces');
$query1->execute();
$liste_annonces = $query1->fetchAll();
foreach ($liste_annonces as $annonce) {
    $nom_test = $annonce['nom'];
    $prix_test = $annonce['prix'];
    if ($_SESSION['nom_annonce'] == $nom_test and $_SESSION['prix_annonce'] == $prix_test) {
        $id = $annonce['id_client'];
        $ancienne_ville = $annonce['ville'];
    }
}
if ($_SESSION['table'] == 'client') {
    $query2 = $pdo->prepare('SELECT * FROM clients');
    $query2->execute();
    $liste_clients = $query2->fetchAll();
    foreach ($liste_clients as $client) {
        $nom_client = $client['nom'];
        $prenom_client = $client['prenom'];
        if ($nom_client == $_SESSION['nom'] and $prenom_client == $_SESSION['prenom']) {
            $id_client = $client['id_client'];
        }
    }
    if ($id_client != $id) {
        header('Location: ../client/profil.php');
        exit;
    }
}
$nom_dossier = getcwd() . '/../' . strtolower($ancien_nom . '_' . $ancienne_ville);
if (file_exists($nom_dossier)) {
    $ensemble_fichier = scandir($nom_dossier);
    $ensemble_nom_fichier = array();
    foreach($ensemble_fichier as $fichier) {
        if (substr($fichier, 0, 6) == 'image1') {
            $ensemble_nom_fichier[0] = $fichier;
        }
        if (substr($fichier, 0, 6) == 'image2') {
            $ensemble_nom_fichier[1] = $fichier;
        }
        if (substr($fichier, 0, 6) == 'image3') {
            $ensemble_nom_fichier[2] = $fichier;
        }
    }
    if ($ancien_nom != $nom or $ancienne_ville != $ville) {
        $nouveau_nom_dossier = getcwd() . '/../' . strtolower($nom . '_' . $ville);
        if (! file_exists($nouveau_nom_dossier)) {
            mkdir($nouveau_nom_dossier, 0777);
        }
        if (isset($ensemble_nom_fichier[0])) {
            $nom_fichier_1 = $ensemble_nom_fichier[0];
            $nom_dossier_fichier = $nom_dossier . '/' . $nom_fichier_1;
            $nouveau_nom_dossier_fichier = $nouveau_nom_dossier . '/' . $nom_fichier_1;
            rename($nom_dossier_fichier, "$nouveau_nom_dossier_fichier");
        }
        if (isset($ensemble_nom_fichier[1])) {
            $nom_fichier_2 = $ensemble_nom_fichier[1];
            $nom_dossier_fichier = $nom_dossier . '/' . $nom_fichier_2;
            $nouveau_nom_dossier_fichier = $nouveau_nom_dossier . '/' . $nom_fichier_2;
            rename($nom_dossier_fichier, "$nouveau_nom_dossier_fichier");
        }
        if (isset($ensemble_nom_fichier[2])) {
            $nom_fichier_3 = $ensemble_nom_fichier[2];
            $nom_dossier_fichier = $nom_dossier . '/' . $nom_fichier_3;
            $nouveau_nom_dossier_fichier = $nouveau_nom_dossier . '/' . $nom_fichier_3;
            rename($nom_dossier_fichier, "$nouveau_nom_dossier_fichier");
        }
        rmdir($nom_dossier);
    }
    $nom_dossier = getcwd() . '/../' . strtolower($nom . '_' . $ville);
    if (! empty($_FILES['image1']["tmp_name"])) {
        $fichier_1 = pathinfo($_FILES['image1']["tmp_name"]);
        $extension_1 = $fichier_1['extension'];
        if (isset($ensemble_nom_fichier[0]) and $extension_1 == 'jpg' or $extension_1 == 'jpeg' or $extension_1 == 'png') {
            $nom_fichier_1 = $ensemble_nom_fichier[0];
            $nom_dossier_fichier = $nom_dossier . '/' . $nom_fichier_1;
            unlink($nom_dossier_fichier);
        }
    }
    if (! empty($_FILES['image2']["tmp_name"])) {
        $fichier_2 = pathinfo($_FILES['image2']["tmp_name"]);
        $extension_2 = $fichier_2['extension'];
        if (isset($ensemble_nom_fichier[1]) and $extension_2 == 'jpg' or $extension_2 == 'jpeg' or $extension_2 == 'png') {
            $nom_fichier_2 = $ensemble_nom_fichier[1];
            $nom_dossier_fichier = $nom_dossier . '/' . $nom_fichier_2;
            unlink($nom_dossier_fichier);
        }
    }
    if (! empty($_FILES['image3']["tmp_name"])) {
        $fichier_3 = pathinfo($_FILES['image3']["tmp_name"]);
        $extension_3 = $fichier_3['extension'];
        if (isset($ensemble_nom_fichier[2]) and $extension_3 == 'jpg' or $extension_3 == 'jpeg' or $extension_3 == 'png') {
            $nom_fichier_3 = $ensemble_nom_fichier[2];
            $nom_dossier_fichier = $nom_dossier . '/' . $nom_fichier_3;
            unlink($nom_dossier_fichier);
        }
    }
}
for($index = 1; $index <= 3; $index++) {
    $image = 'image' . $index;
    $ancien_fichier = $_FILES[$image]['name'];
    $fichier = pathinfo($ancien_fichier);
    if (! empty($fichier['basename'])) {
        $nom_fichier = strtolower(str_replace($fichier['filename'], $image, $ancien_fichier));
        $nom_dossier = strtolower($nom . '_' . $ville);
        $extension = strtolower($fichier['extension']);
        $dossier = getcwd() . '/../' . $nom_dossier;
        if ($extension != 'jpg' and $extension != 'jpeg' and $extension != 'png') {
            continue;
        }
        if (! file_exists($dossier)) {
            mkdir($dossier, 0777);
        }
        $chemin = $dossier . '/' . $nom_fichier;
        move_uploaded_file($_FILES[$image]["tmp_name"], "$chemin");
    }
}
$query3 = $pdo->prepare("UPDATE projet.annonces SET nom=\"$nom\", description=\"$description\", prix=\"$prix\", id_client=\"$id\", date=\"$date\", ville=\"$ville\", categorie=\"$categorie\", status=\"$status\" WHERE nom=\"$ancien_nom\" AND prix=\"$ancien_prix\";");
$query3->execute();
if ($_SESSION['table'] == 'client') {
    header('Location: ../annonce/mes_annonces.php');
    exit;
} else {
    header('Location: ../admin/index_admin.php');
    exit;
}
?>