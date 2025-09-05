<?php

$host = 'localhost';          // 
$dbname = 'myfirstdatabase';  //
$dbusername = 'root';
$dbpassword = '';

try {        //php data object
  $pdo = new PDO("mysql:host=$host; dbname=$dbname", $dbusername, $dbpassword);
  
  $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
  die('Connection Failed: '. $e->getMessage());
}
