<!DOCTYPE html>
<html>
    <head>
    <title>La Bonne Zone | Inscription</title>
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
            </header>
                <div id="titletest">
                    <h1 class="logintitle2">Créer un compte</h1>
                </div>
            <form class="formform" action="inscription_client.php" method="post" enctype="multipart/form-data">
                <div id="imgfond">
                    <img class="imgregister" src="../img/zone.svg" alt="image du logo">
                </div>
                <div id="inputnom">
                    <p class="txtnom">Nom</p>
                    <input class="inputnom" type="text" name="nom" placeholder="NOM" />
                </div>
                <div id="inputprenom">
                    <p class="txtprenom">Prénom</p>
                    <input class="inputprenom" type="text" name="prenom" placeholder="PRENOM" />
                </div>
                <div id="inputmail">
                    <p class="txtmail">Email</p>
                    <input class="inputmail" type="email" name="email" placeholder="EMAIL" />
                </div>
                <div id="inputmdp1">
                    <p class="txtmdp1">Mot de passe</p>
                    <input class="inputmdp1" type="password" name="mot_passe" placeholder="MOT DE PASSE" />
                </div>
                <div id="inputnum">
                    <p class="txtnum">Portable</p>
                    <input class="inputnum" type="tel" name="telephone" placeholder="TELEPHONE" />
                </div>
                <div id="inputimg">
                    <input class="inputimg" type="file" name="image_profil" />
                </div>
                <div id="buttonregister">
                    <button class="buttonregister" type="submit">Envoyer</button>
                </div>
            </form>
        </div>
    </body>
</html>