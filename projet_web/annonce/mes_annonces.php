<?php
    session_start();
    include_once('../base_donnee/pdo.php');
    if (! $_SESSION['IS_CONNECTED']) {
        header('Location:../affichage/index.php');
        exit;
    }
    $query1 = $pdo->prepare('SELECT * FROM clients');
    $query1->execute();
    $liste_clients = $query1->fetchAll();
    foreach ($liste_clients as $client) {
        $nom_test = $client['nom'];
        $prenom_test = $client['prenom'];
        if ($_SESSION['nom'] == $nom_test and $_SESSION['prenom'] == $prenom_test) {
            $id_client = $client['id_client'];
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>La bonne zone | Mes annonces</title>
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
                <button class="deco1" onclick="window.location.href = '../client/deconnexion.php';">Déconnexion</button>
            </header>
            <h1 class="titleannonce1">Mes Annonces</h1>
            <div id="annoncebutton">
                <div id="creerannonce">
                    <button class="creerannonce" onclick="window.location.href = '../annonce/creation_annonce.php';">Créer Annonce</button>
                </div>
                <div id="modifierannonce">
                    <button class="modifierannonce" onclick="window.location.href = '../annonce/selection_annonce.php';">Modifier Annonce</button>
                </div>
                <div id="supprimerannonce">
                    <button class="supprimerannonce" onclick="window.location.href = '../annonce/selection_suppression_annonce.php';">Supprimer Annonce</button>
                </div>
                <div id="imgbackannonce">
                    <img class="imgbackannonce" src="../img/zone.svg" alt="image du logo">
                </div>
            </div>
            <?php
                $query2 = $pdo->prepare('SELECT * FROM annonces');
                $query2->execute();
                $liste_annonces = $query2->fetchAll();
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
                    if ($personne_annonce == $id_client) {
                    ?>
                    <div>
                        <a href="annonce.php?<?php echo $parametre;?>">
                        <h2 class="info_annonce">
                        <?php
                            echo $nom_annonce;
                        ?>
                        </h2>
                        </a>
                    </div>
                <?php
                    }
                }
            ?>
        </div>
    </body>
</html>