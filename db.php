<?php

// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$dbname = "buildit";

$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>