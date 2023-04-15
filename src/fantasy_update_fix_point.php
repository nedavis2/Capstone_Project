<?php
    error_reporting(E_ALL);
    ini_set('display_errors', True);

    require 'php/DBconnect.php';
    $connection = connect();
    $_SESSION["TEST"] = True;
    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', True);


    $user_email = 'lww1117@gmail.com';
    $target = 'SmitAl03';
    $stmt= $connection->prepare("UPDATE user SET QB = ? WHERE user_email=?");
    $stmt->execute([$target, $user_email]);

    $user_email = 'lww1117@gmail.com';
    $target = 'JoneAa00';
    $stmt= $connection->prepare("UPDATE user SET RB_1 = ? WHERE user_email=?");
    $stmt->execute([$target, $user_email]);
    $user_email = 'lww1117@gmail.com';
    $target = 'MattAl01';
    $stmt= $connection->prepare("UPDATE user SET RB_2 = ? WHERE user_email=?");
    $stmt->execute([$target, $user_email]);
    $user_email = 'lww1117@gmail.com';
    $target = 'HumpAd00';
    $stmt= $connection->prepare("UPDATE user SET WR_1 = ? WHERE user_email=?");
    $stmt->execute([$target, $user_email]);
    $user_email = 'lww1117@gmail.com';
    $target = 'JeffAl00';
    $stmt= $connection->prepare("UPDATE user SET WR_2 = ? WHERE user_email=?");
    $stmt->execute([$target, $user_email]);
    $user_email = 'lww1117@gmail.com';
    $target = 'RogeAr00';
    $stmt= $connection->prepare("UPDATE user SET TE = ? WHERE user_email=?");
    $stmt->execute([$target, $user_email]);
    $user_email = 'lww1117@gmail.com';
    $target = 'ScotBo02';
    $stmt= $connection->prepare("UPDATE user SET Flex = ? WHERE user_email=?");
    $stmt->execute([$target, $user_email]);$user_email = 'lww1117@gmail.com';
    $target = 'ATL';
    $stmt= $connection->prepare("UPDATE user SET Team = ? WHERE user_email=?");
    $stmt->execute([$target, $user_email]);
   
    /*$user_email = $_SESSION['email'];    
    $target = $_POST['qb-button'];
    $stmt= $connection->prepare("UPDATE user SET QB = ? WHERE user_email=?");
    $stmt->execute([$target[0], $user_email]);*/
    
    
    
    $connection = null;
    
?>
