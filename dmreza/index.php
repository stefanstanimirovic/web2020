<?php
// 1) Proceduralni (ugradjene funkcije)
// 2) OOP (metode objekata)
// 2.1) mysqli
// 2.2) PDO

$dbhost = "localhost";
$dbname = "dmreza";
$dbuser = "dmadmin";
$dbpass = "dmadmin123";

// Objekat konekcije
$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

var_dump($connection);