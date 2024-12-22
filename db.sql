

create database blog;
use blog;

CREATE TABLE users (
    iduser INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idrole INT NOT NULL,
    FOREIGN KEY (idrole) REFERENCES roles(idrole)
);

ALTER TABLE users
ADD CONSTRAINT fk_idrole FOREIGN KEY (idrole) REFERENCES roles(idrole) ON DELETE CASCADE ON UPDATE CASCADE;


select * from users;

CREATE TABLE roles (
    idrole INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL
);

CREATE TABLE tags (
    idtag INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100)
);

CREATE TABLE tag_article (
    idtag_article INT PRIMARY KEY AUTO_INCREMENT,
    idtag INT NOT NULL,
    idarticle INT NOT NULL,
    FOREIGN KEY (idtag) REFERENCES tags(idtag),
    FOREIGN KEY (idarticle) REFERENCES articles(idarticle)
);

ALTER TABLE articles ADD COLUMN image VARCHAR(255);
ALTER TABLE articles DROP COLUMN image;
ALTER TABLE articles ADD COLUMN image TEXT;
ALTER TABLE articles ADD COLUMN  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

select * from articles;

CREATE TABLE articles (
    idarticle INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    iduser INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (iduser) REFERENCES users(iduser) ON DELETE CASCADE
);

CREATE TABLE comments (
    idcomment INT PRIMARY KEY AUTO_INCREMENT,
    idarticle INT NOT NULL,
    iduser INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idarticle) REFERENCES articles(idarticle) ON DELETE CASCADE,
    FOREIGN KEY (iduser) REFERENCES users(iduser) ON DELETE CASCADE
);

ALTER TABLE comments ADD COLUMN  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

CREATE TABLE likes (
    idlike INT PRIMARY KEY AUTO_INCREMENT,
    iduser INT NOT NULL,
    idarticle INT NOT NULL,
    FOREIGN KEY (iduser) REFERENCES users(iduser) ON DELETE CASCADE,
    FOREIGN KEY (idarticle) REFERENCES articles(idarticle) ON DELETE CASCADE
);

CREATE TABLE userLogin (
    id INT PRIMARY KEY AUTO_INCREMENT,
    iduser INT NOT NULL,
    token VARCHAR(255) NOT NULL,
    FOREIGN KEY (iduser) REFERENCES users(iduser) ON DELETE CASCADE
);

select * from userLogin;

SELECT * FROM roles;

INSERT INTO roles (idrole, name) VALUES (1, 'Admin');
INSERT INTO roles (idrole, name) VALUES (2, 'User');






