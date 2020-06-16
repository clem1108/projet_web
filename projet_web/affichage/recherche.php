<?php
    session_start();
    include_once('../base_donnee/pdo.php');
    if (! $_SESSION['IS_CONNECTED']) {
        header('Location:../affichage/index.php');
        exit;
    }
    if (empty($_POST['prix_min']) and empty($_POST['prix_max']) and empty($_POST['mot_cle']) and empty($_POST['ville']) and empty($_POST['categorie']) and empty($_GET['prix_min']) and empty($_GET['prix_max']) and empty($_GET['mot_cle']) and empty($_GET['ville']) and empty($_GET['categorie'])) {
        header('Location:../affichage/formulaire_recherche.php');
        exit;
    }
    if (! empty($_POST['mot_cle'])) {
        $mot_cle = $_POST['mot_cle'];
        $liste_mot_cle = explode(' ', $mot_cle);
    } elseif (! empty($_GET['mot_cle'])) {
        $mot_cle = $_GET['mot_cle'];
        $liste_mot_cle = explode(' ', $mot_cle);
    } else {
        $mot_cle = '';
        $liste_mot_cle[] = '';
    }
    if (! empty($_POST['ville'])) {
        $ville = $_POST['ville'];
    } elseif (! empty($_GET['ville'])) {
        $ville = $_GET['ville'];
    } else {
        $ville = '';
    }
    if (! empty($_POST['categorie'])) {
        $categorie = $_POST['categorie'];
    } elseif (! empty($_GET['categorie'])) {
        $categorie = $_GET['categorie'];
    } else {
        $categorie = '';
    }
    if (! empty($_POST['prix_min'])) {
        $prix_min = $_POST['prix_min'];
    } elseif (! empty($_GET['prix_min'])) {
        $prix_min = $_GET['prix_min'];
    } else {
        $prix_min = 0;
    }
    if (! empty($_POST['prix_max'])) {
        $prix_max = $_POST['prix_max'];
    } elseif (! empty($_GET['prix_max'])) {
        $prix_max = $_GET['prix_max'];
    } else {
        $prix_max = 999999999999999999;
    }
    $_SESSION['recherche'] = [
        'mot_cle' => $mot_cle,
        'ville' => $ville,
        'categorie' => $categorie,
        'prix_min' => $prix_min,
        'prix_max' => $prix_max,
    ];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>La Bonne Zone | Résultat Recherche</title>
        <link rel="stylesheet" href="../css/main.css">
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
                <button class="retour" onclick="window.location.href = '../affichage/formulaire_recherche.php'">Retour</button>
            </header>
            <?php
                $requete = "SELECT * FROM annonces WHERE ville LIKE '%$ville%' AND categorie LIKE '%$categorie%' AND prix BETWEEN $prix_min AND $prix_max";
                if (isset($liste_mot_cle)) {
                        foreach($liste_mot_cle as $mot_cle) {
                            $requete = $requete . " AND ( nom LIKE '%$mot_cle%' OR description LIKE '%$mot_cle%')";
                        }
                }
                $query1 = $pdo->prepare($requete);
                $query1->execute();
                $liste_annonces = $query1->fetchAll();
                foreach ($liste_annonces as $annonce) {
                    $nom_annonce = $annonce['nom'];
                    $description_annonce = $annonce['description'];
                    $prix_annonce = $annonce['prix'];
                    $date_annonce = $annonce['date'];
                    $status_annonce = $annonce['status'];
                    $ville_annonce = $annonce['ville'];
                    $categorie_annonce = $annonce['categorie'];
                    $personne_annonce = $annonce['id_client'];
                    $parametre = "nom=$nom_annonce&description=$description_annonce&prix=$prix_annonce&date=$date_annonce&status=$status_annonce&ville=$ville_annonce&categorie=$categorie_annonce&id=$personne_annonce";
                    if ($status_annonce == 'active') {
                    ?>
                    <div class="annonce">
                        <a href="../annonce/annonce.php?<?php echo $parametre;?>">
                        <h2 class="titre_index">
                        <?php
                            echo $nom_annonce;
                        ?>
                        </h2>
                        </a>
                        <a href="../annonce/annonce.php?<?php echo $parametre;?>">
                        <p class="prix_index">
                        <?php
                            echo $description_annonce;
                        ?>
                        </p>
                        </a>
                    </div>
                <?php
                    }
                }
            ?>
        </div>
    </body>
</html>