CREATE DATABASE youdemy;

USE youdemy;

CREATE TABLE role(
  id_role INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL
);

CREATE TABLE utilisateur(
  id_user INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE, 
  id_role INT NOT NULL,
  FOREIGN KEY (id_role) REFERENCES role(id_role)
    ON DELETE CASCADE
);

CREATE TABLE categorie(
  id_cat INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL
);


CREATE TABLE tag(
  id_tag INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL
);

CREATE TABLE cours(
  id_cours INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  description VARCHAR(255) NOT NULL,
  article VARCHAR(255) NOT NULL,
  video VARCHAR(255) NOT NULL,
  id_user INT NOT NULL,
  id_cat INT NOT NULL,
  id_tag INT NOT NULL,
  FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
    ON DELETE CASCADE,
  FOREIGN KEY (id_cat) REFERENCES categorie(id_cat)
    ON DELETE CASCADE,
  FOREIGN KEY (id_tag) REFERENCES tag(id_tag)
    ON DELETE CASCADE
);

CREATE TABLE commentaire(
  id_comm INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  comment VARCHAR(255) NOT NULL,
  id_user INT NOT NULL,
  FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
    ON DELETE CASCADE
);

CREATE TABLE tag_cours(
  id_tag INT NOT NULL,
  id_cours INT NOT NULL,
  PRIMARY KEY (id_tag, id_cours),
  FOREIGN KEY (id_tag) REFERENCES tag(id_tag)
    ON DELETE CASCADE,
  FOREIGN KEY (id_cours) REFERENCES cours(id_cours)
    ON DELETE CASCADE
);

CREATE TABLE student_cours(
  id_user INT NOT NULL,
  id_cours INT NOT NULL,
  PRIMARY KEY (id_user, id_cours), 
  FOREIGN KEY (id_user) REFERENCES utilisateur(id_user)
    ON DELETE CASCADE,
  FOREIGN KEY (id_cours) REFERENCES cours(id_cours)
    ON DELETE CASCADE
);