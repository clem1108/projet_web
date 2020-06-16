<?php
    session_start();
    if (!isset($_SESSION['IS_CONNECTED'])) {
        $_SESSION['IS_CONNECTED'] = FALSE;
    }
    include_once('../base_donnee/pdo.php');
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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>La Bonne Zone</title>
        <link rel="stylesheet" href="../css/main.css">
        <meta name="description" content="Page principale du site La Bonne Zone"/>
    </head>
    <body>
        <div id="content">
            <header>
                <img class="logo" src="../img/zone.svg" alt="Image Logo">
                <a class="home" href="../affichage/index.php"><img  src="../img/home.svg" alt="logo d'accueil"></a>
                <a class="txthead" href="../affichage/index.php"><p>Accueil</p></a>
                <img class="panier" src="../img/panier.svg" alt="image panier">
                <p class="txthead1">Achat</p>
                <?php
                if (! $_SESSION['IS_CONNECTED']) {
                    ?>
                    <a class="login1" href="../client/profil.php"><img src="../img/profil.svg" alt="image profil"></a>
                    <a class="txthead2" href="../client/profil.php"><p>Profil</p></a>
                    <button class="deco1" onclick="window.location.href = '../client/formulaire_connexion.php';">Connexion</button>
                <?php
                }
                ?>
                <?php
                    if ($_SESSION['IS_CONNECTED']) {
                        ?>
                        <a class="login1" href="../client/profil.php"><img src="../img/profil.svg" alt="image profil"></a>
                        <a class="txthead2" href="../client/profil.php"><p>Profil</p></a>
                        <button class="deco1" onclick="window.location.href = '../client/deconnexion.php';">Déconnexion</button>
                    <?php
                    }
                    ?>
            </header>
            <button class="index_search" onclick="window.location.href = '../affichage/formulaire_recherche.php';">Recherche</button>
        </div>
            <?php
            $query1 = $pdo->prepare('SELECT * FROM annonces');
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
                    <a class="decoration" href="../annonce/annonce.php?<?php echo $parametre; ?>">
                    <h2 class="titre_index">
                    <?php
                        echo $nom_annonce;
                    ?>
                    </h2>
                    </a>
                    <a class="decoration" href="../annonce/annonce.php?<?php echo $parametre;?>">
                    <p class="prix_index">
                    <?php
                        echo $prix_annonce;
                    ?> €
                    </p>
                    </a>
                </div>
            <?php
                }
            }
        ?>
    </body>
</html>