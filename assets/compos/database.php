<?php
// Connexion à la base de données
$servername = "localhost"; // Nom de l'hôte (généralement localhost)
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$dbname = "StockIndatebase"; // Nom de la base de données

// Connexion avec MySQLi
$conn = mysqli_connect($servername, $username, $password, $dbname);
?>