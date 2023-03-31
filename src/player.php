<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Capstone_project/dist/css/style.min.css">

    <title>Silicon Stadium</title>
    <link rel="icon" type="image/x-icon" href="../src/picSource/favicon.ico">
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


                $result = exec('python ../src/test.py ' . escapeshellarg($selectedPlayer));
                $finalResult = explode(",", $result);



                $player = explode(",", $selectedPlayer);
                $player_input = $player[0] . "," . $player[2];


                if ($player[2] == 'QB') {

                    $result_set = exec('python ../src/player_data_chart.py ' . escapeshellarg($player_input));
                    $final_result_sets = explode("#", $result_set);

                    $pass_att_weekly = $final_result_sets[0];
                    $pass_cmp_weekly = $final_result_sets[1];
                    $pass_yds_weekly = $final_result_sets[2];
                    $pass_td_weekly = $final_result_sets[3];
                    $pass_att_monthly = $final_result_sets[4];
                    $pass_cmp_monthly = $final_result_sets[5];
                    $pass_yds_monthly = $final_result_sets[6];
                    $pass_td_monthly = $final_result_sets[7];
                    $pass_att_total = $final_result_sets[8];
                    $pass_cmp_total = $final_result_sets[9];
                    $pass_yds_total = $final_result_sets[10];
                    $pass_td_total = $final_result_sets[11];
                    $targets_weekly = $final_result_sets[12];
                    $rec_weekly = $final_result_sets[13];
                    $rec_td_weekly = $final_result_sets[14];
                    $rec_yds_weekly = $final_result_sets[15];
                    $targets_monthly = $final_result_sets[16];
                    $rec_monthly = $final_result_sets[17];
                    $rec_td_monthly = $final_result_sets[18];
                    $rec_yds_monthly = $final_result_sets[19];
                    $targets_total = $final_result_sets[20];
                    $player_wide_receiver_rec_total = $final_result_sets[21];
                    $player_wide_receiver_rec_td_total = $final_result_sets[22];
                    $player_wide_receiver_rec_yds_total = $final_result_sets[23];
                    $rush_td_weekly = $final_result_sets[24];
                    $rush_att_weekly = $final_result_sets[25];
                    $rush_yds_weekly = $final_result_sets[26];
                    $rush_td_monthly = $final_result_sets[27];
                    $rush_att_monthly = $final_result_sets[28];
                    $rush_yds_monthly = $final_result_sets[29];
                    $rush_td_total = $final_result_sets[30];
                    $rush_att_total = $final_result_sets[31];
                    $rush_yds_total = $final_result_sets[32];

                } elseif ($player[2] == "RB") {

                    $result_set = exec('python ../src/player_data_chart.py ' . escapeshellarg($player_input));
                    $final_result_sets = explode("#", $result_set);

                    $targets_weekly;
                    $rec_weekly;
                    $rec_td_weekly;
                    $rec_yds_weekly;
                    $targets_monthly;
                    $rec_monthly;
                    $rec_td_monthly;
                    $rec_yds_monthly;
                    $targets_total;
                    $player_wide_receiver_rec_total;
                    $player_wide_receiver_rec_td_total;
                    $player_wide_receiver_rec_yds_total;
                    $rush_td_weekly;
                    $rush_att_weekly;
                    $rush_yds_weekly;
                    $rush_td_monthly;
                    $rush_att_monthly;
                    $rush_yds_monthly;
                    $rush_td_total;
                    $rush_att_total;
                    $rush_yds_total;

                } else {

                    $result_set = exec('python ../src/player_data_chart.py ' . escapeshellarg($player_input));
                    $final_result_sets = explode("#", $result_set);

                    $targets_weekly;
                    $rec_weekly;
                    $rec_td_weekly;
                    $rec_yds_weekly;
                    $targets_monthly;
                    $rec_monthly;
                    $rec_td_monthly;
                    $rec_yds_monthly;
                    $targets_total;
                    $player_wide_receiver_rec_total;
                    $player_wide_receiver_rec_td_total;
                    $player_wide_receiver_rec_yds_total;

                }
            }
            ?>

            <p id="demo"></p>


            <script>
                var data1 = <?php echo json_encode($result_set); ?>;

                
                let text = data1.toString();
                document.getElementById("demo").innerHTML = text;
                
            </script>

        </div>



    </div>

    <div id="playerResultSet">
        <div id="pResultName"><?php echo "Player name: " . $finalResult[0]; ?></div>
        <div id="pResultTeam"><?php echo "Player team: " . $finalResult[1]; ?></div>
        <div id="pResultStat1"><?php echo "Total reception yds since 2019: " . $finalResult[2]; ?></div>
        <div id="pResultStat2"><?php echo "Total passes complete since 2019: " . $finalResult[3]; ?></div>
        <div id="pResultStat3"><?php echo "Total passes attempted since 2019: " . $finalResult[4]; ?></div>
    </div>

</body>

</html>