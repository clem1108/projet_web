<?php
    session_start();
    include_once('../base_donnee/pdo.php');
    if (! $_SESSION['IS_CONNECTED']) {
        header('Location:../affichage/index.php');
        exit;
    }
    $parametre = $_SESSION['parametre'];
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>La Bonne Zone | Profil Vendeur</title>
        <meta name="description" content="Profil Vendeur"/>
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
                <a class="testretour" href="../annonce/annonce.php?<?php echo $parametre;?>"><button class="retour">Retour</button></a>
            </header>
        <?php
            $query1 = $pdo->prepare('SELECT * FROM clients');
            $query1->execute();
            $liste_clients = $query1->fetchAll();
            foreach ($liste_clients as $client) {
                $id_test = $client['id_client'];
                if ($_SESSION['id_proprietaire'] == $id_test) {
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
                $nom_dossier_image = "../" . strtolower($nom . '_' . $prenom);
            }
            ?>
            <div class="info">
                <h1 class="title_vendeur">Vendeur</h1>
                <p class="color_info_para">
                <?php echo $prenom . ' ' . $nom ?>
                </p>
                <div id="imgback">
                <?php
                if (isset($extension)) {
                ?>
                    <div id="backprofil">
                            <div id="imageprofil"><img class="imageprofil" src='<?php echo "$nom_dossier_image/image_profil.$extension" ; ?>' /></div>
                    </div>
                <?php
                }
                ?>
                </div>
                <p class="para_info"> Email <strong class="color_info">
                <?php
                    echo $email;
                ?>
                </strong>
                </p>
                <?php
                if (! empty($telephone)) {
                    ?>
                    <p class="para_info"> Téléphone <strong class="color_info">
                    <?php
                        echo $telephone;
                    ?>
                    </strong>
                    </p>
                <?php
                }
                ?>
        </div>
    </div>
</body>
</html>

