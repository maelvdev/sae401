CREATE TABLE UTILISATEUR (
   id INT AUTO_INCREMENT,
   statut VARCHAR(50) NOT NULL,
   nom VARCHAR(50) NOT NULL,
   email VARCHAR(50) NOT NULL,
   motDePasse VARCHAR(50) NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE EVENEMENT (
   id INT AUTO_INCREMENT,
   titre VARCHAR(50) NOT NULL,
   date_ DATETIME NOT NULL,
   lieu VARCHAR(50) NOT NULL,
   description VARCHAR(500) NOT NULL,
   nbPlaces INT NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE INSCRIPTION (
   idUtilisateur INT,
   idEvenement INT,
   dateInscription DATETIME NOT NULL,
   PRIMARY KEY(idUtilisateur, idEvenement),
   FOREIGN KEY(idUtilisateur) REFERENCES UTILISATEUR(id),
   FOREIGN KEY(idEvenement) REFERENCES EVENEMENT(id)
);

CREATE TABLE ARTICLE (
   id INT AUTO_INCREMENT,
   titre VARCHAR(50) NOT NULL,
   contenu VARCHAR(50) NOT NULL,
   datePublication DATETIME NOT NULL,
   idAuteur INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(idAuteur) REFERENCES UTILISATEUR(id)
);

CREATE TABLE PRODUIT (
   id INT AUTO_INCREMENT,
   nom VARCHAR(50) NOT NULL,
   prix INT NOT NULL,
   taille VARCHAR(1) NOT NULL,
   stock INT NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE COMMANDE (
   id INT AUTO_INCREMENT,
   idUtilisateur INT NOT NULL,
   dateCommande DATETIME NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(idUtilisateur) REFERENCES UTILISATEUR(id)
);

CREATE TABLE Passer (
   idUtilisateur INT,
   idCommande INT,
   PRIMARY KEY(idUtilisateur, idCommande),
   FOREIGN KEY(idUtilisateur) REFERENCES UTILISATEUR(id),
   FOREIGN KEY(idCommande) REFERENCES COMMANDE(id)
);

CREATE TABLE QuestionsFrequentes (
   idQuestion INT,
   question   VARCHAR(50 ) NOT NULL,
   reponse    VARCHAR(200) NOT NULL,
   PRIMARY KEY(idQuestion)
);

CREATE TABLE Contact (
    idContact INT,
    nom        VARCHAR(40)  NOT NULL
    prenom    VARCHAR(30)  NOT NULL,
    mail    VARCHAR(50 ) NOT NULL,
    demande VARCHAR(200) NOT NULL
):