<?php
$host = "localhost";
$dbname = "BoardPlayGR_db";
$user = "root";
$password = "";

try{
    $pdo = new PDO("mysql:host=$host; dbname=$dbname; charset=utf8" ,$user, $password);
}
catch(PDOException $e){
    die("Database Connection Failed: " . $e->getMessage());
}

?>