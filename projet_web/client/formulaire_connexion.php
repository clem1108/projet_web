<!DOCTYPE html>
<html>
    <head>
        <title>La Bonne Zone | Connexion</title>
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
            <div id="formall">
                <h1 class="logintitle1">Connexion</h1>
                <img class="zone" src="../img/zone.svg" alt="image du logo">
                <form action="connexion_client.php" method="post">
                    <div id="inputemail">
                        <p class="txtemail">Email</p>
                        <input class="inputemail" type="email" name="email" placeholder="ADRESSE MAIL" />
                    </div>
                    <div id="inputmdp">
                        <p class="txtmdp">Mot de passe</p>
                        <input class="inputmdp" type="password" name="mot_passe" placeholder="MOT DE PASSE" /> <br/>
                    </div>
                    <div id="buttonlogin">
                        <button class="buttonlogin" type="submit">Connexion</button>
                    </div>
                </form>
                <div id="linkregister">
                    <p class="nocompte">Pas de compte ?<a href="formulaire_inscription_client.php"> Inscrivez-vous</a></p>
                </div>
            </div>
        </div>
    </body>
</html>