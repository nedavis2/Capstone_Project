<!DOCTYPE html>

<!-- Tab name and css link-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <title>Silicon Stadium</title>
    <link rel="icon" type="image/x-icon" href="../src/picSource/favicon.ico">
</head>

<body id="homePage">

    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="../src/index.php">
                <img src="../src/picSource/favicon.ico" alt="Bootstrap" width="30" height="24">
                Silicon Stadium</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../src/fantasy.php">Fantasy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../src/support.php">Support</a>
                    </li>
                    <li class="nav-item nav-justify-content-end">
                        <a class="nav-link" href="../src/logout.php">
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
            <li class="nav-item" style="color:aliceblue">
                <?php
                $_SESSION["TEST"] = True;
                require_once 'config.php';
                require 'php/DBconnect.php';
                error_reporting(E_ALL);
                ini_set('display_errors', True);
                $connection = connect();
                if (isset($_SESSION['userid'])) {
                    $user_id = $_SESSION['userid'];
                    if (isset($_SESSION['email'])) {
                        $user_email = $_SESSION['email'];
                        echo $user_email;
                    } else {
                        echo "guest";
                    }
                } else {
                    $user_name = 'guest';
                }
                //echo $user_email;
                ?>
            </li>
        </div>
    </nav>

    <div id="homePageData" style="color: white; font-family: 'Bangers', cursive; font-size: xx-large; font-weight: 500; text-shadow: -2px 2px 0px black;">

        <form method="post" action="player.php">
            <div id="playerSearchBar">
                <select id="playerSelect" name="playerSelect">

                    <?php
                    $stmt = $connection->prepare("SELECT DISTINCT player_id, pName, pos 
                    FROM player ORDER BY pName ASC;");
                    $stmt->execute();
                    $results = $stmt->fetchAll();
                    for ($idx = 0; $idx < count($results); $idx++) {
                        $p = $results[$idx];
                        print("<option value=\"" . $p['player_id'] . "," . $p['pName'] . "," . $p['pos'] . "\">"
                            . $p['pName'] . "</option>");
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
                    $stmt = $connection->prepare("SELECT DISTINCT team FROM game_stats_team ORDER BY team ASC;");
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


</body>

</html>