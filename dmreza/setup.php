<?php

// Kreiranje tabela unutar baze podataka
require_once "functions.php";

createTable('users', 
    'id INT UNSIGNED AUTO_INCREMENT,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    INDEX(username(6)),
    PRIMARY KEY(id)'
);

createTable('profiles', 
    'id INT UNSIGNED AUTO_INCREMENT,
    user_id INT UNSIGNED UNIQUE,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    gender VARCHAR(6) NOT NULL,
    language VARCHAR(50) NOT NULL,
    bio TEXT,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(id) ON UPDATE CASCADE ON DELETE NO ACTION
    '
);