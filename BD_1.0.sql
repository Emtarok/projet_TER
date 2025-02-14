CREATE DATABASE postit;

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
    date DATETIME NOT NULL,
    idutilisateur INT NOT NULL,
    FOREIGN KEY (idutilisateur) REFERENCES utilisateurs(idutilisateur) ON DELETE CASCADE
);

CREATE TABLE faits (
    idfaits INT AUTO_INCREMENT PRIMARY KEY,
    id_postit INT NOT NULL,
    id_utilisateur INT NOT NULL,
    id_utilisateur_partage INT NOT NULL,
    FOREIGN KEY (id_postit) REFERENCES postit(idpostit) ON DELETE CASCADE,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(idutilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_utilisateur_partage) REFERENCES utilisateurs(idutilisateur) ON DELETE CASCADE,
    UNIQUE (id_postit, id_utilisateur_partage)
);

INSERT INTO utilisateurs (nom, prenom, pseudo, email, date_naissance, motdepasse)
VALUES ('Vuillot', 'Kevin-Swami', 'kevin', 'kevin@gmail.com', '2002-01-01', '');

INSERT INTO utilisateurs (nom, prenom, pseudo, email, date_naissance, motdepasse)
VALUES ('Legrand', 'Sophie', 'sophie', 'sophie@gmail.com', '2002-01-01', '');

INSERT INTO utilisateurs (nom, prenom, pseudo, email, date_naissance, motdepasse)
VALUES ('M''Baye', 'Fatimata', 'fatimata', 'fatimata@gmail.com', '2002-01-01', '');

INSERT INTO utilisateurs (nom, prenom, pseudo, email, date_naissance, motdepasse)
VALUES ('Rakotoson', 'Hasimbola', 'hasimbola', 'hasimbola@gmail.com', '2002-01-01', '');
