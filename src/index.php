<html>

<!-- Tab name and css link-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Capstone_project/dist/css/style.min.css">
    <script src="js/main.js" type="module"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="js/jQFuncs.js"></script>

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
        <h1>Home</h1>

        <a href="/Capstone_project/src/index.php" target="_self">Home</a>
        <a href="/Capstone_project/src/fantasy.php" targer="_self">Fantasy</a>
        <a href="/Capstone_project/src/support.php" target="_self">Support</a>

        <form method="post" class="searchBar" action="player.php" >
            <div id="playerSearchBar">
                <select name="playerSelect">

                    <?php
                    $stmt = $connection->prepare("SELECT DISTINCT player_id, player 
                    FROM nfl_pass_rush_receive_raw_data ORDER BY player ASC;");
                    $stmt->execute(); //execute the statement with no arguments (prepare statement has no ? attributes)
                    $results = $stmt->fetchAll();
                    for ($idx = 0; $idx < count($results); $idx++) {
                        $p = $results[$idx];
                        print("<option value=\"" . $p['player'] . "\">" . $p['player'] . "</option>");
                    }
                    ?>

                </select>
                <button onclick="location.href='/Capstone_project/src/player'">Search</button>
            </div>
        </form>

        <form  method="post" class="searchBar" action="team.php">
            <div id="teamSearchBar">
                <select name="teamSelect">

                    <?php
                    $stmt = $connection->prepare("SELECT DISTINCT team FROM nfl_pass_rush_receive_raw_data;");
                    $stmt->execute(); //execute the statement with no arguments (prepare statement has no ? attributes)
                    $results = $stmt->fetchAll();
                    for ($idx = 0; $idx < count($results); $idx++) {
                        $p = $results[$idx];
                        print("<option value=\"" . $p['team'] . "\">" . $p['team'] . "</option>");
                    }
                    $connection=null;
                    ?>

                </select>
                <button onclick="location.href='/Capstone_project/src/team.php'">Search</button>
            </div>
        </form>


        <div class="page" id="banner">
            <p>N<br>F<br>L<br><br>L<br>o<br>g<br>o
        </div>


</body>

</html>