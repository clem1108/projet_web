<?php
    session_start();
    include_once('../base_donnee/pdo.php');
    if (! $_SESSION['IS_CONNECTED']) {
        header('Location:../client/formulaire_connexion.php');
        exit;
    }
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
    $_SESSION['mes_annonces'] = TRUE;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>La Bonne Zone | Profil</title>
        <meta charset="utf8"/>
        <meta name="description" content="Profil client"/>
        <link rel="stylesheet" href="../css/main.css" type='text/css'>
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
            <?php
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
                        $email = $client['adresse_mail'];
                    }
                }
                $nom_dossier = getcwd() . '/../' . strtolower($nom . '_' . $prenom);
                if (file_exists($nom_dossier)) {
                    $ensemble_fichier = scandir($nom_dossier);
                    foreach($ensemble_fichier as $fichier) {
                        if ($fichier != '.' and $fichier != '..') {
                            $nom_fichier = $fichier;
                        }
                    }
                    $nom_dossier_fichier = $nom_dossier . '/' . $nom_fichier;
                    $fichier = pathinfo($nom_dossier_fichier);
                    $extension = $fichier['extension'];
                }
                $nom_dossier_image = "../" . strtolower($nom . '_' . $prenom);
                ?>
                <div class="info">
                    <div id="imgback">
                        <div id="backprofil">
                            <?php
                                if (isset($extension)) {
                            ?>
                            <div id="imageprofil"><img class="imageprofil" src='<?php echo "$nom_dossier_image/image_profil.$extension" ; ?>' /></div>
                            <?php
                            }
                            ?>
                            <h1 class="titlename"><?php echo $prenom . ' ' . $nom ?></h1>
                        </div>
                    </div>
                </div>
                <div id="optionprofil">
                    <div id="modifprofil">
                        <button class="modifprofil" onclick="window.location.href = '../client/modification_profil.php';">Modifier vos données</button>
                    </div>
                    <div id="annonceprofil">
                        <button class="annonceprofil" onclick="window.location.href = '../annonce/mes_annonces.php';">Mes Annonces</button>
                    </div>
                </div>
        </div>
    </body>
</html>

