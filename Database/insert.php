<pre>
<?php

require_once("DBconnect.php");

try{

    $player_desc_file = "..\\Data\\player_data.csv";
    $player_stats_file = "..\\Data\\player_stats.csv";
    $game_data_file = "..\\Data\\game_data.csv";
    $team_stats_file = "..\\Data\\team_stats.csv";
    $weather_data_file = "..\\Data\\weather_data.csv";

    $file_1 = fopen($player_desc_file, "r");
    $file_2 = fopen($player_stats_file, "r");
    $file_3 = fopen($game_data_file, "r");
    $file_4 = fopen($team_stats_file, "r");
    $file_5 = fopen($weather_data_file, "r");

} catch(Exception $e){
    echo "File Exception: " . $e->getMessage();
}

try{
    $connection = connect();
    
    // remove entries before inserting
    //$connection->query("DELETE FROM injury");
    $connection->query("DELETE FROM game_stats_player");
    $connection->query("DELETE FROM game_stats_team");
    //$connection->query("DELETE FROM user");
    $connection->query("DELETE FROM weather");
    $connection->query("DELETE FROM game");
    $connection->query("DELETE FROM player");

    // form query strings
    $query_str_plr = "INSERT INTO player
                    VALUES (:game_id, :player_id, :pName, :POS, :team)";
    $query_str_game = "INSERT INTO game
                    VALUES (:game_id, :teamAway, :teamHome, :scoreAway, :scoreHome, :game_date, :OT_yn)";
    $query_str_weather = "INSERT INTO weather
                    VALUES (:game_id, :temperature, :humidity, :wind_speed, :roof, :surface)";
    //$query_str_tStats = "INSERT INTO game_stats_team VALUES";
    //$query_str_pStats = "INSERT INTO game_stats_player VALUES";


    // insert into player table
    while (($row = fgetcsv($file_1)) !== FALSE) {
        $stmt = $connection->prepare($query_str_plr);

        $stmt->bindParam(":game_id", $row[0], PDO::PARAM_STR);
        $stmt->bindParam(":player_id", $row[1], PDO::PARAM_STR);
        $stmt->bindParam(":pName", $row[2], PDO::PARAM_STR);
        $stmt->bindParam(":POS", $row[3], PDO::PARAM_STR);
        $stmt->bindParam(":team", $row[4], PDO::PARAM_STR);

        $stmt->execute();
    }

    // insert into game table
    while (($row = fgetcsv($file_3)) !== FALSE) {
        $stmt = $connection->prepare($query_str_game);

        $stmt->bindParam(":game_id", $row[0], PDO::PARAM_STR);
        $stmt->bindParam(":teamAway", $row[1], PDO::PARAM_STR);
        $stmt->bindParam(":teamHome", $row[2], PDO::PARAM_STR);
        $stmt->bindParam(":scoreAway", $row[3], PDO::PARAM_STR);
        $stmt->bindParam(":scoreHome", $row[4], PDO::PARAM_STR);
        $stmt->bindParam(":game_date", $row[6], PDO::PARAM_STR);
        $stmt->bindParam(":OT_yn", $row[5], PDO::PARAM_STR);

        $stmt->execute();
    }

    // insert into weather table
    while (($row = fgetcsv($file_5)) !== FALSE) {
        $stmt = $connection->prepare($query_str_weather);

        $stmt->bindParam(":game_id", $row[0], PDO::PARAM_STR);
        $stmt->bindParam(":temperature", $row[1], PDO::PARAM_STR);
        $stmt->bindParam(":humidity", $row[2], PDO::PARAM_STR);
        $stmt->bindParam(":wind_speed", $row[3], PDO::PARAM_STR);
        $stmt->bindParam(":roof", $row[4], PDO::PARAM_STR);
        $stmt->bindParam(":surface", $row[5], PDO::PARAM_STR);

        $stmt->execute();
    }

} catch(PDOexecption $error){
    echo "Database connection error: " . $error->getmessage() . "<BR>";
    die;
}
?>
Data inserted successfully.
</pre>