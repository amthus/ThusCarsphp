<?php
    session_start();
    $server = "localhost";
    $root = "root";
    $password = "";

   try{
    $connect = new PDO("mysql:host=$server;dbname=test",$root, $password);
    $connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   catch(PDOException $e){
    echo 'Echec de la connexion : ' .$e->getMessage();
   }
?>