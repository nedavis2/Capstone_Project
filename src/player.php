<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Capstone_project/dist/css/style.min.css">

    <title>Silicon Stadium</title>
</head>

<body>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', True);

    require 'php/DBconnect.php';
    $connection = connect();
    ?>


    <div class="page" id="pageData">
        <h1>Player page</h1>

            <a href="/Capstone_project/src/index.php" target="_self" class="futureTab">Home</a>
            <a href="/Capstone_project/src/fantasy.php" targer="_self" class="futureTab">Fantasy</a>
            <a href="/Capstone_project/src/support.php" target="_self" class="futureTab">Support</a>
        </div>

        <div>
            <?php
            $selectedPlayer = $_POST['playerSelect'];
            if (empty($selectedPlayer)) {
                echo ('no player found');
            } else {

                $stmt = $connection->prepare("SELECT DISTINCT player, team, SUM(rec_yds) AS sumRecYDS FROM nfl_pass_rush_receive_raw_data
                    WHERE player = '$selectedPlayer';");
                $stmt->execute();
                $results = $stmt->fetchAll();
                $p = $results[0];
                print("<option value=\"" . $p['player'] . "\">" . $p['player'] . ", " . $p['team'] . ", " .
                    $p['sumRecYDS'] . "</option>");
            }
            ?>

        </div>

    </div>





    <div class="page" id="banner">
        <p>N<br>F<br>L<br><br>L<br>o<br>g<br>o
    </div>
</body>

</html>