<?php
    session_start();
    if (!isset($_SESSION['IS_CONNECTED'])) {
        $_SESSION['IS_CONNECTED'] = FALSE;
    }
    include_once('../base_donnee/pdo.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>La Bonne Zone | Administration</title>
    <meta name="description" content="Page principale d'amin"/>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div id="content">
            <header>
                <img class="logo" src="../img/zone.svg" alt="Image Logo">
                <a class="home" href="../admin/index_admin.php"><img  src="../img/home.svg" alt="logo d'accueil"></a>
                <a class="txthead" href="../admin/index_admin.php"><p>Accueil</p></a>
                <?php
                if (! $_SESSION['IS_CONNECTED']) {
                ?>
                    <button class="deco1" onclick="window.location.href = '../admin/admin.php';">Connexion</button>
                <?php
                } else {
                ?>
                    <button class="deco1" onclick="window.location.href = '../client/deconnexion.php';">Déconnexion</button>
                <?php
                }
                ?>
            </header>
            <h1 class="title_admin"> Administration La Bonne Zone</h1>
            <?php
                $query1 = $pdo->prepare('SELECT * FROM clients');
                $query1->execute();
                $liste_clients = $query1->fetchAll();
                ?>
                <h2 class="title1_admin"> Clients </h2>
                <p class="para_admin"> Suppression client </p>
                <form class="formadmin" action="suppression_client.php" method="post">
                    <div id="inputnomadmin">
                        <input class="inputnomadmin" type="text" name="nom" placeholder="NOM CLIENT" />
                    </div>
                    <div id="inputprenomadmin">
                        <input class="inputprenomadmin" type="text" name="prenom" placeholder="PRENOM CLIENT"/>
                    </div>
                    <div id="buttonadmin">
                        <button class="buttonadmin" type="submit">Supprimer</button>
                    </div>
                </form>
                <?php
                foreach ($liste_clients as $client) {
                    $nom = $client['nom'];
                    $prenom = $client['prenom'];
                    ?>
                    <div>
                        <p class="info_admin">
                        <?php
                            echo $nom . ' ' . $prenom;
                        ?>
                        </p>
                    </div>
                <?php
                }
                $query2 = $pdo->prepare('SELECT * FROM annonces');
                $query2->execute();
                $liste_annonces = $query2->fetchAll();
                ?>
                <h2 class="title1_admin"> Annonces </h2>
                <p class="para_admin"> Modification annonce </p>
                <form class="formadmin" action="../annonce/formulaire_modification_annonce.php" method="post">
                    <div id="inputnomadmin">
                        <input class="inputnomadmin" type="text" name="nom" placeholder="NOM ANNONCE" />
                    </div>
                    <div id="inputprixadmin">
                        <input class="inputprixadmin" type="number" name="prix" placeholder="PRIX ANNONCE" />
                    </div>
                    <div id="buttonadmin">
                        <button class="buttonadmin" type="submit">Modifier</button>
                    </div>
                </form>
                <p class="para_admin"> Suppression annonce </p>
                <form class="formadmin" action="../annonce/suppression_annonce.php" method="post">
                    <div id="inputnomadmin">
                        <input class="inputnomadmin" type="text" name="nom" placeholder="NOM ANNONCE" />
                    </div>
                    <div id="inputprixadmin">
                        <input class="inputprixadmin" type="number" name="prix" placeholder="PRIX ANNONCE" />
                    </div>
                    <div id="buttonadmin">
                        <button class="buttonadmin" type="submit">Supprimer</button>
                    </div>
                </form>
                <?php
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
                    ?>
                    <div class="annonce">
                        <a class="decoration" href="../annonce/annonce.php?<?php echo $parametre; ?>">
                        <h2 class="info_admin">
                        <?php
                            echo $nom_annonce;
                        ?>
                        </h2>
                        </a>
                    </div>
                <?php
                }
            ?>
    </div>
</body>
</html>