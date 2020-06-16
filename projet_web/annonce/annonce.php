<?php
    session_start();
    include_once('../base_donnee/pdo.php');
    if (! $_SESSION['IS_CONNECTED']) {
        header('Location:../client/formulaire_connexion.php');
        exit;
    }
    $_SESSION['annonce'] = TRUE;
    $nom = $_GET['nom'];
    $description = $_GET['description'];
    $date = $_GET['date'];
    $prix = $_GET['prix'];
    $ville = $_GET['ville'];
    $status = $_GET['status'];
    $categorie = $_GET['categorie'];
    $id = $_GET['id'];
    $_SESSION['id_proprietaire'] = $id;
    $parametre = "nom=$nom&description=$description&prix=$prix&date=$date&status=$status&ville=$ville&categorie=$categorie&id=$id";
    $_SESSION['parametre'] = $parametre;
    $query1 = $pdo->prepare('SELECT * FROM clients');
    $query1->execute();
    $liste_clients = $query1->fetchAll();
    foreach ($liste_clients as $client) {
        $id_test = $client['id_client'];
        if ($id_test == $id) {
            $nom_prenom_vendeur = $client['nom'] . ' ' . $client['prenom'];
        }
    }
    $query2 = $pdo->prepare('SELECT * FROM annonces');
    $query2->execute();
    $liste_annonces = $query2->fetchAll();
    foreach ($liste_annonces as $annonce) {
        $nom_test = $annonce['nom'];
        $prix_test = $annonce['prix'];
        $ville_test = $annonce['ville'];
        if ($nom_test == $nom and $prix_test == $prix and $ville_test == $ville) {
            $_SESSION['id_annonce'] = $annonce['id_annonce'];
        }
    }
    $query3 = $pdo->prepare('SELECT * FROM clients');
    $query3->execute();
    $liste_clients = $query3->fetchAll();
    foreach ($liste_clients as $client) {
        $nom_test = $client['nom'];
        $prenom_test = $client['prenom'];
        if ($nom_test == $_SESSION['nom'] and $prenom_test == $_SESSION['prenom']) {
            $id_acheteur = $client['id_client'];
        }
    }
    $nom_dossier = getcwd() . '/../' . strtolower($nom . '_' . $ville);
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
        if (isset($ensemble_nom_fichier[0])) {
            $nom_fichier_1 = $ensemble_nom_fichier[0];
            $nom_dossier_fichier = $nom_dossier . '/' . $nom_fichier_1;
            $fichier = pathinfo($nom_dossier_fichier);
            $extension_1 = $fichier['extension'];
        }
        if (isset($ensemble_nom_fichier[1])) {
            $nom_fichier_2 = $ensemble_nom_fichier[1];
            $nom_dossier_fichier = $nom_dossier . '/' . $nom_fichier_2;
            $fichier = pathinfo($nom_dossier_fichier);
            $extension_2 = $fichier['extension'];
        }
        if (isset($ensemble_nom_fichier[2])) {
            $nom_fichier_3 = $ensemble_nom_fichier[2];
            $nom_dossier_fichier = $nom_dossier . '/' . $nom_fichier_3;
            $fichier = pathinfo($nom_dossier_fichier);
            $extension_3 = $fichier['extension'];
        }
    }
    $nom_dossier_image = "../" . strtolower($nom . '_' . $ville);
?>

<!DOCTYPE html>
<html>
<head>
    <title>La Bonne Zone | Annonce</title>
    <link rel="stylesheet" href="../css/main.css" type='text/css'>
</head>
<body>
    <div id="content">
        <header>
            <img class="logo" src="../img/zone.svg" alt="Image Logo">
            <a class="home" href="../affichage/index.php"><img  src="../img/home.svg" alt="logo d'accueil"></a>
            <a class="txthead" href="../affichage/index.php"><p>Accueil</p></a>
            <img class="panier" src="../img/panier.svg" alt="image panier">
            <p class="txthead1">Achat</p>
            <a class="login1" href="../client/profil.php"><img src="../img/profil.svg" alt="image profil"></a>
            <a class="txthead2" href="../client/profil.php"><p>Profil</p></a>
            <?php
            if ($_SESSION['table'] == 'admin') {
            ?>
                <button class="retour" onclick="window.location.href = '../admin/index_admin.php';">Retour</button>
            <?php
            } elseif (isset($_SESSION['mes_annonces'])) {
            ?>
                <button class="retour" onclick="window.location.href = '../annonce/mes_annonces.php';">Retour</button>
            <?php
            } elseif (isset($_SESSION['recherche'])) {
                $mot_cle_lien = $_SESSION['recherche']['mot_cle'];
                $ville_lien = $_SESSION['recherche']['ville'];
                $categorie_lien = $_SESSION['recherche']['categorie'];
                $prix_min_lien = $_SESSION['recherche']['prix_min'];
                $prix_max_lien = $_SESSION['recherche']['prix_max'];
                $parametre_recherche = "mot_cle=$mot_cle_lien&ville=$ville_lien&categorie=$categorie_lien&prix_min=$prix_min_lien&prix_max=$prix_max_lien"
            ?>
                <button class="retour" onclick="window.location.href = '../affichage/recherche.php?<?php echo $parametre_recherche?>';">Retour</button>
            <?php
            } else {
            ?>
                <button class="retour" onclick="window.location.href = '../affichage/index.php';">Retour</button>
            <?php
            }
            ?>
        </header>
        <h1 class="titreannonce"><?php echo "$nom"; ?></h1>
        <div id="pageannonce">
            <?php
            if (isset($extension_1)) {
            ?>
            <div id="imgannonce1">
                <img class="imgannonce1" src='<?php echo "$nom_dossier_image/image1.$extension_1" ; ?>' />
            </div>
            <?php
            }
            if (isset($extension_2)) {
            ?>
            <div id="imgannonce2">
                <img class="imgannonce2" src='<?php echo "$nom_dossier_image/image2.$extension_2" ; ?>' />
            </div>
            <?php
            }
            if (isset($extension_3)) {
            ?>
            <div id="imgannonce3">
                <img class="imgannonce3" src='<?php echo "$nom_dossier_image/image3.$extension_3" ; ?>' />
            </div>
            <?php
            }
            if (isset($id_acheteur) and $id_acheteur != $id) {
                ?>
                <div id="profilvendeur">
                    <button class="profilvendeur" onclick="window.location.href = '../client/profil_proprietaire.php';">Profil Vendeur</button>
                </div>
                <div id="sendmessage">
                    <button class="sendmessage" onclick="window.location.href = '../message/formulaire_message.php';">Envoyer un message</button>
                </div>
            <?php } else {
                    $query4 = $pdo->prepare('SELECT * FROM messagerie');
                    $query4->execute();
                    $liste_messagerie = $query4->fetchAll();
                    foreach ($liste_messagerie as $messagerie) {
                        $id_annonce_test = $messagerie['id_annonce'];
                        $id_proprietaire_test = $messagerie['id_proprietaire'];
                        if ($id_proprietaire_test == $_SESSION['id_proprietaire'] and $id_annonce_test == $_SESSION['id_annonce']) {
                            $messagerie_presente = TRUE;
                        }
                    }
                if (isset($messagerie_presente) and $_SESSION['table'] == 'client') {?>
                    <div id="sendmessage">
                        <button class="sendmessage" onclick="window.location.href = '../message/selection_reponse.php';">Repondre</button>
                    </div>
                <?php }
                } ?>
            <div id="descannonce">
                <h2 class="descannonce">Description Annonce </h2>
            </div>
            <div id="descannonce2">
                <p class="descannonce2"><?php echo $description; ?></p>
            </div>
            <div id="miseenligne">
                <p class="miseenligne">Mise en ligne le <?php echo date('j F Y à H:i:s', strtotime($date)); ?></p>
            </div>
            <div id="nomvendeur">
                <p class="nomvendeur"> Vendu par <?php echo $nom_prenom_vendeur; ?></p>
            </div>
            <div id="ville">
                <p class="ville"> Ville <?php echo $ville; ?></p>
            </div>
            <div id="catannonce">
                <p class="catannonce"> Catégorie: <?php echo $categorie; ?></p>
            </div>
            <div id="prixannonce">
                <p class="prixannonce"><?php echo $prix; ?> €</p>
            </div>
            <?php
            if (isset($id_acheteur) and $id_acheteur == $id) {
            ?>
                <div id="annoncestatus">
                    <p class="annoncestatus">Annonce <?php echo $status; ?></p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>