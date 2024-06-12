#pip install faker uuid bcrypt
from faker import Faker
import uuid
import bcrypt
from collections import OrderedDict
locale=OrderedDict([('fr-FR',1)])
fake=Faker('fr-FR')

nombreDePersonne=300


nom=""
prenom=""
num_bureau =""
mail=""
for i in range(nombreDePersonne):
    nomprenom=fake.name().split(' ')
    nom=nomprenom[0]
    prenom=nomprenom[1]
    num_bureau=fake.random_int(1,999)
    mail=f"{nom}.{prenom}@universite.fr"
    print(f"INSERT INTO `personne`(`nom`, `prenom`, `num_bureau`, `mail`, `url_img`) VALUES ('{nom}','{prenom}','{num_bureau}','{mail}','');")


service=[{'libelle':'INFO','etage':1,'description':'Formation Informatique, dévelopement web, réseau et base de données'},
         {'libelle':'GEA', 'etage':2,'description':'Formation Gestion des administration, aspects légaux, sociaux et humains, gestion de projets'},
         {'libelle':'MMI', 'etage':3,'description':'Formation Multimedia et metier de linternet, reseaux sociaux et web'},
         {'libelle':'ADMIN', 'etage':4,'description':'Administration, gestion des services, de la scholarité et de liut'}]
nombreDeService=len(service)
for i in service:
    print(f"INSERT INTO `service`(`libelle`, `etage`, `description`) VALUES ('{i['libelle']}','{i['etage']}','{i['description']}');")

fonction=['Directeur','Directeur adjoint', 'Comptable','Secretaire','Agent d entretien','Professeur','Directeur des études','Technicien']

nombreDeFonction=len(fonction)
for i in fonction:
    print(f"INSERT INTO `fonction`(`libelle`) VALUES ('{i}');")

for i in range(nombreDePersonne):
    proba=fake.random_int(0,100);
    nbNumPhone=1
    if(proba>85):
        nbNumPhone=2;
    for j in range(nbNumPhone):
        id=i
        num=fake.phone_number()
        print(f"INSERT INTO `telephone_personne`(`id_personne`, `num`) VALUES ('{id}','{num}');")


personnService=[]
for i in range(nombreDePersonne):
    proba=fake.random_int(0,100);
    numServicePersonne=1
    if(proba>95):
        numServicePersonne=3
    elif(proba>90):
        numServicePersonne=2
    for j in range(numServicePersonne):
        idPersonne=i
        idService=fake.random_int(1,nombreDeService)
        if( not (idPersonne,idService) in personnService):
            personnService.append((idPersonne,idService))
            print(f"INSERT INTO `personne_service`(`id_personne`, `id_service`) VALUES ('{idPersonne}','{idService}');")

fonctionPersonne=[]
for i in range(nombreDePersonne):
    proba=fake.random_int(0,100);
    numFonctionPersonne=1
    if(proba>95):
        numFonctionPersonne=2
    for j in range(numFonctionPersonne):
        idPersonne=i
        idFonction=fake.random_int(1,nombreDeFonction)
        if(not(idPersonne,idFonction) in fonctionPersonne):
            fonctionPersonne.append((idPersonne,idFonction))
            print(f"INSERT INTO `fonction_personne`(`id_personne`, `id_fonction`) VALUES ('{idPersonne}','{idFonction}');")


adminUsers=[{'id':'','username':'admin1','password':b'adminEmphore','isSuperAdmin':'false'}]
for i in adminUsers:
    print(f"INSERT INTO `admin_user`(`id`, `username`, `password`, `is_super_admin`) VALUES ('{uuid.uuid4()}','{i['username']}','{bcrypt.hashpw(i['password'],bcrypt.gensalt()).decode('utf-8')}',{i['isSuperAdmin']});")
