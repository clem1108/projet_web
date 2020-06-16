<!DOCTYPE html>
<html>
<head>
    <title>La Bonne Zone | Connexion Admin</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div id="content">
        <header>
            <img class="logo" src="../img/zone.svg" alt="Image Logo">
        </header>
        <h1> Admin </h1>
        <form class="formconnexionadmin" action="connexion_admin.php" method="post">
            <div id="connexionnomadmin">
                <input class="connexionnomadmin" type="text" name="nom" placeholder="NOM" />
            </div>
            <div id="connexionprenomadmin">
                <input class="connexionprenomadmin" type="text" name="prenom" placeholder="PRENOM" /> <br/>
            </div>
            <div id="connexionmdpadmin">
                <input class="connexionmdpadmin" type="password" name="mot_passe" placeholder="MOT DE PASSE" /> <br/>
            </div>
            <div id="buttonconnexionadmin">
                <button class="buttonconnexionadmin" type="submit" name="bouton">Connexion</button>
            </div>
        </form>
    </div>
</body>
</html>