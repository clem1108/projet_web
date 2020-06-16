<?php
    session_start();
    include_once('../base_donnee/pdo.php');
    if(empty($_POST['nom']) or empty($_POST['prenom']) or empty($_POST['mot_passe'])) {
        header('Location:../admin/admin.php');
        exit;
    } else {
        $query1 = $pdo->prepare('SELECT * FROM admins');
        $query1->execute();
        $liste_admins = $query1->fetchAll();
        foreach ($liste_admins as $admin) {
            $nom = $admin['nom'];
            $prenom = $admin['prenom'];
            $mot_passe = $admin['mot_passe'];
            if ($_POST['nom'] == $nom and $_POST['prenom'] == $prenom and password_verify($_POST['mot_passe'], $mot_passe)) {
                $_SESSION['IS_CONNECTED'] = TRUE;
                $_SESSION['nom'] = htmlspecialchars($_POST['nom']);
                $_SESSION['prenom'] = htmlspecialchars($_POST['prenom']);
                $_SESSION['table'] = 'admin';
                header("Location:../admin/index_admin.php");
                exit;
            }
        }
        header("Location:../admin/admin.php");
        exit;
    }
?>