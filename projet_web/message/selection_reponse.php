<?php
    session_start();
    include_once('../base_donnee/pdo.php');
    if (! $_SESSION['IS_CONNECTED']) {
        header('Location:../affichage/index.php');
        exit;
    }
    $query1 = $pdo->prepare('SELECT * FROM clients');
    $query1->execute();
    $liste_clients = $query1->fetchAll();
    foreach ($liste_clients as $client) {
        $nom_test = $client['nom'];
        $prenom_test = $client['prenom'];
        if ($nom_test == $_SESSION['nom'] and $prenom_test == $_SESSION['prenom']) {
            $id_proprietaire = $client['id_client'];
        }
    }
    $parametre = $_SESSION['parametre'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>La Bonne Zone | Réponse Proprietaire</title>
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
                <button class="retour" onclick="window.location.href = '../annonce/annonce.php?<?php echo $parametre?>';">Retour</button>
            </header>
            <?php
            $id_annonce = $_SESSION['id_annonce'];
            $query2 = $pdo->prepare('SELECT * FROM messagerie');
            $query2->execute();
            $liste_messageries = $query2->fetchAll();
            $query3 = $pdo->prepare('SELECT * FROM clients');
            $query3->execute();
            $liste_clients = $query3->fetchAll();
            foreach ($liste_messageries as $messagerie) {
                $id_client_messagerie = $messagerie['id_acheteur'];
                $id_proprietaire_messagerie = $messagerie['id_proprietaire'];
                $id_annonce_messagerie = $messagerie['id_annonce'];
                foreach ($liste_clients as $client) {
                    $id_client = $client['id_client'];
                    if ($id_client_messagerie == $id_client and $id_proprietaire_messagerie == $id_proprietaire and $id_annonce_messagerie == $id_annonce) {
                            $nom_prenom = $client['nom'] . ' ' . $client['prenom'];
                            ?> <p class="p_center"><a href="formulaire_message.php?id_client=<?php echo $id_client?>"> <?php echo $nom_prenom; ?> </a> </p>
                    <?php
                    }
                }
            }
            ?>
        </div>
    </body>
</html>