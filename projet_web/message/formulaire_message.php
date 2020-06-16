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
            $id_client = $client['id_client'];
        }
    }
    if (isset($_GET['id_client'])) {
        $id_client = $_GET['id_client'];
    }
    $parametre = $_SESSION['parametre'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>La Bonne Zone | Message</title>
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
            <button class="retour_message" onclick="window.location.href = '../annonce/annonce.php?<?php echo $parametre?>';">Retour</button>
        </header>
        <h1> Message </h1>
        <form class="form_message" action="message.php" method="post">
            <div id="inputmessage">
                <input class="inputmessage" type="texte" name="message" placeholder="Votre message" />
            </div>
            <input type="hidden" name="id" value="<?php echo $id_client ?>" />
            <div id="button_message">
                <button class="button_message" type="submit">Envoyer</button>
            </div>
        </form>
        <?php
        $id_proprietaire = $_SESSION['id_proprietaire'];
        $id_annonce = $_SESSION['id_annonce'];
        $query2 = $pdo->prepare('SELECT * FROM messagerie');
        $query2->execute();
        $liste_messagerie = $query2->fetchAll();
        foreach ($liste_messagerie as $messagerie) {
            $id_proprietaire_test = $messagerie['id_proprietaire'];
            $id_acheteur_test = $messagerie['id_acheteur'];
            $id_annonce_test = $messagerie['id_annonce'];
            if ($id_proprietaire_test == $id_proprietaire and $id_acheteur_test == $id_client and $id_annonce_test == $id_annonce) {
                $id_messagerie = $messagerie['id_messagerie'];
            }
        }
        ?>
        <table id="ensemble_message">
        <?php
        if (isset($id_messagerie)) {
            $query3 = $pdo->prepare('SELECT * FROM clients');
            $query3->execute();
            $liste_clients = $query3->fetchAll();
            foreach ($liste_clients as $client) {
                $nom_test = $client['nom'];
                $prenom_test = $client['prenom'];
                if ($nom_test == $_SESSION['nom'] and $prenom_test == $_SESSION['prenom']) {
                    $id_client = $client['id_client'];
                }
            }
            $query4 = $pdo->prepare('SELECT * FROM messages');
            $query4->execute();
            $liste_messages = $query4->fetchAll();
                foreach ($liste_messages as $message) {
                    $id_messagerie_test = $message['id_messagerie'];
                    if ($id_messagerie == $id_messagerie_test) {
                        $texte_message = $message['texte'];
                        $id_client_message = $message['id_client'];
                        ?>
                        <tr>
                        <?php if ($id_client_message == $id_client) {
                            ?> <td class="votre_message">
                            <?php
                            echo $texte_message; ?>
                            </td>
                            <td></td>
                        <?php } else {
                            ?> <td>
                            </td>
                            <td class="son_message">
                            <?php
                            echo $texte_message; ?>
                            </td>
                        <?php
                        }
                        ?>
                        </tr>
                <?php }
                }
                ?>
            </table>
            <?php } ?>
    </div>
</body>
</html>