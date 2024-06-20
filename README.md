# webdirectory
Sae 4.01 KOLER PINOT PRYKHODKO TERRAS

gaetanpinot $\rightarrow$ Gaëtan PINOT

YehorPrykhodko >$\rightarrow$ Yehor PRYKHODKO

YxallaxY $\rightarrow$ Maxime KOLER

lina-trs $\rightarrow$ Lina TERRAS

## Setup
Créer le fichier `.env` à paritr de `modele.env` à la racine du `docker-compose.yml`, il contient le mot de passe root de la base de donnée et le login de l'utilisateur (attention par défaut l'utilisateur n'a pas de droit)  
Créer le fichier `webdir.db.conf.ini.dist` à partir du template dans le dossier `core/src/conf` de core sur la base du fichier existant pour preciser le login et le mot de passe que eloquent utilise pour la base de donnée  
Créer la base de donnée `webdir` sur adminer et la remplir avec le fichier `lignes.sql`  

## SQL

Structure de la base de donnée:  

personne(pk int id, varchar nom, varchar prenom, varchar num_bureau, varchar mail, varchar url_img, boolean publie)  

personne_service(pk fk int id_personne, pk fk int id_service)  

admin_user(pk varchar id, varchar username, longtext password, boolean is_super_admin)  

service(pk int id, varchar libelle, int etage, text description)  

telephone_personne(pk fk int id_personne, varchar num)  

fonction_personne(pk fk int id_personne,pk fk int id_fonction)  

fonction(pk int id,varchar libelle)  

## Arborescence du projet : 
webdirectory
 - core
   - backend project
 - admin
   - frontend+backend php
 - web
   - javascript project
 - app
   - flutter project 
