# webdirectory
Sae 4.01 KOLER PINOT PRYKHODKO TERRAS


## SQL

Structure de la base de donnée:
personne(pk int id, varchar nom, varchar prenom, varchar num_bureau, varchar mail, varchar url_img)
personne_service(pk fk int id_personne, pk fk int id_service)
admin_user(pk varchar id, varchar username, longtext password, boolean is_super_admin)
service(pk int id, varchar libelle, int etage, text description)
telephone_personne(pk fk int id_personne, varchar num)
fonction_personne(pk fk int id_personne,pk fk int id_fonction)
fonction(pk int id,varchar libelle)

