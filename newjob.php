<?php

$host = getenv('IP');
$username = getenv('C9_USER');
$password = '';
$dbname = 'HireMeDB';

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e){
  echo $e;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
}  