CREATE DATABASE IF NOT EXISTS pacte_de_gray
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE pacte_de_gray;

-- ===============================================================
-- GROUPE 1 : Tables de référence (categorie, utilisateur)
-- ===============================================================

CREATE TABLE categorie (
    categorie_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR (100) NOT NULL,
    type ENUM ('personnage', 'lieu') NOT NULL
);

CREATE TABLE utilisateur (
    utilisateur_id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    token_reset VARCHAR(255),
    token_expiration DATETIME
);

-- ===============================================================
-- GROUPE 2 : Tables principales (personnage, lieu)
-- ===============================================================

CREATE TABLE personnage (
    personnage_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(150) NOT NULL,
    prenom VARCHAR(150),
    image VARCHAR(255),
    age VARCHAR(50),
    ville VARCHAR(100),
    pays VARCHAR(100),
    rang VARCHAR(100),
    statut VARCHAR (100),
    role ENUM('protagoniste', 'antagoniste', 'secondaire') NOT NULL,
    citation TEXT,
    description TEXT,
    actif BOOLEAN DEFAULT TRUE,
    categorie_id INT NOT NULL,
    FOREIGN KEY (categorie_id) REFERENCES categorie(categorie_id) 
);

CREATE TABLE lieu (
    lieu_id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(150) NOT NULL,
    image VARCHAR(255),
    ville VARCHAR(100),
    pays VARCHAR(100),
    description TEXT,
    actif BOOLEAN DEFAULT TRUE,
    categorie_id INT NOT NULL,
    FOREIGN KEY (categorie_id) REFERENCES categorie(categorie_id)
);

-- ===============================================================
-- GROUPE 3 : Tables de liaison 
-- ===============================================================
 
CREATE TABLE personnage_lieu (
    personnage_id INT NOT NULL,
    lieu_id INT NOT NULL,
    PRIMARY KEY (personnage_id, lieu_id),
    FOREIGN KEY (personnage_id) REFERENCES personnage(personnage_id),
    FOREIGN KEY (lieu_id) REFERENCES lieu(lieu_id)
);

-- ===============================================================
-- GROUPE 4 : Table métier (article)
-- ===============================================================

CREATE TABLE article (
    article_id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(200) NOT NULL,
    contenu TEXT NOT NULL,
    image VARCHAR(255),
    publie BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    utilisateur_id INT NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (utilisateur_id)
);

-- ===============================================================
-- Données test
-- ===============================================================

-- Catégories personnages
INSERT INTO categorie (nom, type) VALUES
('Personnages principaux', 'personnage'),
('Personnages secondaires', 'personnage'),
('Antagonistes', 'personnage');

-- Catégories lieux
INSERT INTO categorie (nom, type) VALUES
('Lieux clés', 'lieu'),
('Londre victorienne', 'lieu');


-- ==========================================================================
-- Les personnages de Dorian Gray
-- ==========================================================================

INSERT INTO personnage (nom, prenom, image, age, ville, pays, rang, statut, role, citation, description, actif, categorie_id) VALUES
('Gray', 'Dorian', 'dorian.jpg', '20 ans', 'Londres', 'Angleterre', 'Aristocrate', 'Vivant', 'protagoniste', 
'La seule façon de se débarrasser d une tentation, c est d y céder.', 
'Jeune homme d une beauté exceptionnelle, Dorian Gray fait un pacte faustien pour rester éternellement jeune pendant que son portrait vieillit à sa place.', 
TRUE, 1),

('Wotton', 'Henry', 'henry.jpg', '35 ans', 'Londres', 'Angleterre', 'Lord', 'Vivant', 'secondaire',
'Je ne veux pas être à la merci de mes émotions. Je veux les utiliser, en jouir et les dominer.',
'Cynique et brillant, Lord Henry influence Dorian avec sa philosophie hédoniste et corruptrice.',
TRUE, 2),

('Hallward', 'Basil', 'basil.jpg', '38 ans', 'Londres', 'Angleterre', 'Bourgeois', 'Mort', 'secondaire',
'Je vois tout dans le visage de Dorian.',
'Peintre talentueux et ami loyal de Dorian, il est l auteur du portrait maudit.',
TRUE, 2);

-- ==========================================================================
-- Les lieux 
-- ==========================================================================

INSERT INTO lieu (nom, image, ville, pays, description, actif, categorie_id) VALUES
('L\'atelier de Basil', 'atelier.jpg', 'Londres', 'Angleterre', 
'L\'atelier où Basil Hallward peint le portrait maudit de Dorian Gray. Lieu de création et de perdition.', 
TRUE, 4),

('Le grenier de Dorian', 'grenier.jpg', 'Londres', 'Angleterre',
'Pièce secrète où Dorian cache son portrait maudit, témoin silencieux de sa corruption morale.',
TRUE, 4),

('Les clubs londoniens', 'clubs.jpg', 'Londres', 'Angleterre',
'Les cercles mondains de la haute société victorienne où Dorian mène sa double vie.',
TRUE, 5),

('Le théâtre de Sibyl', 'theatre.jpg', 'Londres', 'Angleterre',
"Théâtre modeste de l\'East End où Dorian découvre Sibyl Vane et tombe amoureux de son talent.",
TRUE, 5);

-- ==========================================================================
--  Personnage-lieu (liaison)
-- ==========================================================================

INSERT INTO personnage_lieu (personnage_id, lieu_id) VALUES
-- Dorian Gray
(1, 1), -- L'atelier de Basil
(1, 2), -- Le grenier
(1, 3), -- Les clubs londoniens
(1, 4), -- Le théâtre
-- Lord Henry
(2, 1), -- L'atelier de Basil
(2, 3), -- Les clubs londoniens
-- Basil Hallward
(3, 1); -- L'atelier de Basil

-- ==========================================================================
-- Utilisateur de test
-- ==========================================================================

INSERT INTO utilisateur (email, mot_de_passe) VALUES
('admin@pacte-de-gray.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');


-- ==========================================================================
-- Article de test
-- ==========================================================================

INSERT INTO article (titre, contenu, image, publie, utilisateur_id) VALUES
('Bienvenue sur Le Pacte de Gray', 
'Plongez dans l\'univers sombre et fascinant du roman Le Portrait de Dorian Gray d\'Oscar Wilde. Découvrez les personnages, les lieux et les secrets de cette œuvre gothique intemporelle.', 
'article1.jpg', 
TRUE, 
1);

