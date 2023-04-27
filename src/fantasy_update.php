<?php
error_reporting(E_ALL);
ini_set('display_errors', True);

//Include database credentials and create connection
require 'php/DBconnect.php';
require_once 'config.php';
$connection = connect();
$_SESSION["TEST"] = True;
error_reporting(E_ALL);
ini_set('display_errors', True);

//Checks if user email is set
if (isset($_SESSION['email'])) {

    //Changes QB
    if (isset($_POST['qb-button'])) {
        $user_email = $_SESSION['email'];
        $target = $_POST['qb-button'];
        $stmt = $connection->prepare("UPDATE user SET QB = ? WHERE user_email=?");
        $stmt->execute([$target, $user_email]);
    }

    //Changes RB1
    if (isset($_POST['rb1-button'])) {
        $user_email = $_SESSION['email'];
        $target = $_POST['rb1-button'];
        $stmt = $connection->prepare("UPDATE user SET RB_1 = ? WHERE user_email=?");
        $stmt->execute([$target, $user_email]);
    }

    //Changes RB2
    if (isset($_POST['rb2-button'])) {
        $user_email = $_SESSION['email'];
        $target = $_POST['rb2-button'];
        $stmt = $connection->prepare("UPDATE user SET RB_2 = ? WHERE user_email=?");
        $stmt->execute([$target, $user_email]);
    }

    //Changes WR1
    if (isset($_POST['wr1-button'])) {
        $user_email = $_SESSION['email'];
        $target = $_POST['wr1-button'];
        $stmt = $connection->prepare("UPDATE user SET WR_1 = ? WHERE user_email=?");
        $stmt->execute([$target, $user_email]);
    }

    //Changes WR2
    if (isset($_POST['wr2-button'])) {
        $user_email = $_SESSION['email'];
        $target = $_POST['wr2-button'];
        $stmt = $connection->prepare("UPDATE user SET WR_2 = ? WHERE user_email=?");
        $stmt->execute([$target, $user_email]);
    }

    //CHanges TE
    if (isset($_POST['te-button'])) {
        $user_email = $_SESSION['email'];
        $target = $_POST['te-button'];
        $stmt = $connection->prepare("UPDATE user SET TE = ? WHERE user_email=?");
        $stmt->execute([$target, $user_email]);
    }

    //Changes Flex
    if (isset($_POST['flx-button'])) {
        $user_email = $_SESSION['email'];
        $target = $_POST['flx-button'];
        $stmt = $connection->prepare("UPDATE user SET Flex = ? WHERE user_email=?");
        $stmt->execute([$target, $user_email]);
    }

    //Changes Team
    if (isset($_POST['f-team-button'])) {
        $user_email = $_SESSION['email'];
        $target = $_POST['f-team-button'];
        $stmt = $connection->prepare("UPDATE user SET Team = ? WHERE user_email=?");
        $stmt->execute([$target, $user_email]);
    }
}

//Close connection
$connection = null;

//Return to fantasy page
header("Location: ../src/fantasy.php"); 
?>
