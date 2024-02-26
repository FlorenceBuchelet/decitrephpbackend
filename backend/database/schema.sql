DROP DATABASE decitrephpbackend;
CREATE DATABASE decitrephpbackend; 
USE decitrephpbackend; 

CREATE TABLE product (
    product_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    ean BIGINT,
    title VARCHAR(255),
    image VARCHAR(255),
    author VARCHAR(255),
    price FLOAT,
    promo_price FLOAT
    );

CREATE TABLE research (
    research_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    research VARCHAR(255),
    nbr_research INT,
    product_id INT NOT NULL,
    FOREIGN KEY (product_id) REFERENCES product(product_id)
    );

CREATE TABLE user (
    user_id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    gender VARCHAR(20),
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255),
    address TEXT
);

CREATE TABLE authentication (
    password TEXT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);

/* Populate tables */
INSERT INTO product (ean, title, image, author, price, promo_price) VALUES
(9782070754169, 'Le Petit Prince', 'https://placehold.co/300x400', 'Antoine de Saint-Exupéry', 10.99, NULL),
(9782253084928, "L'Alchimiste", 'https://placehold.co/300x400', 'Paulo Coelho', 9.50, 8.99),
(9782070454837, 'Les Misérables', 'https://placehold.co/300x400', 'Victor Hugo', 12.99, 11.99),
(9782070725985, '1984', 'https://placehold.co/300x400', 'George Orwell', 11.20, NULL),
(9782070368225, 'Le Rouge et le Noir', 'https://placehold.co/300x400', 'Stendhal', 8.75, NULL),
(9782070423260, 'Les Fleurs du Mal', 'https://placehold.co/300x400', 'Charles Baudelaire', 14.99, NULL),
(9782253098710, 'Le Nom de la Rose', 'https://placehold.co/300x400', 'Umberto Eco', 11.75, 10.50),
(9782070413117, 'La Peste', 'https://placehold.co/300x400', 'Albert Camus', 9.25, NULL),
(9782070372581, 'La Nausée', 'https://placehold.co/300x400', 'Jean-Paul Sartre', 8.99, NULL),
(9782253150714, 'Crime et Châtiment', 'https://placehold.co/300x400', 'Fyodor Dostoevsky', 12.50, NULL);


INSERT INTO research (research, nbr_research, product_id) VALUES
('Le Petit Prince', 120, 1),
("L'Alchimiste", 95, 2),
('Les Misérables', 80, 3),
('1984', 110, 4),
('Le Rouge et le Noir', 70, 5),
('Les Fleurs du Mal', 90, 6),
('Le Nom de la Rose', 110, 7),
('La Peste', 75, 8),
('La Nausée', 85, 9),
('Crime et Châtiment', 95, 10);

INSERT INTO user (gender, firstname, lastname, email, phone, address) VALUES
('Mme','Florence', 'Buchelet', 'fbuchelet@decitre.fr', '0600000000', '191 rue des Cinq Voies');

INSERT INTO authentication (password, user_id) VALUES
('azerty', 1);

USE decitrephpbackend;