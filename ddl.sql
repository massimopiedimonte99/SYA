# creazione del database
CREATE DATABASE sya;
USE sya;

# creazione delle tabelle
CREATE TABLE utenti(
    ID INT AUTO_INCREMENT,
    Nome VARCHAR(255) NOT NULL,
    Cognome VARCHAR(255) NOT NULL,
    Username Varchar(20) NOT NULL,
    Password Varchar(50) NOT NULL,
    PRIMARY KEY(ID)
);

CREATE TABLE opera(
    ID INT AUTO_INCREMENT,
    Titolo VARCHAR(255) NOT NULL,
    DataPubblicazione DATE NOT NULL,
    Autore INT NOT NULL,
    Tipo ENUM('Foto', 'Disegno') NOT NULL,
    Licenza ENUM('CC0', 'CC BY-NC-ND', 'CC BY-NC-SA', 'CC BY-SA', 'CC BY-ND', 'CC BY-NC', 'CC BY') NOT NULL,
    PRIMARY KEY(ID),
    FOREIGN KEY(Autore) REFERENCES utenti(ID)
);

ALTER TABLE opera ADD COLUMN Filepath VARCHAR(255) NOT NULL;
ALTER TABLE utenti ADD UNIQUE (Username);
ALTER TABLE utenti CHANGE Password Pass VARCHAR(255) NOT NULL;
