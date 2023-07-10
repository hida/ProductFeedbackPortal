CREATE TABLE client (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  motDePasse VARCHAR(255) NOT NULL
);


CREATE TABLE commentaire (
  id INT PRIMARY KEY AUTO_INCREMENT,
  produit_id INT,
  client_id INT,
  contenu TEXT,
  date DATETIME
);


INSERT INTO client (nom, email, motDePasse) VALUES ('Client 1', 'client1@example.com', 'password1');
INSERT INTO client (nom, email, motDePasse) VALUES ('Client 2', 'client2@example.com', 'password2');


INSERT INTO commentaire (produitId, clientId, contenu, date) VALUES (1, 1, 'Commentaire 1', NOW());
INSERT INTO commentaire (produitId, clientId, contenu, date) VALUES (2, 2, 'Commentaire 2', NOW());
INSERT INTO `clients` (`id`, `nom`, `email`, `motDePasse`) VALUES (3, 'admin', 'admin@admin.com', '$2y$10$B5Ao/afOqciEgw/pZtjTAOh1sDQ6P6TF4yIvvbIEoPjhlVIm0GD4W');