<?php


$password = "";

function configure( $host, &$username, &$password, &$options, $dbname, &$dsn){
    $host = $host ? $host : "localhost";
    $options = $options ? $options : array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );
    $dbname = $dbname ? $dbname : "capstone_project";
    $dsn        = "mysql:host=$host;dbname=$dbname";
}
?>