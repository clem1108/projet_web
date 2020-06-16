<!DOCTYPE html>
<html>
<head>
    <title>La Bonne Zone | Selection Annonce</title>
    <meta name="description" content="Formulaire selection annonce"/>
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
            <button class="retour" onclick="window.location.href = '../annonce/mes_annonces.php';">Retour</button>
        </header>
        <h1 class="title_selection">Pour modifier votre annonce</h1>
        <form class="formselection" action="formulaire_modification_annonce.php" method="post">
            <div id="inputselnom">
                <input class="inputselnom" type="text" name="nom" placeholder="NOM ANNONCE" />
            </div>
            <div id="inputselprix">
                <input class="inputselprix" type="number" name="prix" placeholder="PRIX ANNONCE" />
            </div>
            <div id="buttonmodification">
                <button class="buttonmodification" type="submit">Modifier</button>
            </div>
        </form>
    </div>
</body>
</html>