<?php
    session_start();
    include_once('../base_donnee/pdo.php');
    $ancien_nom = $_SESSION['nom'];
    $ancien_prenom = $_SESSION['prenom'];
    $query1 = $pdo->prepare('SELECT * FROM clients');
    $query1->execute();
    $liste_clients = $query1->fetchAll();
    foreach ($liste_clients as $client) {
        if ($client['nom'] == $ancien_nom) {
            $ancien_mot_passe = $client['mot_passe'];
        }
    }
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    if ($_POST['mot_passe'] != $ancien_mot_passe) {
        $mot_passe = password_hash($_POST['mot_passe'], PASSWORD_DEFAULT);
    } else {
        $mot_passe = $ancien_mot_passe;
    }
    $telephone = htmlspecialchars($_POST['telephone']);
    $query2 = $pdo->prepare("UPDATE projet.clients SET nom=\"$nom\", prenom=\"$prenom\", mot_passe=\"$mot_passe\", telephone=\"$telephone\", adresse_mail=\"$email\"  WHERE nom=\"$ancien_nom\" AND prenom=\"$ancien_prenom\";");
    $query2->execute();
    $query3 = $pdo->prepare('SELECT * FROM clients');
    $query3->execute();
    $liste_clients = $query3->fetchAll();
    foreach ($liste_clients as $client) {
        if ($client['nom'] == $nom) {
            $_SESSION['nom'] = $client['nom'];
            $_SESSION['prenom'] = $client['prenom'];
            $_SESSION['email'] = $client['adresse_mail'];
        }
    }
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $ancien_fichier = $_FILES['image_profil']['name'];
    $fichier = pathinfo($ancien_fichier);
    $nom_dossier = strtolower($ancien_nom . '_' . $ancien_prenom);
    $dossier = getcwd() . '/../' . $nom_dossier;
    if (file_exists($dossier)) {
        $ensemble_fichier = scandir($dossier);
        $ensemble_nom_fichier = array();
        foreach($ensemble_fichier as $fichier) {
            if (substr($fichier, 0, 12) == 'image_profil') {
                $ensemble_nom_fichier[0] = $fichier;
            }
        }
        if ($ancien_nom != $nom or $ancien_prenom != $prenom) {
            $nouveau_nom_dossier = getcwd() . '/../' . strtolower($nom . '_' . $prenom);
            if (! file_exists($nouveau_nom_dossier)) {
                mkdir($nouveau_nom_dossier, 0777);
            }
            if (isset($ensemble_nom_fichier[0])) {
                $nom_fichier_1 = $ensemble_nom_fichier[0];
                $nom_dossier_fichier = $dossier . '/' . $nom_fichier_1;
                $nouveau_nom_dossier_fichier = $nouveau_nom_dossier . '/' . $nom_fichier_1;
                rename($nom_dossier_fichier, "$nouveau_nom_dossier_fichier");
            }
            rmdir($dossier);
        }
        $dossier = getcwd() . '/../' . strtolower($nom . '_' . $prenom);
        if (! empty($_FILES['image_profil']["tmp_name"])) {
            $fichier = pathinfo($_FILES['image_profil']['name']);
            $extension = $fichier['extension'];
            if (isset($ensemble_nom_fichier[0]) and $extension == 'jpg' or $extension == 'jpeg' or $extension == 'png') {
                $nom_fichier = $ensemble_nom_fichier[0];
                $nom_dossier_fichier = $dossier . '/' . $nom_fichier;
                unlink($nom_dossier_fichier);
            }
        }
    }
    $fichier = pathinfo($_FILES['image_profil']['name']);
    if (! empty($fichier['basename'])) {
        $nom_fichier = strtolower(str_replace($fichier['filename'], 'image_profil', $ancien_fichier));
        $extension = strtolower($fichier['extension']);
        $nom_dossier = strtolower($nom . '_' . $prenom);
        $dossier = getcwd() . '/../' . $nom_dossier;
        if (! file_exists($dossier)) {
            mkdir($dossier, 0777);
        }
        $chemin = $dossier . '/' . $nom_fichier;
        if (! file_exists($chemin) and $extension == 'jpg' or $extension == 'jpeg' or $extension == 'png') {
                move_uploaded_file($_FILES['image_profil']["tmp_name"], "$chemin");
        }
    }
    header('Location:../client/profil.php');
    exit;
?>