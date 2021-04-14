# Log IP
Le principe est de pouvoir uploader un fichier de log, puis ce dernier est parsé.
Après cela, on affiche sur une map l'emplacement des utilisateurs qui ont fait les erreurs. 
On utilisera le fichier qui est généralement access.log

Pour tester, il y a un fichier dans public/res/data/access.log

[Adresse du GitHub](https://github.com/LudovicRx/LogIP)

# API utilisées
* ipinfo.io (pour transformer l'adresse ip en coordonnées GPS)
* bootsrap (pour le css)
* leaflet (pour la cartographie) 