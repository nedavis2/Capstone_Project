<?php

try  {
  require_once("dbconfig.php"); //database access details

  //Populate these four variables
  $host = "localhost";//Domain name of database server
  $dbname = "capstone_project";//name of your database
  $username = "root";//SQL user
  $options = null;

  configure($host, $username, $password, $options, $dbname, $dsn);

  $connection = new PDO($dsn, $username, $password, $options); //create database connection and get handler

  $stmt = $connection->prepare("SELECT player FROM nfl_pass_rush_receive_raw_data where player = 'aaron rodgers' and game_date = '2019-09-05'");
  $stmt->execute(); 
  $result = $stmt->fetch();
  foreach($result as $result){
    print_r($result);
}
  
  
}

catch(PDOException $error) {
  //if connection failed, print error and exit;
  echo "Database connection error: " . $error->getMessage() . "<BR>";
  die;
}
?>