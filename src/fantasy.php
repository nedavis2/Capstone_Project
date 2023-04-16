<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
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
                    } else {
                        $user_email = 'dummyBOI@aol.com';
                    }
                } else {
                    $user_name = 'guest';
                }
                echo $user_email;
                ?>
            </li>
        </div>
    </nav>

    <?php



    $connection = connect();
    $stmt = $connection->prepare("SELECT * FROM user WHERE user_email=?");
    $stmt->execute([$user_email]);
    $result = $stmt->fetch();

    ?>
    <div id="fantasy-page-content" style="color: white; font-family: 'Bangers', cursive; font-size: xx-large; font-weight: 500; text-shadow: -2px 2px 0px black;">

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
                        <?php
                        $qb =  $result[1];
                        $stmt = $connection->prepare("SELECT pName FROM player 
                        WHERE player_id = ?;");
                        $stmt->execute([$qb]);
                        $qb_name = $stmt->fetch();
                        $player_input1 = $qb . ", 'QB'";
                        $result_set1 = exec('python ../src/player_data_chart.py ' . escapeshellarg($player_input1));
                        print_r($result_set1);
                        ?>

                        <script>
                            /*var data = <?php echo json_encode($result_set1); ?>;

                            var [pass_att_weekly_qb, pass_cmp_weekly_qb, pass_yds_weekly_qb, pass_td_weekly_qb,
                                pass_att_monthly_qb, pass_cmp_monthly_qb, pass_yds_monthly_qb, pass_td_monthly_qb,
                                pass_att_total_qb, pass_cmp_total_qb, pass_yds_total_qb, pass_td_total_qb,
                                rush_td_weekly_qb, rush_att_weekly_qb, rush_yds_weekly_qb,
                                rush_td_monthly_qb, rush_att_monthly_qb, rush_yds_monthly_qb,
                                rush_td_total_qb, rush_att_total_qb, rush_yds_total_qb, player_dates_qb, player_dates_months_qb
                            ] = data.split('#');

                            pass_att_weekly_qb = pass_att_weekly_qb.split(",").slice(-17);
                            pass_cmp_weekly_qb = pass_cmp_weekly_qb.split(",").slice(-17);
                            pass_yds_weekly_qb = pass_yds_weekly_qb.split(",").slice(-17);
                            pass_td_weekly_qb = pass_td_weekly_qb.split(",").slice(-17);
                            rush_td_weekly_qb = rush_td_weekly_qb.split(",").slice(-17);
                            rush_att_weekly_qb = rush_att_weekly_qb.split(",").slice(-17);
                            player_dates_qb = player_dates_qb.split(",").slice(0,-1).slice(-17);
                            player_dates_months_qb = player_dates_months_qb.split(",").slice(0,-1).slice(-17);*/
                        </script>

                        <div class="row">
                            <div class="col">
                                <?php
                                echo 'QB ';
                                print_r($qb_name['pName']);
                                ?>
                            </div>
                            <div class="col">
                                
                            </div>
                            <div class="col">
                            <canvas id="weeklyChart1QB" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px; margin: 1vh;"></canvas>
                            <canvas id="weeklyChart2QB" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px; margin: 1vh;"></canvas>
                            <canvas id="weeklyChart3QB" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px; margin: 1vh;"></canvas>
                            </div>
                        </div>
                    
                    <script>
                       /* new Chart("weeklyChart1QB", {
                            type: "line",
                            data: {
                                labels: player_dates_qb,
                                datasets: [{
                                    label: 'pass att',
                                    data: pass_att_weekly_qb,
                                    borderColor: "red",
                                    fill: false
                                }, {
                                    label: 'pass cmp',
                                    data: pass_cmp_weekly_qb,
                                    borderColor: "green",
                                    fill: false
                                }, {
                                    label: 'pass td',
                                    data: pass_td_weekly_qb,
                                    borderColor: "blue",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });

                        new Chart("weeklyChart2QB", {
                            type: "line",
                            data: {
                                labels: player_dates_qb,
                                datasets: [{
                                    label: 'pass yds',
                                    data: pass_yds_weekly_qb,
                                    borderColor: "purple",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });

                        new Chart("weeklyChart3QB", {
                            type: "line",
                            data: {
                                labels: player_dates_qb,
                                datasets: [{
                                    label: 'rush td',
                                    data: rush_td_weekly_qb,
                                    borderColor: "yellow",
                                    fill: false
                                }, {
                                    label: 'rush att',
                                    data: rush_att_weekly_qb,
                                    borderColor: "orange",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });*/
                    </script>
                    
                    </div>
                    <div class="tab-pane fade" id="rb-tab-pane" role="tabpanel" aria-labelledby="rb-tab" tabindex="0">
                        <?php
                        $rb1 =  $result[2];
                        $stmt = $connection->prepare("SELECT pName FROM player 
                        WHERE player_id = ?;");
                        $stmt->execute([$rb1]);
                        $rb1_name = $stmt->fetch();
                        $player_input2 = $rb1 . ", 'RB'";
                        $result_set2 = exec('python ../src/player_data_chart.py ' . escapeshellarg($player_input2));


                        $rb2 =  $result[3];
                        $stmt = $connection->prepare("SELECT pName FROM player 
                        WHERE player_id = ?;");
                        $stmt->execute([$rb2]);
                        $rb2_name = $stmt->fetch();
                        $player_input3 = $rb2 . ", 'RB'";
                        $result_set3 = exec('python ../src/player_data_chart.py ' . escapeshellarg($player_input3));

                        echo 'RB1 ';
                        print_r($rb1_name['pName']);

                        echo ', RB2 ';
                        print_r($rb2_name['pName']);
                        ?>

                        <script>
                            var data = <?php echo json_encode($result_set2); ?>;
                            var data = <?php echo json_encode($result_set3); ?>;

                            var [rush_td_weekly_rb1, rush_att_weekly_rb1, rush_yds_weekly_rb1,
                                rush_td_monthly_rb1, rush_att_monthly_rb1, rush_yds_monthly_rb1,
                                rush_td_total_rb1, rush_att_total_rb1, rush_yds_total_rb1,
                                targets_weekly_rb1, rec_weekly_rb1, rec_td_weekly_rb1, rec_yds_weekly_rb1,
                                targets_monthly_rb1, rec_monthly_rb1, rec_td_monthly_rb1, rec_yds_monthly_rb1,
                                targets_total_rb1, rec_total_rb1, rec_td_total_rb1, rec_yds_total_rb1,
                                player_dates_rb1, player_dates_months_rb1
                            ] = data.split('#');

                            var [rush_td_weekly_rb2, rush_att_weekly_rb2, rush_yds_weekly_rb2,
                                rush_td_monthly_rb2, rush_att_monthly_rb2, rush_yds_monthly_rb2,
                                rush_td_total_rb2, rush_att_total_rb2, rush_yds_total_rb2,
                                targets_weekly_rb2, rec_weekly_rb2, rec_td_weekly_rb2, rec_yds_weekly_rb2,
                                targets_monthly_rb2, rec_monthly_rb2, rec_td_monthly_rb2, rec_yds_monthly_rb2,
                                targets_total_rb2, rec_total_rb2, rec_td_total_rb2, rec_yds_total_rb2,
                                player_dates_rb2, player_dates_months_rb2
                            ] = data.split('#');
                        </script>
                    </div>
                    <div class="tab-pane fade" id="rec-tab-pane" role="tabpanel" aria-labelledby="rec-tab" tabindex="0">
                        <?php
                        $wr1 =  $result[4];
                        $stmt = $connection->prepare("SELECT pName FROM player 
                        WHERE player_id = ?;");
                        $stmt->execute([$wr1]);
                        $wr1_name = $stmt->fetch();
                        $player_input4 = $wr1 . ", WR";
                        $result_set4 = exec('python ../src/player_data_chart.py ' . escapeshellarg($player_input4));

                        $wr2 =  $result[5];
                        $stmt = $connection->prepare("SELECT pName FROM player 
                        WHERE player_id = ?;");
                        $stmt->execute([$wr2]);
                        $wr2_name = $stmt->fetch();
                        $player_input5 = $wr2 . ", WR";
                        $result_set5 = exec('python ../src/player_data_chart.py ' . escapeshellarg($player_input5));

                        $te =  $result[6];
                        $stmt = $connection->prepare("SELECT pName FROM player 
                        WHERE player_id = ?;");
                        $stmt->execute([$te]);
                        $te_name = $stmt->fetch();
                        $player_input6 = $te . ", TE";
                        $result_set6 = exec('python ../src/player_data_chart.py ' . escapeshellarg($player_input6));


                        echo 'WR1 ';
                        print_r($wr1_name['pName']);

                        echo ', WR2 ';
                        print_r($wr2_name['pName']);

                        echo ', TE ';
                        print_r($te_name['pName']);
                        ?>

                        <script>
                            var data = <?php echo json_encode($result_set4); ?>;
                            var data = <?php echo json_encode($result_set5); ?>;
                            var data = <?php echo json_encode($result_set6); ?>;

                            var [targets_weekly_wr1, rec_weekly_wr1, rec_td_weekly_wr1, rec_yds_weekly_wr1,
                                targets_monthly_wr1, rec_monthly_wr1, rec_td_monthly_wr1, rec_yds_monthly_wr1,
                                targets_total_wr1, rec_total_wr1, rec_td_total_wr1, rec_yds_total_wr1,
                                player_dates_wr1, player_dates_months_wr1
                            ] = data.split('#');

                            var [targets_weekly_wr2, rec_weekly_wr2, rec_td_weekly_wr2, rec_yds_weekly_wr2,
                                targets_monthly_wr2, rec_monthly_wr2, rec_td_monthly_wr2, rec_yds_monthly_wr2,
                                targets_total_wr2, rec_total_wr2, rec_td_total_wr2, rec_yds_total_wr2,
                                player_dates_wr2, player_dates_months_wr2
                            ] = data.split('#');

                            var [targets_weekly_te, rec_weekly_te, rec_td_weekly_te, rec_yds_weekly_te,
                                targets_monthly_te, rec_monthly_te, rec_td_monthly_te, rec_yds_monthly_te,
                                targets_total_te, rec_total_te, rec_td_total_te, rec_yds_total_te,
                                player_dates_te, player_dates_months_te
                            ] = data.split('#');
                        </script>
                    </div>
                    <div class="tab-pane fade" id="flx-tab-pane" role="tabpanel" aria-labelledby="flx-tab" tabindex="0">
                        <?php
                        $flx =  $result[7];
                        $stmt = $connection->prepare("SELECT pName, pos FROM player 
                        WHERE player_id = ?;");
                        $stmt->execute([$flx]);
                        $flx_res = $stmt->fetch();
                        $flx_name = $flx_res['pName'];
                        $flx_pos = $flx_res['pos'];
                        $player_input4 = $flx . "," . $flx_pos;
                        $result_set4 = exec('python ../src/player_data_chart.py ' . escapeshellarg($player_input4));


                        echo 'Flex ';
                        print_r($flx_name);
                        ?>

                        <script>
                            var data = <?php echo json_encode($result_set4); ?>;
                            var pos = <?php echo json_encode($flx_pos); ?>;

                            if (pos == 'RB') {
                                var [rush_td_weekly_flx, rush_att_weekly_flx, rush_yds_weekly_flx,
                                    rush_td_monthly_flx, rush_att_monthly_flx, rush_yds_monthly_flx,
                                    rush_td_total_flx, rush_att_total_flx, rush_yds_total_flx,
                                    targets_weekly_flx, rec_weekly_flx, rec_td_weekly_flx, rec_yds_weekly_flx,
                                    targets_monthly_flx, rec_monthly_flx, rec_td_monthly_flx, rec_yds_monthly_flx,
                                    targets_total_flx, rec_total_flx, rec_td_total_flx, rec_yds_total_flx,
                                    player_dates_flx, player_dates_months_flx
                                ] = data.split('#');
                            } else {
                                var [targets_weekly_flx, rec_weekly_flx, rec_td_weekly_flx, rec_yds_weekly_flx,
                                    targets_monthly_flx, rec_monthly_flx, rec_td_monthly_flx, rec_yds_monthly_flx,
                                    targets_total_flx, rec_total_flx, rec_td_total_flx, rec_yds_total_flx,
                                    player_dates_flx, player_dates_months_flx
                                ] = data.split('#');
                            }
                        </script>

                    </div>
                    <div class="tab-pane fade" id="f-team-tab-pane" role="tabpanel" aria-labelledby="f-team-tab" tabindex="0">
                        <?php
                        $team =  $result[8];

                        echo 'Team ';
                        print_r($team);
                        $result_set8 = exec('python ../src/team_data_chart.py ' . escapeshellarg($team));

                        ?>
                        <script>
                            const triggerTabList = document.querySelectorAll('#myTab button')
                            triggerTabList.forEach(triggerEl => {
                                const tabTrigger = new bootstrap.Tab(triggerEl)

                                triggerEl.addEventListener('click', event => {
                                    event.preventDefault()
                                    tabTrigger.show()
                                })
                            });

                            var data = <?php echo json_encode($result_set8); ?>;

                            var [pass_att_weekly, pass_cmp_weekly, pass_td_weekly, pass_yds_weekly,
                                pass_att_monthly, pass_cmp_monthly, pass_td_monthly, pass_yds_monthly,
                                pass_att_total, pass_cmp_total, pass_td_total, pass_yds_total,
                                rush_td_weekly, rush_att_weekly, rush_yds_weekly,
                                rush_td_monthly, rush_att_monthly, rush_yds_monthly,
                                rush_td_total, rush_att_total, rush_yds_total,
                                targets_weekly, rec_weekly, rec_td_weekly, rec_yds_weekly,
                                targets_monthly, rec_monthly, rec_td_monthly, rec_yds_monthly,
                                targets_total, rec_total, rec_td_total, rec_yds_total,
                                get_dates, get_months
                            ] = data.split('#');

                            get_dates = get_dates.split(",").slice(-17);
                            get_months = get_months.split(",").slice(-17);
                        </script>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="change-tab-pane" role="tabpanel" aria-labelledby="change-tab" tabindex="0">

                    <div class="container p-3">
                        <div class="row">
                            <div class="col">
                                <div>
                                    qb
                                    <form method="post" class="searchBar" action="fantasy_update.php">
                                        <div id="qb-button">
                                            <select id="qb-button" name="qb-button">

                                                <?php

                                                $stmt = $connection->prepare("SELECT DISTINCT player_id, pName FROM player 
                        WHERE pos = 'QB' ORDER BY pName ASC;");
                                                $stmt->execute();
                                                $results = $stmt->fetchAll();
                                                for ($idx = 0; $idx < count($results); $idx++) {
                                                    $p = $results[$idx];
                                                    print("<option value=\"" . $p['player_id'] . "\">" . $p['pName'] . "</option>");
                                                }
                                                ?>

                                            </select>
                                            <button onclick="location.href='../src/fantasy.php'" id="qb-button-click">Update</button>

                                        </div>
                                    </form>
                                </div>
                                <div>
                                    rb1
                                    <form method="post" class="searchBar" action="fantasy_update.php">
                                        <div id="rb1-button">
                                            <select id="rb1-button" name="rb1-button">

                                                <?php

                                                $stmt = $connection->prepare("SELECT DISTINCT player_id, pName FROM player 
                        WHERE pos = 'RB' ORDER BY pName ASC;");
                                                $stmt->execute();
                                                $results = $stmt->fetchAll();
                                                for ($idx = 0; $idx < count($results); $idx++) {
                                                    $p = $results[$idx];
                                                    print("<option value=\"" . $p['player_id'] . "\">" . $p['pName'] . "</option>");
                                                }
                                                ?>

                                            </select>
                                            <button onclick="location.href='../src/fantasy.php'" id="rb1-button-click">Update</button>

                                        </div>
                                    </form>
                                </div>
                                <div>
                                    rb2
                                    <form method="post" class="searchBar" action="fantasy_update.php">
                                        <div id="rb2-button">
                                            <select id="rb2-button" name="rb2-button">

                                                <?php

                                                $stmt = $connection->prepare("SELECT DISTINCT player_id, pName FROM player 
                        WHERE pos = 'RB' ORDER BY pName ASC;");
                                                $stmt->execute();
                                                $results = $stmt->fetchAll();
                                                for ($idx = 0; $idx < count($results); $idx++) {
                                                    $p = $results[$idx];
                                                    print("<option value=\"" . $p['player_id'] . "\">" . $p['pName'] . "</option>");
                                                }
                                                ?>

                                            </select>
                                            <button onclick="location.href='../src/fantasy.php'" id="rb2-button-click">Update</button>

                                        </div>
                                    </form>
                                </div>
                                <div>
                                    wr1
                                    <form method="post" class="searchBar" action="fantasy_update.php">
                                        <div id="wr1-button">
                                            <select id="wr1-button" name="wr1-button">

                                                <?php

                                                $stmt = $connection->prepare("SELECT DISTINCT player_id, pName FROM player 
                        WHERE pos = 'WR' ORDER BY pName ASC;");
                                                $stmt->execute();
                                                $results = $stmt->fetchAll();
                                                for ($idx = 0; $idx < count($results); $idx++) {
                                                    $p = $results[$idx];
                                                    print("<option value=\"" . $p['player_id'] . "\">" . $p['pName'] . "</option>");
                                                }
                                                ?>

                                            </select>
                                            <button onclick="location.href='../src/fantasy.php'" id="wr1-button-click">Update</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    wr2
                                    <form method="post" class="searchBar" action="fantasy_update.php">
                                        <div id="wr2-button">
                                            <select id="wr2-button" name="wr2-button">

                                                <?php

                                                $stmt = $connection->prepare("SELECT DISTINCT player_id, pName FROM player
                        WHERE pos = 'WR' ORDER BY pName ASC;");
                                                $stmt->execute();
                                                $results = $stmt->fetchAll();
                                                for ($idx = 0; $idx < count($results); $idx++) {
                                                    $p = $results[$idx];
                                                    print("<option value=\"" . $p['player_id'] . "\">" . $p['pName'] . "</option>");
                                                }
                                                ?>

                                            </select>
                                            <button onclick="location.href='../src/fantasy.php'" id="wr2-button-click">Update</button>

                                        </div>
                                    </form>
                                </div>
                                <div>
                                    te
                                    <form method="post" class="searchBar" action="fantasy_update.php">
                                        <div id="te-button">
                                            <select id="te-button" name="te-button">

                                                <?php

                                                $stmt = $connection->prepare("SELECT DISTINCT player_id, pName FROM player 
                        WHERE pos = 'TE' ORDER BY pName ASC;");
                                                $stmt->execute();
                                                $results = $stmt->fetchAll();
                                                for ($idx = 0; $idx < count($results); $idx++) {
                                                    $p = $results[$idx];
                                                    print("<option value=\"" . $p['player_id'] . "\">" . $p['pName'] . "</option>");
                                                }
                                                ?>

                                            </select>
                                            <button onclick="location.href='../src/fantasy.php'" id="te-button-click">Update</button>

                                        </div>
                                    </form>
                                </div>
                                <div>
                                    flex
                                    <form method="post" class="searchBar" action="fantasy_update.php">
                                        <div id="flx-button">
                                            <select id="flx-button" name="flx-button">

                                                <?php

                                                $stmt = $connection->prepare("SELECT DISTINCT player_id, pName FROM player 
                        WHERE pos = 'RB' OR pos = 'WR' OR pos = 'TE' ORDER BY pName ASC;");
                                                $stmt->execute();
                                                $results = $stmt->fetchAll();
                                                for ($idx = 0; $idx < count($results); $idx++) {
                                                    $p = $results[$idx];
                                                    print("<option value=\"" . $p['player_id'] . "\">" . $p['pName'] . "</option>");
                                                }
                                                ?>

                                            </select>
                                            <button onclick="location.href='../src/fantasy.php'" id="flx-button-click">Update</button>

                                        </div>
                                    </form>
                                </div>
                                <div>
                                    team
                                    <form method="post" class="searchBar" action="fantasy_update.php">
                                        <div id="team-button">
                                            <select id="f-team-button" name="f-team-button">

                                                <?php

                                                $stmt = $connection->prepare("SELECT DISTINCT team FROM team_table ORDER BY team ASC;");
                                                $stmt->execute();
                                                $results = $stmt->fetchAll();
                                                for ($idx = 0; $idx < count($results); $idx++) {
                                                    $p = $results[$idx];
                                                    print("<option value=\"" . $p['team'] . "\">" . $p['team'] . "</option>");
                                                }
                                                ?>

                                            </select>
                                            <button onclick="location.href='../src/fantasy.php'" id="f-team-button-click">Update</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>