<?php
include_once('../base_donnee/pdo.php');
session_start();
$query1 = $pdo->prepare('SELECT * FROM clients');
$query1->execute();
$liste_clients = $query1->fetchAll();
foreach ($liste_clients as $client) {
    $nom_test = $client['nom'];
    $prenom_test = $client['prenom'];
    if ($_SESSION['nom'] == $nom_test and $_SESSION['prenom'] == $prenom_test) {
        $nom = $client['nom'];
        $prenom = $client['prenom'];
        $telephone = $client['telephone'];
        $mot_passe = $client['mot_passe'];
        $email = $client['adresse_mail'];
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>La Bonne Zone | Modification données</title>
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
            <h1 class="modiftitle">Modifier votre profil</h1>
            <form class="modif" action="enregistrement_donnees.php" method="post" enctype="multipart/form-data">
                <div id="imgmodif">
                    <img class="imgmodif" src="../img/zone.svg" alt="image du logo">
                </div>
                <div id="modifnom">
                    <input class="modifnom" type="text" name="nom" placeholder="NOM" value="<?php echo"$nom"?>" />
                </div>
                <div id="modifprenom">
                    <input class="modifprenom" type="text" name="prenom" placeholder="PRENOM" value="<?php echo"$prenom"?>" />
                </div>
                <div id="modifemail">
                    <input class="modifemail" type="email" name="email" placeholder="EMAIL" value="<?php echo"$email"?>" />
                </div>
                <div id="modifmdp">
                    <input class="modifmdp" type="password" name="mot_passe" placeholder="MOT DE PASSE" value="<?php echo"$mot_passe"?>" />
                </div>
                <div id="modiftel">
                    <input class="modiftel" type="tel" name="telephone" placeholder="TELEPHONE" value="<?php echo"$telephone"?>" />
                </div>
                <div id="imgprofil">
                    <input class="modifimg" type="file" name="image_profil" />
                </div>
                <div id="buttonmodif">
                    <button class="buttonmodif" type="submit">Envoyer</button>
                </div>
            </form>
            <p> Vous souhaitez nous quitter...?</p>
            <button class="buttonsuppr" onclick="window.location.href = '../client/suppression_client_perso.php';">Supprimer mon profil</button>
        </div>
    </body>
</html>