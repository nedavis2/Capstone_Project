<?php
    error_reporting(E_ALL);
    ini_set('display_errors', True);

    require 'php/DBconnect.php';
    $connection = connect();
    $_SESSION["TEST"] = True;
    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', True);

   
    $user_email = $_SESSION['email'];    
    $target = $_POST['qb-button'];
    $stmt= $connection->prepare("UPDATE user SET QB = ? WHERE user_email=?");
    $stmt->execute([$target[0], $user_email]);
    
    
    
    $connection = null;
    
?>
