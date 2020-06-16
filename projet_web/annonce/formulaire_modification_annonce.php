<?php
    include_once('../base_donnee/pdo.php');
    session_start();
    if(empty($_POST['nom']) or empty($_POST['prix'])) {
        header('Location:../annonce/mes_annonces.php');
        exit;
    }
    if (! empty($_POST['nom'])) {
        $_SESSION['nom_annonce'] = htmlspecialchars($_POST['nom']);
    }
    if (! empty($_POST['prix'])) {
        $_SESSION['prix_annonce'] = htmlspecialchars($_POST['prix']);
    }
    $query1 = $pdo->prepare('SELECT * FROM annonces');
    $query1->execute();
    $liste_annonces = $query1->fetchAll();
    foreach ($liste_annonces as $annonce) {
        $nom_test = $annonce['nom'];
        $prix_test = $annonce['prix'];
        if ($_SESSION['nom_annonce'] == $nom_test and $_SESSION['prix_annonce'] == $prix_test) {
            $id_proprietaire = $annonce['id_client'];
            $nom = $annonce['nom'];
            $description = $annonce['description'];
            $prix = $annonce['prix'];
            $ville = $annonce['ville'];
            $status = $annonce['status'];
            $categorie = $annonce['categorie'];
        }
    }
    if (empty($nom) or empty($ville) or empty($description) or empty($prix) or empty($status) or empty($categorie)) {
        if ($_SESSION['table'] == 'client') {
            header('Location:../annonce/mes_annonces.php');
            exit;
        } else {
            header('Location:../admin/index_admin.php');
            exit;
        }
    }
    if ($_SESSION['table'] == 'client') {
        $query2 = $pdo->prepare('SELECT * FROM clients');
        $query2->execute();
        $liste_clients = $query2->fetchAll();
        foreach ($liste_clients as $client) {
            $nom_test = $client['nom'];
            $prenom_test = $client['prenom'];
            if ($_SESSION['nom'] == $nom_test and $_SESSION['prenom'] == $prenom_test) {
                $id_client = $client['id_client'];
            }
        }
        if ($id_proprietaire != $id_client) {
            header('Location:../annonce/mes_annonces.php');
            exit;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>La Bonne Zone | Formulaire Modification Annonce</title>
    <meta name="description" content="Formulaire modification annonce"/>
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
            <?php
            if ($_SESSION['table'] == 'client') {
                ?>
                <button class="retour" onclick="window.location.href = '../annonce/mes_annonces.php';">Retour</button>
            <?php
            } else { ?>
                <button class="retour" onclick="window.location.href = '../admin/index_admin.php';">Retour</button>
            <?php
            }
            ?>
        </header>
        <h1 class="titleannonce">Modifier votre annonce</h1>
            <form class="form_annonce" action="modification_annonce.php" method="post" enctype="multipart/form-data">
                <div id="name_annonce">
                    <input class="name_annonce" type="text" name="nom" placeholder="NOM ANNONCE" value="<?php echo "$nom" ?>" />
                </div>
                <div id="desc_annonce">
                    <input class="desc_annonce" type="text" name="description" placeholder="DESCRIPTION ANNONCE" value="<?php echo "$description" ?>" />
                </div>
                <div id="prix_annonce">
                    <input class="prix_annonce" type="number" name="prix" placeholder="PRIX ANNONCE" value="<?php echo "$prix" ?>" />
                </div>
                <div id="ville_annonce">
                    <input class="ville_annonce" type="text" name="ville" placeholder="VILLE ANNONCE" value="<?php echo "$ville" ?>" />
                </div>
                <div id="select_annonce">
                    <select class="select_annonce" name="status">
                            <?php if ($status == 'active') {
                            ?>
                                <option value="active">active</option>
                                <option value="inacitve">inactive</option>
                            <?php
                            } else {
                            ?>
                                <option value="inacitve">inactive</option>
                                <option value="active">active</option>
                            <?php
                            }
                            ?>
                    </select>
                </div>
                <div id="cat_annonce">
                    <input class="cat_annonce" type="text" name="categorie" placeholder="CATEGORIE ANNONCE" value="<?php echo "$categorie" ?>" />
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
                <div id="button_modif_annonce">
                    <button class="button_modif_annonce" type="submit">Modifier</button>
                </div>
            </form>
    </div>
</body>
</html>