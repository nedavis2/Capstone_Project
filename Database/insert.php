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
    $query_str_tStats = "INSERT INTO game_stats_team 
                    VALUES (:game_date, :game_id, :team, :pass_comp, :pass_att, :pass_yds, :pass_td, :pass_int, :pass_sacked,
                            :pass_sacked_yds, :pass_long, :pass_rating, :rush_att, :rush_yds, :rush_td, :rush_long, :targets,
                            :rec, :rec_yds, :rec_td, :rec_long, :fumbles_lost, :rush_scrambles, :designed_rush_att, :comb_pass_rush_play,
                            :comb_pass_play, :comb_rush_play, :two_point_conv, :total_ret_td, :offensive_fumble_recovery_td, :pass_yds_bonus,
                            :rush_yds_bonus, :rec_yds_bonus, :pass_target_yds, :pass_poor_throws, :pass_blitzed, :pass_hurried,
                            :rush_yds_before_contact, :rush_yac, :rush_broken_tackles, :rec_air_yds, :rec_yac, :rec_drops, :offense,
                            :off_pct, :yds_per_rec, :yds_per_rush, :yds_per_target)";
    $query_str_pStats = "INSERT INTO game_stats_player 
                    VALUES (:game_date, :game_id, :player_id, :player, :pos, :pass_comp, :pass_att, :pass_yds, :pass_td, :pass_int, :pass_sacked,
                            :pass_sacked_yds, :pass_long, :pass_rating, :rush_att, :rush_yds, :rush_td, :rush_long, :targets,
                            :rec, :rec_yds, :rec_td, :rec_long, :fumbles_lost, :rush_scrambles, :designed_rush_att, :comb_pass_rush_play,
                            :comb_pass_play, :comb_rush_play, :two_point_conv, :total_ret_td, :offensive_fumble_recovery_td, :pass_yds_bonus,
                            :rush_yds_bonus, :rec_yds_bonus, :pass_target_yds, :pass_poor_throws, :pass_blitzed, :pass_hurried,
                            :rush_yds_before_contact, :rush_yac, :rush_broken_tackles, :rec_air_yds, :rec_yac, :rec_drops, :offense,
                            :off_pct, :yds_per_rec, :yds_per_rush, :yds_per_target)";


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