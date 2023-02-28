<?php

require('DBconnect.php');

//$searchBarPlayers = array();

$connection = connect();
$stmt = $connection->prepare("SELECT DISTINCT player, team FROM nfl_pass_rush_receive_raw_data WHERE player LIKE '%".$_POST["search"]."%'");
$stmt->execute();
/*$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $result) {
    //printf("%s \n", $result['player']) ;
    $searchBarPlayers[$result['team']] = $result['player'];
    
    
}*/
$output = '';
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if($result != null){
    foreach ($result as $result) {
        $output .='
            <tr>
                <th>'.$result['player'].'</th>
                <th>'.$result['team'].'</th>
            </tr>';    }
}

$connect=null;





/*function getPlayer($player, $team) {
$connection = connect();
$player = 'TODO get player name from click';
$team = 'TODO get team abbrev from click';
$stmt = $connection->prepare('SELECT * FROM nfl_pass_rush_receive_raw_data WHERE player = :player AND team_abbrev = :team');
$stmt->bindParam('calories', $calories, PDO::PARAM_INT);
$stmt->bindParam(':player', $player, PDO::PARAM_STR);
$stmt->bindParam(':team', $team, PDO::PARAM_STR);
$stmt->execute();
}*/

echo $output;
//echo json_encode($searchBarPlayers);
