<pre>
<?php

require_once("DBconnect.php");

try{

    $player_desc_file = "..\\Data\\player_data.csv";
    $player_stats_file = "..\\Data\\player_stats.csv";
    

    $file = fopen($file_name_plr, "r");

} catch(Exception $e){
    echo "File Exception: " . $e->getMessage();
}

try{
    $connection = connect();
    
    // remove entries before inserting
    $connection->query("DELETE FROM injury");
    $connection->query("DELETE FROM game_stats_player");
    $connection->query("DELETE FROM game_stats_team");
    $connection->query("DELETE FROM user");
    $connection->query("DELETE FROM weather");
    $connection->query("DELETE FROM game");
    $connection->query("DELETE FROM player");

    $query_str_plr = "INSERT INTO player
                    VALUES (:game_id, :player_id, :pName, :POS, :team)";
    $query_str_game = 
    $query_str_plr = 
    $query_str_plr = 
    $query_str_plr = 
    $query_str_plr = 
    $query_str_plr = 


    while (($row = fgetcsv($file)) !== FALSE) {
        $stmt = $connection->prepare($query_str);

        $stmt->bindParam(":game_id", $row[0], PDO::PARAM_STR);
        $stmt->bindParam(":player_id", $row[1], PDO::PARAM_STR);
        $stmt->bindParam(":pName", $row[2], PDO::PARAM_STR);
        $stmt->bindParam(":POS", $row[3], PDO::PARAM_STR);
        $stmt->bindParam(":team", $row[4], PDO::PARAM_STR);

        $stmt->execute();
    }

    // foreach $row = fgetcsv($file){

    // }
        // $stmt = $connection->prepare("INSERT INTO player (game_id, player_id, pName, POS, team) VALUES (?, ?, ?, ?, ?)");
        // $stmt->bind_param("sssss", $row[1], $row[2], $row[3], $row[4], $row[5]);
        // $stmt->execute();
//    }
} catch(PDOexecption $error){
    echo "Database connection error: " . $error->getmessage() . "<BR>";
    die;
}
?>
Data inserted successfully.
</pre>