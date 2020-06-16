<?php
    session_start();
    include_once('../base_donnee/pdo.php');
    if (! $_SESSION['IS_CONNECTED']) {
        header('Location:../client/formulaire_connexion.php');
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>La Bonne Zone | Recherche</title>
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
            <h1 class="search"> Recherche </h1>
            <form class="formform2" action="recherche.php" method="post">
                <div id="inputmot_cle">
                    <input class="inputmot_cle" type="texte" name="mot_cle" placeholder="Que recherchez-vous ?" />
                </div>
                <div id="inputville">
                    <input class="inputville" type="texte" name="ville" placeholder="VILLE"/>
                </div>
                <div id="inputcategorie">
                    <input class="inputcategorie" type="texte" name="categorie" placeholder="CATEGORIE"/>
                </div>
                <div id="inputprixmin">
                    <input class="inputprixmin" type="number" name="prix_min" placeholder="PRIX MINIMUM" />
                </div>
                <div id="inputprixmax">
                    <input class="inputprixmax" type="number" name="prix_max" placeholder="PRIX MAXIMUM"/>
                </div>
                <div id="buttonrecherche">
                    <button class="buttonrecherche" type="submit">Rechercher</button>
                </div>
            </form>
        </div>
    </body>
</html>