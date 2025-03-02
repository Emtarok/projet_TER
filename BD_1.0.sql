CREATE DATABASE postit;
USE postit;

CREATE TABLE utilisateurs (
    idutilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    pseudo VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    date_naissance DATE NOT NULL,
    motdepasse VARCHAR(100) NOT NULL
);

CREATE TABLE postit (
    idpostit INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    contenu TEXT NOT NULL,
    date_post DATETIME NOT NULL,
    idutilisateur INT NOT NULL
);

CREATE TABLE faits (
    idfaits INT AUTO_INCREMENT PRIMARY KEY,
    id_postit INT,
    id_utilisateur INT NOT NULL,
    id_utilisateur_partage INT,
    FOREIGN KEY (id_postit) REFERENCES postit(idpostit) ON DELETE CASCADE,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(idutilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_utilisateur_partage) REFERENCES utilisateurs(idutilisateur) ON DELETE CASCADE,
    UNIQUE (id_postit, id_utilisateur_partage)
);

ALTER TABLE postit
ADD CONSTRAINT FK_postit_utilisateur
FOREIGN KEY (idutilisateur) REFERENCES faits(id_utilisateur)
ON DELETE CASCADE;