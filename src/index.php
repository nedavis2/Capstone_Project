<?php
/*session_start();
if (isset($_SESSION['email'])) {
    $user_id = $_SESSION['email'];
    // user is logged in, do something

} else {
    // user is not logged in, redirect to login page
    header("Location: ../button.html");
    exit();
}*/ ?>

<!DOCTYPE html>

<!-- Tab name and css link-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
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
            </div>
        </div>
    </nav>

    <?php
    $_SESSION["TEST"] = True;
    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', True);
    echo session_save_path();
    

   


    if (isset($_SESSION['userid'])) {
        echo "user is loggen in " . $_SESSION['name'] . "!";
        if (isset($_SESSION['email'])) {
            echo " Your email is " . $_SESSION['email'];
        }
    }

    require 'php/DBconnect.php';
    $connection = connect();
    ?>

    <div id="homePageData">


        <?php
        $stmt = $connection->prepare("SELECT DISTINCT player_id, player, pos 
    FROM nfl_pass_rush_receive_raw_data ORDER BY player ASC;");
        $stmt->execute();
        $results = $stmt->fetchAll();
        //$final = array_column($results, 'player', 'player_id');


        ?>

    
        </head>

        <body>

            <div class="ui-widget">
                <label for="tags">Tags: </label>
                <input id="tags">
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
    <script>
        const triggerTabList = document.querySelectorAll('#myTab button')
        triggerTabList.forEach(triggerEl => {
            const tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', event => {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    </script>

    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Passer</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Rushing</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Receiving</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>Disabled</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            This is where the Passer chart will be</div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            This is where the rusher chart will be</div>
        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            This is where the receiving chart goes</div>
        <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">
            ...</div>
    </div>


</body>

</html>