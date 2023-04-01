<?php
session_start();
if (isset($_SESSION['user'])) {
    // user is logged in, do something



<!DOCTYPE html>

<!-- Tab name and css link-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <script src="js/main.js" type="module"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="js/jQFuncs.js"></script>

    <title>Silicon Stadium</title>
    <link rel="icon" type="image/x-icon" href="../src/picSource/favicon.ico">
</head>

<body id="homePage">


    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', True);

    require 'php/DBconnect.php';
    $connection = connect();
    ?>

    <div id="homePageData">
        <div class="all">
            <button class="navLink" onclick="location.href='../src/index.php'">Home</button>
            <button class="navLink" onclick="location.href='../src/fantasy.php'">Fantasy</button>
            <button class="navLink" onclick="location.href='../src/support.php'">Support</button>
        </div>

        <div class="homeSearchBar">
            <form method="post" action="player.php">
                <div id="playerSearchBar">
                    <select id="playerSelect" name="playerSelect">

                        <?php
                        $stmt = $connection->prepare("SELECT DISTINCT player_id, player, pos 
                    FROM nfl_pass_rush_receive_raw_data ORDER BY player ASC;");
                        $stmt->execute();
                        $results = $stmt->fetchAll();
                        for ($idx = 0; $idx < count($results); $idx++) {
                            $p = $results[$idx];
                            print("<option value=\"" . $p['player_id'] . "," . $p['player'] . "," . $p['pos'] . "\">" 
                            . $p['player'] . "</option>");
                        }
                        ?>

                    </select>
                    <button onclick="location.href='../src/player'" id="playerButton">Search</button>
                </div>
            </form>

            <form method="post" class="searchBar" action="team.php">
                <div id="teamSearchBar">
                    <select id="teamSelect" name="teamSelect">

                        <?php
                        $stmt = $connection->prepare("SELECT DISTINCT team FROM nfl_pass_rush_receive_raw_data;");
                        $stmt->execute();
                        $results = $stmt->fetchAll();
                        for ($idx = 0; $idx < count($results); $idx++) {
                            $p = $results[$idx];
                            print("<option value=\"" . $p['team'] . "\">" . $p['team'] . "</option>");
                        }
                        $connection = null;
                        ?>

                    </select>
                    <button onclick="location.href='../src/team.php'" id="teamButton">Search</button>
                </div>
            </form>
        </div>

    </div>


</body>

</html>

} else {
    // user is not logged in, redirect to login page
    header("Location: ./button.html");
    exit();
} ?>