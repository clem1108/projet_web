<?php
    include_once('../base_donnee/pdo.php');
    session_start();
    if(empty($_POST['nom']) or empty($_POST['prenom']) or empty($_POST['email']) or empty($_POST['mot_passe'])) {
        header('Location:../client/formulaire_inscription_client.php');
        exit;
    } else {
        $_SESSION['IS_CONNECTED'] = TRUE;
        $_SESSION['nom'] = htmlspecialchars($_POST['nom']);
        $_SESSION['prenom'] = htmlspecialchars($_POST['prenom']);
        $_SESSION['adresse_mail'] = htmlspecialchars($_POST['email']);
        $mot_passe = $_POST['mot_passe'];
        $telephone = htmlspecialchars($_POST['telephone']);
        $donnee = [
            'nom' => $_SESSION['nom'],
            'prenom' => $_SESSION['prenom'],
            'adresse_mail' => $_SESSION['adresse_mail'],
            'mot_passe' => password_hash($mot_passe, PASSWORD_DEFAULT),
            'telephone' => $telephone,
        ];
        $requete = "INSERT INTO projet.clients (nom, prenom, adresse_mail, mot_passe, telephone) VALUES (:nom, :prenom, :adresse_mail, :mot_passe, :telephone)";
        $query1 = $pdo->prepare($requete);
        $query1->execute($donnee);
        $nom = $_SESSION['nom'];
        $prenom = $_SESSION['prenom'];
        $ancien_fichier = $_FILES['image_profil']['name'];
        $fichier = pathinfo($ancien_fichier);
        if (! empty($fichier['basename'])) {
            $nom_fichier = strtolower(str_replace($fichier['filename'], 'image_profil', $ancien_fichier));
            $nom_dossier = strtolower($nom . '_' . $prenom);
            $extension = strtolower($fichier['extension']);
            $dossier = getcwd() . '/../' . $nom_dossier;
            if ($extension != 'jpg' and $extension != 'jpeg' and $extension != 'png') {
                header('Location:../client/profil.php');
                exit;
            }
            if (! file_exists($nom_dossier)) {
                mkdir($dossier, 0777);
            }
            $chemin = $dossier . '/' . $nom_fichier;
            if (! file_exists($chemin)) {
                    move_uploaded_file($_FILES['image_profil']["tmp_name"], "$chemin");
            }
        }
        $_SESSION['table'] = 'client';
        if (!isset($_SESSION['annonce'])) {
            header("Location:../affichage/index.php");
            exit;
        }
        if (!isset($_SESSION['parametre'])) {
            header("Location:../affichage/index.php");
            exit;
        }
        $parametre = $_SESSION['parametre'];
        header("Location:../annonce/annonce.php?$parametre");
        exit;
    }
?>