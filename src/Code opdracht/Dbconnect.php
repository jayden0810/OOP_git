<?php
$server = "localhost"; 
$username = "root";
$password = ""; 
$db = "login";

try {
  $dbConnection = new PDO("mysql:host=$server; dbname=$db", $username, $password);
  $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Verbinding mislukt" . $e->getMessage();
}
?>