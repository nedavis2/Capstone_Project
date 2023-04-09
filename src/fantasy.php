<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <title>Silicon Stadium</title>
    <link rel="icon" type="image/x-icon" href="../src/picSource/favicon.ico">
</head>

<body id="fantasyPage">

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
    require 'php/DBconnect.php';
    $user_email = 'lww1117';

    $connection = connect();
    $stmt = $connection->prepare("SELECT * FROM user WHERE user_email=?");
    $stmt->execute([$user_email]);
    $result = $stmt->fetch();
    ?>


    <div>
        test
    </div>
    <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="saved-tab" data-bs-toggle="tab" data-bs-target="#saved-tab-pane" type="button" role="tab" aria-controls="saved-tab-pane" aria-selected="true">Saved Players</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="change-tab" data-bs-toggle="tab" data-bs-target="#change-tab-pane" type="button" role="tab" aria-controls="change-tab-pane" aria-selected="false">Change payers</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="saved-tab-pane" role="tabpanel" aria-labelledby="saved-tab" tabindex="0">


            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="qb-tab" data-bs-toggle="tab" data-bs-target="#qb-tab-pane" type="button" role="tab" aria-controls="qb-tab-pane" aria-selected="true">
                        Passing data
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rb-tab" data-bs-toggle="tab" data-bs-target="#rb-tab-pane" type="button" role="tab" aria-controls="rb-tab-pane" aria-selected="false">
                        Rushing data
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="rec-tab" data-bs-toggle="tab" data-bs-target="#rec-tab-pane" type="button" role="tab" aria-controls="rec-tab-pane" aria-selected="false">
                        Receiving data
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="flx-tab" data-bs-toggle="tab" data-bs-target="#flx-tab-pane" type="button" role="tab" aria-controls="flx-tab-pane" aria-selected="false">
                        flex data
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="f-team-tab" data-bs-toggle="tab" data-bs-target="#f-team-tab-pane" type="button" role="tab" aria-controls="f-team-tab-pane" aria-selected="false">
                        team data
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="qb-tab-pane" role="tabpanel" aria-labelledby="qb-tab" tabindex="0">
                    test qb
                </div>
                <div class="tab-pane fade" id="rb-tab-pane" role="tabpanel" aria-labelledby="rb-tab" tabindex="0">
                    test rb
                </div>
                <div class="tab-pane fade" id="rec-tab-pane" role="tabpanel" aria-labelledby="rec-tab" tabindex="0">
                    test wr
                </div>
                <div class="tab-pane fade" id="flx-tab-pane" role="tabpanel" aria-labelledby="flx-tab" tabindex="0">
                    test flex
                </div>
                <div class="tab-pane fade" id="f-team-tab-pane" role="tabpanel" aria-labelledby="f-team-tab" tabindex="0">
                    test team
                </div>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="change-tab-pane" role="tabpanel" aria-labelledby="change-tab" tabindex="0">
                <div>

                    <div>
                        qb
                        <form method="post" class="searchBar" action="fantasy.php">
                            <div id="qb-button">
                                <select id="qb-button" name="qb-button">

                                    <?php

                                    $stmt = $connection->prepare("SELECT DISTINCT player_id, player FROM nfl_pass_rush_receive_raw_data 
                        WHERE pos = 'QB' ORDER BY player ASC;");
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();
                                    for ($idx = 0; $idx < count($results); $idx++) {
                                        $p = $results[$idx];
                                        print("<option value=\"" . $p['player_id'] . "\">" . $p['player'] . "</option>");
                                    }
                                    ?>

                                </select>
                                <button onclick="location.href='../src/fantasy.php'" id="qb-button">Search</button>

                            </div>
                        </form>
                    </div>
                    <div>
                        rb1
                        <form method="post" class="searchBar" action="fantasy.php">
                            <div id="rb1-button">
                                <select id="rb1-button" name="rb1-button">

                                    <?php

                                    $stmt = $connection->prepare("SELECT DISTINCT player_id, player FROM nfl_pass_rush_receive_raw_data 
                        WHERE pos = 'RB' ORDER BY player ASC;");
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();
                                    for ($idx = 0; $idx < count($results); $idx++) {
                                        $p = $results[$idx];
                                        print("<option value=\"" . $p['player_id'] . "\">" . $p['player'] . "</option>");
                                    }
                                    ?>

                                </select>
                                <button onclick="location.href='../src/fantasy.php'" id="rb1-button">Search</button>

                            </div>
                        </form>
                    </div>
                    <div>
                        rb2
                        <form method="post" class="searchBar" action="fantasy.php">
                            <div id="rb2-button">
                                <select id="rb2-button" name="rb2-button">

                                    <?php

                                    $stmt = $connection->prepare("SELECT DISTINCT player_id, player FROM nfl_pass_rush_receive_raw_data 
                        WHERE pos = 'RB' ORDER BY player ASC;");
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();
                                    for ($idx = 0; $idx < count($results); $idx++) {
                                        $p = $results[$idx];
                                        print("<option value=\"" . $p['player_id'] . "\">" . $p['player'] . "</option>");
                                    }
                                    ?>

                                </select>
                                <button onclick="location.href='../src/fantasy.php'" id="rb2-button">Search</button>

                            </div>
                        </form>
                    </div>
                    <div>
                        wr1
                        <form method="post" class="searchBar" action="fantasy.php">
                            <div id="wr1-button">
                                <select id="wr1-button" name="wr1-button">

                                    <?php

                                    $stmt = $connection->prepare("SELECT DISTINCT player_id, player FROM nfl_pass_rush_receive_raw_data 
                        WHERE pos = 'WR' ORDER BY player ASC;");
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();
                                    for ($idx = 0; $idx < count($results); $idx++) {
                                        $p = $results[$idx];
                                        print("<option value=\"" . $p['player_id'] . "\">" . $p['player'] . "</option>");
                                    }
                                    ?>

                                </select>
                                <button onclick="location.href='../src/fantasy.php'" id="wr1-button">Search</button>

                            </div>
                        </form>
                    </div>
                    <div>
                        wr2
                        <form method="post" class="searchBar" action="fantasy.php">
                            <div id="wr2-button">
                                <select id="wr2-button" name="wr2-button">

                                    <?php

                                    $stmt = $connection->prepare("SELECT DISTINCT player_id, player FROM nfl_pass_rush_receive_raw_data
                        WHERE pos = 'WR' ORDER BY player ASC;");
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();
                                    for ($idx = 0; $idx < count($results); $idx++) {
                                        $p = $results[$idx];
                                        print("<option value=\"" . $p['player_id'] . "\">" . $p['player'] . "</option>");
                                    }
                                    ?>

                                </select>
                                <button onclick="location.href='../src/fantasy.php'" id="wr2-button">Search</button>

                            </div>
                        </form>
                    </div>
                    <div>
                        te
                        <form method="post" class="searchBar" action="fantasy.php">
                            <div id="te-button">
                                <select id="te-button" name="te-button">

                                    <?php

                                    $stmt = $connection->prepare("SELECT DISTINCT player_id, player FROM nfl_pass_rush_receive_raw_data 
                        WHERE pos = 'TE' ORDER BY player ASC;");
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();
                                    for ($idx = 0; $idx < count($results); $idx++) {
                                        $p = $results[$idx];
                                        print("<option value=\"" . $p['player_id'] . "\">" . $p['player'] . "</option>");
                                    }
                                    ?>

                                </select>
                                <button onclick="location.href='../src/fantasy.php'" id="te-button">Search</button>

                            </div>
                        </form>
                    </div>
                    <div>
                        flex
                        <form method="post" class="searchBar" action="fantasy.php">
                            <div id="flx-button">
                                <select id="flx-button" name="flx-button">

                                    <?php

                                    $stmt = $connection->prepare("SELECT DISTINCT player_id, player FROM nfl_pass_rush_receive_raw_data 
                        WHERE pos = 'RB' OR pos = 'WR' OR pos = 'TE' ORDER BY player ASC;");
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();
                                    for ($idx = 0; $idx < count($results); $idx++) {
                                        $p = $results[$idx];
                                        print("<option value=\"" . $p['player_id'] . "\">" . $p['player'] . "</option>");
                                    }
                                    ?>

                                </select>
                                <button onclick="location.href='../src/fantasy.php'" id="flx-button">Search</button>

                            </div>
                        </form>
                    </div>
                    <div>
                        team
                        <form method="post" class="searchBar" action="fantasy.php">
                            <div id="team-button">
                                <select id="team-button" name="team-button">

                                    <?php

                                    $stmt = $connection->prepare("SELECT DISTINCT team FROM nfl_pass_rush_receive_raw_data ORDER BY team ASC;");
                                    $stmt->execute();
                                    $results = $stmt->fetchAll();
                                    for ($idx = 0; $idx < count($results); $idx++) {
                                        $p = $results[$idx];
                                        print("<option value=\"" . $p['team'] . "\">" . $p['team'] . "</option>");
                                    }
                                    ?>

                                </select>
                                <button onclick="location.href='../src/fantasy.php'" id="team-button">Search</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


</body>

</html>