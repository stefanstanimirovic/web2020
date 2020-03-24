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