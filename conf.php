<?php
// constantes qui vont nous permettre de nous connecter a la base donnée
define("DB_NAME", "college_correction");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_HOST", "localhost");

// connexion à la base de donnée grace à PDO 
$pdo = new PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST, DB_USER, DB_PASSWORD);
?>
