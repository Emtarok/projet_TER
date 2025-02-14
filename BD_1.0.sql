CREATE DATABASE postit;

-- Table des dimensions
CREATE TABLE Utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    pseudo VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(100) NOT NULL
);

CREATE TABLE PostIt (
    id_postit INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(200) NOT NULL,
    contenu TEXT NOT NULL,
    date_creation DATETIME NOT NULL,
    id_utilisateur INT NOT NULL,
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE
);

-- Table des faits : Fait_PostIt (centralise post-its et partages)
CREATE TABLE Fait_PostIt (
    id_fait INT AUTO_INCREMENT PRIMARY KEY,
    id_postit INT NOT NULL,
    id_utilisateur_auteur INT NOT NULL,
    id_utilisateur_partage INT NOT NULL,
    FOREIGN KEY (id_postit) REFERENCES PostIt(id_postit) ON DELETE CASCADE,
    FOREIGN KEY (id_utilisateur_auteur) REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
    FOREIGN KEY (id_utilisateur_partage) REFERENCES Utilisateur(id_utilisateur) ON DELETE CASCADE,
    UNIQUE (id_postit, id_utilisateur_partage) -- Évite les doublons de partage
);