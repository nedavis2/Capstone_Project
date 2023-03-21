<?php
    error_reporting(E_ALL);
    ini_set('display_errors', True);

    require 'php/DBconnect.php';
    $connection = connect();



    $stmt = $connection->prepare("INSERT INTO nfl_pass_rush_receive_raw_data (player, team)
    VALUES ('Gumby Durn', JST);;");
    $stmt->execute(); //execute the statement with no arguments (prepare statement has no ? attributes)
    print('did it');
?>