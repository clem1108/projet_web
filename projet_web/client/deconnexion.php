<?php
    session_start();
    session_destroy();
    header('Location:../affichage/index.php');
    exit;
?>