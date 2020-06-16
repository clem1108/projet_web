<?php
    include_once('../base_donnee/pdo.php');
    session_start();
    if(empty($_POST['nom']) or empty($_POST['description']) or empty($_POST['prix']) or empty($_POST['ville']) or empty($_POST['status']) or empty($_POST['categorie'])) {
        header('Location:../client/profil.php');
        exit;
    } else {
        $nom = htmlspecialchars($_POST['nom']);
        $description = htmlspecialchars($_POST['description']);
        $prix = htmlspecialchars($_POST['prix']);
        $ville = htmlspecialchars($_POST['ville']);
        $heure_local = getdate();
        $seconde = $heure_local['seconds'];
        $minute = $heure_local['minutes'];
        $heure = $heure_local['hours'];
        $jour = $heure_local['mday'];
        $mois = $heure_local['mon'];
        $annee = $heure_local['year'];
        $date = "$annee-$mois-$jour $heure:$minute:$seconde";
        $status = htmlspecialchars($_POST['status']);
        $categorie = htmlspecialchars($_POST['categorie']);
        $query1 = $pdo->prepare('SELECT * FROM clients');
        $query1->execute();
        $liste_clients = $query1->fetchAll();
        foreach ($liste_clients as $client) {
            $nom_client = $client['nom'];
            $prenom_client = $client['prenom'];
            if ($nom_client == $_SESSION['nom'] and $prenom_client == $_SESSION['prenom']) {
                $id_client = $client['id_client'];
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

            if (! file_exists($chemin)) {
                move_uploaded_file($_FILES["$image"]["tmp_name"], "$chemin");
            }
        }
    }
    $donnee = [
        'nom' => $nom,
        'description' => $description,
        'ville' => $ville,
        'prix' => $prix,
        'date' => $date,
        'status' => $status,
        'categorie' => $categorie,
        'id_client' => $id_client
    ];
    $requete = "INSERT INTO projet.annonces (nom, description, ville, prix, date, status, categorie, id_client) VALUES (:nom, :description, :ville, :prix, :date, :status, :categorie, :id_client)";
    $query2 = $pdo->prepare($requete);
    $query2->execute($donnee);
    header("Location:../client/profil.php");
    exit;
?>