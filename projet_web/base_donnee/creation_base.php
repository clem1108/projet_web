<?php
    include_once('pdo.php');

$query1 = $pdo->prepare('CREATE TABLE IF NOT EXISTS projet.clients (
    id_client INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    adresse_mail VARCHAR(255) NOT NULL,
    telephone VARCHAR(255) NOT NULL,
    mot_passe LONG NOT NULL,
    PRIMARY KEY (id_client));');
$query1->execute();

$query2 = $pdo->prepare('CREATE TABLE IF NOT EXISTS projet.annonces (
    id_annonce INT NOT NULL AUTO_INCREMENT,
    id_client INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    description LONG NOT NULL,
    prix INT NOT NULL,
    ville VARCHAR(255) NOT NULL,
    date DATETIME NOT NULL,
    status VARCHAR(255) NOT NULL,
    categorie VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_annonce),
    CONSTRAINT annonce_client FOREIGN KEY(id_client) REFERENCES projet.clients(id_client) ON DELETE CASCADE ON UPDATE CASCADE);');
$query2->execute();

$query3 = $pdo->prepare('CREATE TABLE IF NOT EXISTS projet.admins (
    id_admin INT NOT NULL AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    mot_passe LONG NOT NULL,
    PRIMARY KEY (id_admin));');
$query3->execute();

$query4 = $pdo->prepare('CREATE TABLE IF NOT EXISTS projet.messagerie (
    id_messagerie INT NOT NULL AUTO_INCREMENT,
    id_proprietaire INT NOT NULL,
    id_acheteur INT NOT NULL,
    id_annonce INT NOT NULL,
    PRIMARY KEY (id_messagerie),
    CONSTRAINT messagerie_acheteur FOREIGN KEY (id_acheteur) REFERENCES projet.clients(id_client) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT messagerie_proprietaire FOREIGN KEY (id_proprietaire) REFERENCES projet.clients(id_client) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT messagerie_annonce FOREIGN KEY (id_annonce) REFERENCES projet.annonces(id_annonce) ON DELETE CASCADE ON UPDATE CASCADE);');
$query4->execute();

$query5 = $pdo->prepare('CREATE TABLE IF NOT EXISTS projet.messages (
    id_message INT NOT NULL AUTO_INCREMENT,
    id_client INT NOT NULL,
    id_messagerie INT NOT NULL,
    texte LONG NOT NULL,
    PRIMARY KEY (id_message),
    CONSTRAINT message_client FOREIGN KEY (id_client) REFERENCES projet.clients(id_client) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT message_messagerie FOREIGN KEY (id_messagerie) REFERENCES projet.messagerie(id_messagerie) ON DELETE CASCADE ON UPDATE CASCADE);');
$query5->execute();

header('Location:../admin/ajout_admin.php');
exit;

?>