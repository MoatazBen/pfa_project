-- Créer la base de données
CREATE DATABASE IF NOT EXISTS Pfa_MechaServices;

-- Utiliser la base de données
USE vente_pneus_et_huile;

-- Table pour les produits (pneus et huile)
CREATE TABLE IF NOT EXISTS produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    quantite_stock INT NOT NULL,
    type_produit ENUM('pneu', 'huile') NOT NULL,
    INDEX idx_type_produit (type_produit),
    INDEX idx_prix (prix),
    INDEX idx_quantite_stock (quantite_stock)
) ENGINE=InnoDB;

-- Table pour les clients
CREATE TABLE IF NOT EXISTS clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20),
    adresse VARCHAR(255),
    INDEX idx_nom (nom),
    INDEX idx_email (email)
) ENGINE=InnoDB;

-- Table pour les commandes
CREATE TABLE IF NOT EXISTS commandes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    date_commande TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    montant_total DECIMAL(10, 2) NOT NULL,
    INDEX idx_client_id (client_id),
    INDEX idx_date_commande (date_commande)
) ENGINE=InnoDB;

-- Table pour les détails de commande
CREATE TABLE IF NOT EXISTS details_commande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    produit_id INT NOT NULL,
    quantite INT NOT NULL,
    prix_unitaire DECIMAL(10, 2) NOT NULL,
    montant_total DECIMAL(10, 2) NOT NULL,
    INDEX idx_commande_id (commande_id),
    INDEX idx_produit_id (produit_id),
    INDEX idx_quantite (quantite),
    INDEX idx_prix_unitaire (prix_unitaire)
) ENGINE=InnoDB;

-- Table pour les prestations de service
CREATE TABLE IF NOT EXISTS prestations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    INDEX idx_prix (prix)
) ENGINE=InnoDB;

-- Table pour les commandes de prestation
CREATE TABLE IF NOT EXISTS commandes_prestations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    commande_id INT NOT NULL,
    prestation_id INT NOT NULL,
    INDEX idx_commande_id (commande_id),
    INDEX idx_prestation_id (prestation_id)
) ENGINE=InnoDB;
