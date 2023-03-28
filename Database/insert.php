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

    //insert into team_stats // file_4
    while (($row = fgetcsv($file_4)) !== FALSE) {
        $stmt = $connection->prepare($query_str_tStats);

        $stmt->bindParam(":game_date", $row[0], PDO::PARAM_STR);
        $stmt->bindParam(":game_id", $row[1], PDO::PARAM_STR);
        $stmt->bindParam(":team", $row[2], PDO::PARAM_STR);
        $stmt->bindParam(":pass_comp", $row[3], PDO::PARAM_STR);
        $stmt->bindParam(":pass_att", $row[4], PDO::PARAM_STR);
        $stmt->bindParam(":pass_yds", $row[5], PDO::PARAM_STR);
        $stmt->bindParam(":pass_td", $row[6], PDO::PARAM_STR);
        $stmt->bindParam(":pass_int", $row[7], PDO::PARAM_STR);
        $stmt->bindParam(":pass_sacked", $row[8], PDO::PARAM_STR);

        $stmt->bindParam(":pass_sacked_yds", $row[9], PDO::PARAM_STR);
        $stmt->bindParam(":pass_long", $row[10], PDO::PARAM_STR);
        $stmt->bindParam(":pass_rating", $row[11], PDO::PARAM_STR);
        $stmt->bindParam(":rush_att", $row[12], PDO::PARAM_STR);
        $stmt->bindParam(":rush_yds", $row[13], PDO::PARAM_STR);
        $stmt->bindParam(":rush_td", $row[14], PDO::PARAM_STR);
        $stmt->bindParam(":rush_long", $row[15], PDO::PARAM_STR);
        $stmt->bindParam(":targets", $row[16], PDO::PARAM_STR);

        $stmt->bindParam(":rec", $row[17], PDO::PARAM_STR);
        $stmt->bindParam(":rec_yds", $row[18], PDO::PARAM_STR);
        $stmt->bindParam(":rec_td", $row[19], PDO::PARAM_STR);
        $stmt->bindParam(":rec_long", $row[20], PDO::PARAM_STR);
        $stmt->bindParam(":fumbles_lost", $row[21], PDO::PARAM_STR);
        $stmt->bindParam(":rush_scrambles", $row[22], PDO::PARAM_STR);
        $stmt->bindParam(":designed_rush_att", $row[23], PDO::PARAM_STR);
        $stmt->bindParam(":comb_pass_rush_play", $row[24], PDO::PARAM_STR);

        $stmt->bindParam(":comb_pass_play", $row[25], PDO::PARAM_STR);
        $stmt->bindParam(":comb_rush_play", $row[26], PDO::PARAM_STR);
        $stmt->bindParam(":two_point_conv", $row[27], PDO::PARAM_STR);
        $stmt->bindParam(":total_ret_td", $row[28], PDO::PARAM_STR);
        $stmt->bindParam(":offensive_fumble_recovery_td", $row[29], PDO::PARAM_STR);
        $stmt->bindParam(":pass_yds_bonus", $row[30], PDO::PARAM_STR);

        $stmt->bindParam(":rush_yds_bonus", $row[31], PDO::PARAM_STR);
        $stmt->bindParam(":rec_yds_bonus", $row[32], PDO::PARAM_STR);
        $stmt->bindParam(":pass_target_yds", $row[33], PDO::PARAM_STR);
        $stmt->bindParam(":pass_poor_throws", $row[34], PDO::PARAM_STR);
        $stmt->bindParam(":pass_blitzed", $row[35], PDO::PARAM_STR);
        $stmt->bindParam(":pass_hurried", $row[36], PDO::PARAM_STR);

        $stmt->bindParam(":rush_yds_before_contact", $row[37], PDO::PARAM_STR);
        $stmt->bindParam(":rush_yac", $row[38], PDO::PARAM_STR);
        $stmt->bindParam(":rush_broken_tackles", $row[39], PDO::PARAM_STR);
        $stmt->bindParam(":rec_air_yds", $row[40], PDO::PARAM_STR);
        $stmt->bindParam(":rec_yac", $row[41], PDO::PARAM_STR);
        $stmt->bindParam(":rec_drops", $row[42], PDO::PARAM_STR);
        $stmt->bindParam(":offense", $row[43], PDO::PARAM_STR);

        $stmt->bindParam(":off_pct", $row[44], PDO::PARAM_STR);
        $stmt->bindParam(":yds_per_rec", $row[45], PDO::PARAM_STR);
        $stmt->bindParam(":yds_per_rush", $row[46], PDO::PARAM_STR);
        $stmt->bindParam(":yds_per_target", $row[47], PDO::PARAM_STR);

        $stmt->execute();
    }

    //insert into player_stats // file_2
    // while (($row = fgetcsv($file_2)) !== FALSE) {
    //     $stmt = $connection->prepare($query_str_pStats);

    //     $stmt->bindParam(":game_date", $row[0], PDO::PARAM_STR);
    //     $stmt->bindParam(":game_id", $row[1], PDO::PARAM_STR);
    //     $stmt->bindParam(":player_id", $row[2], PDO::PARAM_STR);
    //     $stmt->bindParam(":player", $row[3], PDO::PARAM_STR);
    //     $stmt->bindParam(":pos", $row[4], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_comp", $row[5], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_att", $row[6], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_yds", $row[7], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_td", $row[8], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_int", $row[9], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_sacked", $row[10], PDO::PARAM_STR);

    //     $stmt->bindParam(":pass_sacked_yds", $row[11], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_long", $row[12], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_rating", $row[13], PDO::PARAM_STR);
    //     $stmt->bindParam(":rush_att", $row[14], PDO::PARAM_STR);
    //     $stmt->bindParam(":rush_yds", $row[15], PDO::PARAM_STR);
    //     $stmt->bindParam(":rush_td", $row[16], PDO::PARAM_STR);
    //     $stmt->bindParam(":rush_long", $row[17], PDO::PARAM_STR);
    //     $stmt->bindParam(":targets", $row[18], PDO::PARAM_STR);

    //     $stmt->bindParam(":rec", $row[19], PDO::PARAM_STR);
    //     $stmt->bindParam(":rec_yds", $row[20], PDO::PARAM_STR);
    //     $stmt->bindParam(":rec_td", $row[21], PDO::PARAM_STR);
    //     $stmt->bindParam(":rec_long", $row[22], PDO::PARAM_STR);
    //     $stmt->bindParam(":fumbles_lost", $row[23], PDO::PARAM_STR);
    //     $stmt->bindParam(":rush_scrambles", $row[24], PDO::PARAM_STR);
    //     $stmt->bindParam(":designed_rush_att", $row[25], PDO::PARAM_STR);
    //     $stmt->bindParam(":comb_pass_rush_play", $row[26], PDO::PARAM_STR);

    //     $stmt->bindParam(":comb_pass_play", $row[27], PDO::PARAM_STR);
    //     $stmt->bindParam(":comb_rush_play", $row[28], PDO::PARAM_STR);
    //     $stmt->bindParam(":two_point_conv", $row[29], PDO::PARAM_STR);
    //     $stmt->bindParam(":total_ret_td", $row[30], PDO::PARAM_STR);
    //     $stmt->bindParam(":offensive_fumble_recovery_td", $row[31], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_yds_bonus", $row[32], PDO::PARAM_STR);

    //     $stmt->bindParam(":rush_yds_bonus", $row[33], PDO::PARAM_STR);
    //     $stmt->bindParam(":rec_yds_bonus", $row[34], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_target_yds", $row[35], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_poor_throws", $row[36], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_blitzed", $row[37], PDO::PARAM_STR);
    //     $stmt->bindParam(":pass_hurried", $row[38], PDO::PARAM_STR);

    //     $stmt->bindParam(":rush_yds_before_contact", $row[39], PDO::PARAM_STR);
    //     $stmt->bindParam(":rush_yac", $row[40], PDO::PARAM_STR);
    //     $stmt->bindParam(":rush_broken_tackles", $row[41], PDO::PARAM_STR);
    //     $stmt->bindParam(":rec_air_yds", $row[42], PDO::PARAM_STR);
    //     $stmt->bindParam(":rec_yac", $row[43], PDO::PARAM_STR);
    //     $stmt->bindParam(":rec_drops", $row[44], PDO::PARAM_STR);
    //     $stmt->bindParam(":offense", $row[45], PDO::PARAM_STR);

    //     $stmt->bindParam(":off_pct", $row[46], PDO::PARAM_STR);
    //     $stmt->bindParam(":yds_per_rec", $row[47], PDO::PARAM_STR);
    //     $stmt->bindParam(":yds_per_rush", $row[48], PDO::PARAM_STR);
    //     $stmt->bindParam(":yds_per_target", $row[49], PDO::PARAM_STR);

    //     $stmt->execute();
    // }

} catch(PDOexecption $error){
    echo "Database connection error: " . $error->getmessage() . "<BR>";
    die;
}
?>
Data inserted successfully.
</pre>