DROP DATABASE IF EXISTS `decitrephpbackend_v2`;
CREATE DATABASE IF NOT EXISTS `decitrephpbackend_v2`;
USE `decitrephpbackend_v2` ;

CREATE TABLE `product_category` (
  `category_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `category_name` VARCHAR(255)
);

CREATE TABLE `product` (
  `product_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `ean` BIGINT,
  `title` VARCHAR(255) NOT NULL,
  `author` VARCHAR(255),
  `image` VARCHAR(255),
  `price` FLOAT NOT NULL,
  `promo_price` FLOAT,
  `category_id` INT,
  `quantity` INT NOT NULL,
  CONSTRAINT `category_id`
    FOREIGN KEY (`category_id`)
    REFERENCES `decitrephpbackend_v2`.`product_category` (`category_id`)
);

CREATE TABLE `research` (
  `research_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `research_value` VARCHAR(255),
  `nbr_research` INT,
  `product_id` INT,
  CONSTRAINT `product_id`
    FOREIGN KEY (`product_id`)
    REFERENCES `decitrephpbackend_v2`.`product` (`product_id`)
);

CREATE TABLE `user` (
  `user_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `gender` VARCHAR(45),
  `firstname` VARCHAR(255),
  `lastname` VARCHAR(255),
  `email` VARCHAR(255) NOT NULL
);

CREATE TABLE `authentication` (
  `password` TEXT NOT NULL,
  `user_id` INT PRIMARY KEY NOT NULL,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `decitrephpbackend_v2`.`user` (`user_id`)
);

CREATE TABLE `address` (
  `address_id`INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `address_label` VARCHAR(50),
  `address_fullname` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `address_details` VARCHAR(255),
  `city` VARCHAR(255),
  `region` VARCHAR(255),
  `country` VARCHAR(255),
  `phone` VARCHAR(20),
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `decitrephpbackend_v2`.`user` (`user_id`)
);

CREATE TABLE `cart` (
  `cart_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `user_id` INT,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `decitrephpbackend_v2`.`user` (`user_id`)
);

CREATE TABLE `cart_product` (
  `cart_product_id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `ean` BIGINT,
  `title` VARCHAR(255) NOT NULL,
  `author` VARCHAR(255),
  `image` VARCHAR(255),
  `price` FLOAT NOT NULL,
  `promo_price` FLOAT,
  `category_id` INT,
  `cart_id` INT,
  CONSTRAINT `category_id`
    FOREIGN KEY (`category_id`)
    REFERENCES `decitrephpbackend_v2`.`product_category` (`category_id`),
      CONSTRAINT `cart_id`
    FOREIGN KEY (`cart_id`)
    REFERENCES `decitrephpbackend_v2`.`cart` (`cart_id`)
);

CREATE TABLE `command` (
  `command_id` INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `user_id` INT NOT NULL,
  `cart_id` INT NOT NULL,
  `command_total` FLOAT NOT NULL,
  `command_address_id` INT NOT NULL,
  CONSTRAINT `user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `decitrephpbackend_v2`.`user` (`user_id`),
  CONSTRAINT `cart_id`
    FOREIGN KEY (`cart_id`)
    REFERENCES `decitrephpbackend_v2`.`cart` (`cart_id`),
      CONSTRAINT `command_address_id`
    FOREIGN KEY (`command_address_id`)
    REFERENCES `decitrephpbackend_v2`.`command_address` (`command_address_id`)
);

CREATE TABLE `command_address` (
  `command_address_id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `command_fullname` VARCHAR(255),
  `address` VARCHAR(255) NOT NULL,
  `address_details` VARCHAR(255),
  `city` VARCHAR(255),
  `region` VARCHAR(255),
  `country` VARCHAR(255),
  `phone` VARCHAR(20)
);

----------------------------------------------------------------------------

/* Populate tables */
INSERT INTO product (ean, title, image, author, price, promo_price, category_id, quantity) VALUES
(9782070754169, 'Le Petit Prince', 'https://placehold.co/300x400', 'Antoine de Saint-Exupéry', 10.99, NULL, 3, 10),
(9782253084928, "L'Alchimiste", 'https://placehold.co/300x400', 'Paulo Coelho', 9.50, 8.99, 1, 20),
(9782070454837, 'Les Misérables', 'https://placehold.co/300x400', 'Victor Hugo', 12.99, 11.99, 1, 5),
(9782070725985, '1984', 'https://placehold.co/300x400', 'George Orwell', 11.20, NULL, 4, 5),
(9782070368225, 'Le Rouge et le Noir', 'https://placehold.co/300x400', 'Stendhal', 8.75, NULL, 1, 2),
(9782070423260, 'Les Fleurs du Mal', 'https://placehold.co/300x400', 'Charles Baudelaire', 14.99, NULL, 5, 4),
(9782253098710, 'Le Nom de la Rose', 'https://placehold.co/300x400', 'Umberto Eco', 11.75, 10.50, 1, 8),
(9782070413117, 'La Peste', 'https://placehold.co/300x400', 'Albert Camus', 9.25, NULL, 1, 1),
(9782070372581, 'La Nausée', 'https://placehold.co/300x400', 'Jean-Paul Sartre', 8.99, NULL, 1, 1),
(9782253150714, 'Crime et Châtiment', 'https://placehold.co/300x400', 'Fyodor Dostoevsky', 12.50, NULL, 1, 1);

INSERT INTO product_category (category_name) VALUES
('Roman'), 
("BD"), 
("Jeunesse"), 
("Fantastique"), 
("Poésie");

INSERT INTO research (research_value, nbr_research, product_id) VALUES
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

INSERT INTO user (gender, firstname, lastname, email) VALUES
('Mme','Florence', 'Buchelet', 'fbuchelet@decitre.fr');

INSERT INTO authentication (password, user_id) VALUES
('azerty', 1);

INSERT INTO address (user_id, address_label, address_fullname, address, address_details, city, region, country, phone) VALUES
(1, "travail", "Mme Buchelet Florence", "191 rue des Cinq Voies", NULL, "Lille", "Hauts-de-France", "France", NULL),
(1, "maison", "Mme Buchelet Florence", "12 rue de la Rue", "appt chaussette", "Street City", "Région bas trois Belgique chaussette lorem ipsum d'un autre niveau", "Canada", NULL);
