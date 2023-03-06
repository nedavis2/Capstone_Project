<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Capstone_project/dist/css/style.min.css">

    <title>Silicon Stadium</title>
</head>

<body id="playerPage">

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', True);

    require 'php/DBconnect.php';
    $connection = connect();
    ?>


    <div id="playerPageData">
        
        <div class="all">
            <button class="navLink" onclick="location.href='../src/index.php'">Home</button>
            <button class="navLink" onclick="location.href='../src/fantasy.php'">Fantasy</button>
            <button class="navLink" onclick="location.href='../src/support.php'">Support</button>
        </div>

        <div id="PlayerRep">
            <div id="playerIntro">
                <p>Player data</p>
            </div>
        </div>

        <div id="playerPageData">
            <?php
            $selectedPlayer = $_POST['playerSelect'];
            if (empty($selectedPlayer)) {
                echo ('no player found');
            } else {

                $stmt = $connection->prepare("SELECT DISTINCT 
                player, 
                team,  
                SUM(rec_yds) AS sumRecYDS, 
                SUM(pass_cmp) AS sumPassCmp, 
                SUM(pass_att) AS sumPassAtt, 
                SUM(pass_yds) AS sumPassYds, 
                SUM(pass_td) AS sumPassTd, 
                SUM(pass_int) AS sumPassInt, 
                SUM(pass_sacked) AS sumPassSacked, 
                SUM(pass_sacked_yds) AS sumPassSackedYds, 
                MAX(pass_long) AS maxPassLong, 
                MAX(pass_rating) AS maxPassRating, 
                SUM(rush_att) AS sumRushAtt, 
                MAX(rush_att) AS maxRushAtt, 
                SUM(rush_yds) AS sumRushYds, 
                MAX(rush_yds) AS maxRushYds,
                SUM(rush_td) AS sumRushTd, 
                MAX(rush_long) AS maxRushLong, 
                MAX(rec_yds) AS maxRecYds, 
                SUM(rec_td) AS sumRecTd, 
                MAX(rec_long) AS maxRecLong, 
                SUM(fumbles_lost) AS sumFumblesLost, 
                SUM(rush_scrambles) AS sumRushScrambles,
                SUM(comb_pass_rush_play) AS sumCombPassRushPlay, 
                MAX(comb_pass_rush_play) AS maxCombPassRushPlay, 
                SUM(comb_pass_play) AS sumCombPassPlay, 
                MAX(comb_pass_play) AS maxCombPassPlay, 
                SUM(comb_rush_play) AS sumCombRushPlay, 
                MAX(comb_rush_play) AS maxCombRushPlay, 
                SUM(two_point_conv) AS sumTwoPointConv, 
                SUM(total_ret_td) AS sumTotalRetTd, 
                SUM(pass_target_yds) AS sumPassTargetYds, 
                SUM(pass_poor_throws) AS sumPassPoorThrows, 
                SUM(pass_blitzed) AS sumPassBlitzed, 
                SUM(pass_hurried) AS sumPassHurried, 
                SUM(rush_yds_before_contact) AS sumRushYdsBeforeContact, 
                SUM(rush_yac) AS sumRushYac, 
                SUM(rush_broken_tackles) AS sumRushBrokenTackles, 
                SUM(rec_air_yds) AS sumRecAirYds, 
                SUM(rec_yac) AS sumRecYac, 
                SUM(rec_drops) AS sumRecDrops 
                FROM nfl_pass_rush_receive_raw_data
                    WHERE player = '$selectedPlayer';");
                $stmt->execute();
                $results = $stmt->fetchAll();
                $p = $results[0];
                /*print("<option value=\"" . $p['player'] . "\">" . $p['player'] . ", " . $p['team'] . ", " .
                    $p['sumRecYDS'] . "</option>");*/
            }
            ?>


        </div>



    </div>

    <div id="playerResultSet">
        <div class="playerResult"><?php echo "Player name: " . $p[0]; ?></div>
        <div class="playerResult"><?php echo "Player team: " . $p[1]; ?></div>
        <div class="playerResult"><?php echo "Total reception yds since 2019: " . $p[2]; ?></div>
        <div class="playerResult"><?php echo "Total passes complete since 2019: " . $p[3]; ?></div>
        <div class="playerResult"><?php echo "Total passes attempted since 2019: " . $p[4]; ?></div>
    </div>
    
        <p>test1</p>
    
    
        <p>test2</p>
    


    <!--<div class="page" id="banner">
        <p>N<br>F<br>L<br><br>L<br>o<br>g<br>o
    </div>-->
</body>

</html>