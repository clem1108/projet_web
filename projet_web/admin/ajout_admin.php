<?php
include_once('../base_donnee/pdo.php');
$donnee_admin1 = [
        'nom' => "crenn",
        'prenom' => "antoine",
        'mot_passe' => password_hash("antoine", PASSWORD_DEFAULT),
    ];
$requete_admin1 = "INSERT INTO projet.admins (nom, prenom, mot_passe) VALUES (:nom, :prenom, :mot_passe)";
$query1 = $pdo->prepare($requete_admin1);
$query1->execute($donnee_admin1);

$donnee_admin2 = [
    'nom' => "dournet",
    'prenom' => "clement",
    'mot_passe' => password_hash("clement", PASSWORD_DEFAULT),
];
$requete_admin2 = "INSERT INTO projet.admins (nom, prenom, mot_passe) VALUES (:nom, :prenom, :mot_passe)";
$query2 = $pdo->prepare($requete_admin2);
$query2 ->execute($donnee_admin2);

$donnee_admin3 = [
    'nom' => "texier",
    'prenom' => "marc",
    'mot_passe' => password_hash("marc", PASSWORD_DEFAULT),
];
$requete_admin3 = "INSERT INTO projet.admins (nom, prenom, mot_passe) VALUES (:nom, :prenom, :mot_passe)";
$query3 = $pdo->prepare($requete_admin3);
$query3 ->execute($donnee_admin3);

header('Location:../affichage/index.php');
exit;

?>