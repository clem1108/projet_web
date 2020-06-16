# Installation nécessaire au projet 
## Logiciels nécessaires
* Logiciel de serveur web (XAMPP, LAMPP, Apache...)
* logiciel de base de données (PHPmyadmin, MySQL...)
## Déroulement de l'installation
Ici, nous avons choisi le logiciel XAMPP qui inclut le serveur Apache et le logiciel PHPmyadmin pour la gestion de la base de données.
Il est donc nécessaire de télécharger l'installateur XAMPP. L'installateur étant complet et pré-paramétré, il suffit juste de se laisser guider. Une fois l'instllation terminée, IL est nécessaire de lancer l'interface graphique de gestion de XAMPP, vérifier dans les logs (zone de texte en bas du logiciel) si des erreurs apparaissent et adapter les paramètre si besoin est. Lancez le serveur Apache et MySQL en appuyant sur start pour les deux logiciels. </h3>

## Configuration :
Afin de rendre le site opérationnel, il est nécessaire d'importer la base de données dans PHPmyadmin et de copier les fichiers. POur commencer, il suffit de copier le dossier contenant tous les fichiers dans le dossier `htdocs`du répertoire `xampp`. Concernant la base de données, il est requis d'accéder à la page PHPmyadmin en tapant dans le navigateur `localhost:80` (il faut adpater le port au port choisi pendant la configuration) et ensuite cliquez sur le logo : ![](https://i.imgur.com/GdZ5JEC.png)
Puis ensuite importer la base : 
![](https://i.imgur.com/32o8MCL.png)
Sélectionner la base de données et exécuter l'importation : 
![](https://i.imgur.com/dPuzb9E.png)
La base de données est maintenant importé et le site web est donc désormais fonctionnel !