-- Suppression des fonctions
DROP FUNCTION IF EXISTS getinfoproduit(integer);
DROP FUNCTION IF EXISTS listeproduitsclient(integer);
DROP FUNCTION IF EXISTS getproduitsacommander(integer);
DROP FUNCTION IF EXISTS getproduitsacommander(numeric);

-- Suppression des tables avec leurs dépendances
DROP TABLE IF EXISTS achat CASCADE;
DROP TABLE IF EXISTS commande CASCADE;
DROP TABLE IF EXISTS inscription_evenement CASCADE;
DROP TABLE IF EXISTS contact_messages CASCADE;
DROP TABLE IF EXISTS utilisateur CASCADE;
DROP TABLE IF EXISTS evenement CASCADE;
DROP TABLE IF EXISTS produit CASCADE;

-- Création de la table PRODUIT
CREATE TABLE PRODUIT (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    description VARCHAR(500),
    prix DECIMAL(10,2) NOT NULL,
    stock INTEGER NOT NULL,
    taille VARCHAR(50)[],
    couleurs VARCHAR(50)[]
);

-- Insertion des données dans la table existante
INSERT INTO produit (nom, description, prix, stock, taille, couleurs) VALUES
('T-Shirt BDE', 'T-Shirt avec logo du BDE', 15.00, 50, ARRAY['S','M','L','XL'], ARRAY['noir','blanc']),
('Sweat BDE', 'Sweat à capuche avec logo du BDE', 35.00, 30, ARRAY['S','M','L','XL'], ARRAY['gris','noir']),
('Mug BDE', 'Mug en céramique avec logo du BDE', 8.00, 100, NULL, ARRAY['blanc']);
