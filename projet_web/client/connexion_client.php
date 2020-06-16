<?php
    session_start();
    include_once('../base_donnee/pdo.php');
    if(empty($_POST['email']) or empty($_POST['mot_passe'])) {
        header('Location:../client/formulaire_connexion.php');
        exit;
    } else {
        $query1 = $pdo->prepare('SELECT * FROM clients');
        $query1->execute();
        $liste_clients = $query1->fetchAll();
        foreach ($liste_clients as $client) {
            $email = $client['adresse_mail'];
            $mot_passe = $client['mot_passe'];
            if ($_POST['email'] == $email and password_verify($_POST['mot_passe'], $mot_passe)) {
                $_SESSION['IS_CONNECTED'] = TRUE;
                $_SESSION['nom'] = $client['nom'];
                $_SESSION['prenom'] = $client['prenom'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['table'] = 'client';
                if (!isset($_SESSION['annonce'])) {
                    header("Location:../affichage/index.php");
                    exit;
                } else {
                    $parametre = $_SESSION['parametre'];
                    header("Location:../annonce/annonce.php?$parametre");
                    exit;
                }
            }
        }
        header("Location:../client/formulaire_connexion.php");
        exit;
    }
?>