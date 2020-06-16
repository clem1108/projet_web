<?php
    session_start();
    include_once('../base_donnee/pdo.php');
    if (! $_SESSION['IS_CONNECTED']) {
        header('Location:../affichage/index.php');
        exit;
    }
    $texte = $_POST['message'];
    $id_acheteur = $_POST['id'];
    $id_proprietaire = $_SESSION['id_proprietaire'];
    $id_annonce = $_SESSION['id_annonce'];
    $donnee = [
        'id_proprietaire' => $id_proprietaire,
        'id_acheteur' => $id_acheteur,
        'id_annonce' => $id_annonce
    ];
    $query1 = $pdo->prepare('SELECT * FROM messagerie');
    $query1->execute();
    $liste_messagerie = $query1->fetchAll();
    $present = FALSE;
    foreach ($liste_messagerie as $messagerie) {
        $id_proprietaire_test = $messagerie['id_proprietaire'];
        $id_acheteur_test = $messagerie['id_acheteur'];
        $id_annonce_test = $messagerie['id_annonce'];
        if ($id_proprietaire_test == $id_proprietaire and $id_acheteur_test == $id_acheteur and $id_annonce_test == $id_annonce) {
            $present = TRUE;
        }
    }
    if (! $present) {
        $requete = "INSERT INTO projet.messagerie (id_proprietaire, id_acheteur, id_annonce) VALUES (:id_proprietaire, :id_acheteur, :id_annonce)";
        $query2 = $pdo->prepare($requete);
        $query2->execute($donnee);
    }
    $query3 = $pdo->prepare('SELECT * FROM messagerie');
    $query3->execute();
    $liste_messagerie = $query3->fetchAll();
    foreach ($liste_messagerie as $messagerie) {
        $id_proprietaire_test = $messagerie['id_proprietaire'];
        $id_acheteur_test = $messagerie['id_acheteur'];
        $id_annonce_test = $messagerie['id_annonce'];
        if ($id_proprietaire_test == $id_proprietaire and $id_acheteur_test == $id_acheteur and $id_annonce_test == $id_annonce) {
            $id_messagerie = $messagerie['id_messagerie'];
        }
    }
    $query4 = $pdo->prepare('SELECT * FROM clients');
    $query4->execute();
    $liste_clients = $query4->fetchAll();
    foreach ($liste_clients as $client) {
        $nom_test = $client['nom'];
        $prenom_test = $client['prenom'];
        if ($nom_test == $_SESSION['nom'] and $prenom_test == $_SESSION['prenom']) {
            $id_client = $client['id_client'];
        }
    }
    if ($id_proprietaire == $id_client) {
        $donnee_message = [
            'id_client' => $id_proprietaire,
            'id_messagerie' => $id_messagerie,
            'texte' => $texte
        ];
    } else {
        $donnee_message = [
            'id_client' => $id_acheteur,
            'id_messagerie' => $id_messagerie,
            'texte' => $texte
        ];
    }
    $requete_message = "INSERT INTO projet.messages (id_client, id_messagerie, texte) VALUES (:id_client, :id_messagerie, :texte)";
    $query5 = $pdo->prepare($requete_message);
    $query5->execute($donnee_message);
    $parametre = $_SESSION['parametre'];
    if ($id_proprietaire != $id_acheteur) {
        header("Location:../message/formulaire_message.php?id_client=$id_acheteur");
        exit;
    } else {
        header("Location:../message/formulaire_message.php");
        exit;
    }
?>