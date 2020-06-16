<?php
    session_start();
    if ($_SESSION['IS_CONNECTED']) {
        ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Creer Annonce | La Bonne zone</title>
        <meta charset="utf-8">
        <meta desc="La Bonne zone">
        <meta name="La bonne zone" content="width=device-width">
        <link href="../css/main.css" rel="stylesheet" type="text/css" />
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
                <button class="retour" onclick="window.location.href = '../annonce/mes_annonces.php';">Retour</button>
            </header>
            <h1 class="titleannonce"> Déposer une annonce </h1>
            <form class="form_annonce"  action="ajout_annonce.php" method="post" enctype="multipart/form-data">
                <div id="name_annonce">
                    <input class="name_annonce" type="text" name="nom" placeholder="NOM ANNONCE" />
                </div>
                <div id="desc_annonce">
                    <input class="desc_annonce" type="text" name="description" placeholder="DESCRIPTION ANNONCE" />
                </div>
                <div id="prix_annonce">
                    <input class="prix_annonce" type="number" name="prix" placeholder="PRIX ANNONCE" />
                </div>
                <div id="ville_annonce">
                    <input class="ville_annonce" type="text" name="ville" placeholder="VILLE ANNONCE" />
                </div>
                <div id="select_annonce">
                    <select class="select_annonce" name="status">
                            <option value="active">active</option>
                            <option value="inacitve">inactive</option>
                    </select>
                </div>
                <div id="cat_annonce">
                    <input class="cat_annonce" type="text" name="categorie" placeholder="CATEGORIE ANNONCE" />
                </div>
                <div id="file1_annonce">
                    <input class="file1_annonce" type="file" name="image1"/>
                </div>
                <div id="file2_annonce">
                    <input class="file2_annonce" type="file" name="image2"/>
                </div>
                <div id="file3_annonce">
                    <input class="file3_annonce" type="file" name="image3"/>
                </div>
                <div id="button_crea_annonce">
                    <button class="button_crea_annonce" type="submit">Envoyer</button>
                </div>
            </form>
        </div>
    </body>
    </html>
    <?php
    } else {
        header('Location:../client/formulaire_connexion.php');
        exit;
    }
?>