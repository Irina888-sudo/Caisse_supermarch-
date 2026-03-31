-- Création de la base de données
CREATE DATABASE IF NOT EXISTS 4016_4110_checkout;
USE 4016_4110_checkout;

-- Table Produit
CREATE TABLE Produit (
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    designation VARCHAR(100) NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    quantite_stock INT NOT NULL DEFAULT 0
);

-- Table Caisse
CREATE TABLE Caisse (
    id_caisse INT AUTO_INCREMENT PRIMARY KEY,
    numero_caisse VARCHAR(10) NOT NULL UNIQUE
);

-- Table Achat (transaction globale)
CREATE TABLE Achat (
    id_achat INT AUTO_INCREMENT PRIMARY KEY,
    id_caisse INT NOT NULL,
    date_achat DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_caisse) REFERENCES Caisse(id_caisse)
);

-- Table Ligne_achat (détail des produits achetés)
CREATE TABLE Ligne_achat (
    id_ligne INT AUTO_INCREMENT PRIMARY KEY,
    id_achat INT NOT NULL,
    id_produit INT NOT NULL,
    quantite INT NOT NULL CHECK (quantite > 0),
    FOREIGN KEY (id_achat) REFERENCES Achat(id_achat) ON DELETE CASCADE,
    FOREIGN KEY (id_produit) REFERENCES Produit(id_produit)
);