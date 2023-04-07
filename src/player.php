<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="/Capstone_project/dist/css/style.min.css">-->
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!--<link rel="stylesheet" href="/resources/demos/style.css">-->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>-->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

    <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>


    <title>Silicon Stadium</title>
    <link rel="icon" type="image/x-icon" href="../src/picSource/favicon.ico">
</head>

<body id="playerPage">

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
    error_reporting(E_ALL);
    ini_set('display_errors', True);

    require 'php/DBconnect.php';
    $connection = connect();
    ?>

    <?php


    $selectedPlayer = $_POST['playerSelect'];
    if (empty($selectedPlayer)) {
        echo ('no player found');
    } else {

        $player = explode(",", $selectedPlayer);
        $pos = $player[2];
        $player_input = $player[0] . "," . $player[2];

        $result_set = exec('python ../src/player_data_chart.py ' . escapeshellarg($player_input));
    }

    ?>


    <div id="playerPageData">

        <div id="PlayerRep">
            <div id="playerIntro">
                <p>Player data</p>
            </div>
        </div>

        <div id="playerPageData">



            <p id="demo"></p>


            <script>
                const triggerTabList = document.querySelectorAll('#myTab button')
                triggerTabList.forEach(triggerEl => {
                    const tabTrigger = new bootstrap.Tab(triggerEl)

                    triggerEl.addEventListener('click', event => {
                        event.preventDefault()
                        tabTrigger.show()
                    })
                });

                var data = <?php echo json_encode($result_set); ?>;
                var pos = <?php echo json_encode($pos); ?>;

                if (pos == "QB") {

                    var [pass_att_weekly, pass_cmp_weekly, pass_yds_weekly, pass_td_weekly,
                        pass_att_monthly, pass_cmp_monthly, pass_yds_monthly, pass_td_monthly,
                        pass_att_total, pass_cmp_total, pass_yds_total, pass_td_total,
                        rush_td_weekly, rush_att_weekly, rush_yds_weekly,
                        rush_td_monthly, rush_att_monthly, rush_yds_monthly,
                        rush_td_total, rush_att_total, rush_yds_total, player_dates, player_dates_months
                    ] = data.split('#');

                } else if (pos == "RB") {

                    var [
                        rush_td_weekly, rush_att_weekly, rush_yds_weekly,
                        rush_td_monthly, rush_att_monthly, rush_yds_monthly,
                        rush_td_total, rush_att_total, rush_yds_total,
                        targets_weekly, rec_weekly, rec_td_weekly, rec_yds_weekly,
                        targets_monthly, rec_monthly, rec_td_monthly, rec_yds_monthly,
                        targets_total, rec_total, rec_td_total, rec_yds_total,
                        player_dates, player_dates_months
                    ] = data.split('#');

                } else {

                    var [targets_weekly, rec_weekly, rec_td_weekly, rec_yds_weekly,
                        targets_monthly, rec_monthly, rec_td_monthly, rec_yds_monthly,
                        targets_total, rec_total, rec_td_total, rec_yds_total,
                        player_dates, player_dates_months
                    ] = data.split('#');

                }
            </script>



        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="weekly-tab" data-bs-toggle="tab" data-bs-target="#weekly-tab-pane" type="button" role="tab" aria-controls="weekly-tab-pane" aria-selected="true">Weekly data</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly-tab-pane" type="button" role="tab" aria-controls="monthly-tab-pane" aria-selected="false">Monthly data</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="total-tab" data-bs-toggle="tab" data-bs-target="#total-tab-pane" type="button" role="tab" aria-controls="total-tab-pane" aria-selected="false">Total data</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="comparison-tab" data-bs-toggle="tab" data-bs-target="#comparison-tab-pane" type="button" role="tab" aria-controls="comparison-tab-pane" aria-selected="false">Comparison</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="weekly-tab-pane" role="tabpanel" aria-labelledby="weekly-tab" tabindex="0">


                <canvas id="weeklyChart1" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>

                <canvas id="weeklyChart2" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>

                <canvas id="weeklyChart3" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>


                <script>
                    if (pos == 'QB') {

                        pass_att_weekly = pass_att_weekly.split(",").slice(-17);
                        pass_cmp_weekly = pass_cmp_weekly.split(",").slice(-17);
                        pass_yds_weekly = pass_yds_weekly.split(",").slice(-17);
                        pass_td_weekly = pass_td_weekly.split(",").slice(-17);
                        rush_td_weekly = rush_td_weekly.split(",").slice(-17);
                        rush_att_weekly = rush_att_weekly.split(",").slice(-17);
                        rush_yds_weekly = rush_yds_weekly.split(",").slice(-17);
                        player_dates = player_dates.split(",").slice(-17);


                        new Chart("weeklyChart1", {
                            type: "line",
                            data: {
                                labels: player_dates,
                                datasets: [{
                                    label: 'pass att',
                                    data: pass_att_weekly,
                                    borderColor: "red",
                                    fill: false
                                }, {
                                    label: 'pass cmp',
                                    data: pass_cmp_weekly,
                                    borderColor: "green",
                                    fill: false
                                }, {
                                    label: 'pass td',
                                    data: pass_td_weekly,
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

                        new Chart("weeklyChart2", {
                            type: "line",
                            data: {
                                labels: player_dates,
                                datasets: [{
                                    label: 'pass yds',
                                    data: pass_yds_weekly,
                                    borderColor: "purple",
                                    fill: false
                                }, {
                                    label: 'rush yds',
                                    data: rush_yds_weekly,
                                    borderColor: "pink",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });

                        new Chart("weeklyChart3", {
                            type: "line",
                            data: {
                                labels: player_dates,
                                datasets: [{
                                    label: 'rush td',
                                    data: rush_td_weekly,
                                    borderColor: "yellow",
                                    fill: false
                                }, {
                                    label: 'rush att',
                                    data: rush_att_weekly,
                                    borderColor: "orange",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });


                    } else if (pos == 'RB') {

                        rush_td_weekly = rush_td_weekly.split(",").slice(-17);
                        rush_att_weekly = rush_att_weekly.split(",").slice(-17);
                        rush_yds_weekly = rush_yds_weekly.split(",").slice(-17);
                        targets_weekly = targets_weekly.split(",").slice(-17);
                        rec_weekly = rec_weekly.split(",").slice(-17);
                        rec_td_weekly = rec_td_weekly.split(",").slice(-17);
                        rec_yds_weekly = rec_yds_weekly.split(",").slice(-17);
                        player_dates = player_dates.split(",").slice(-17);


                        new Chart("weeklyChart1", {
                            type: "line",
                            data: {
                                labels: player_dates,
                                datasets: [{
                                    label: 'rush att',
                                    data: rush_att_weekly,
                                    borderColor: "green",
                                    fill: false
                                }, {
                                    label: 'targets',
                                    data: targets_weekly,
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

                        new Chart("weeklyChart2", {
                            type: "line",
                            data: {
                                labels: player_dates,
                                datasets: [{
                                    label: 'rush yds',
                                    data: rush_yds_weekly,
                                    borderColor: "purple",
                                    fill: false
                                }, {
                                    label: 'rec yds',
                                    data: rec_yds_weekly,
                                    borderColor: "pink",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });

                        new Chart("weeklyChart3", {
                            type: "line",
                            data: {
                                labels: player_dates,
                                datasets: [{
                                    label: 'rush td',
                                    data: rush_td_weekly,
                                    borderColor: "yellow",
                                    fill: false
                                }, {
                                    label: 'rec td',
                                    data: rec_td_weekly,
                                    borderColor: "orange",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });


                    } else {

                        targets_weekly = targets_weekly.split(",").slice(-17);
                        rec_weekly = rec_weekly.split(",").slice(-17);
                        rec_td_weekly = rec_td_weekly.split(",").slice(-17);
                        rec_yds_weekly = rec_yds_weekly.split(",").slice(-17);
                        player_dates = player_dates.split(",").slice(-17);


                        new Chart("weeklyChart1", {
                            type: "line",
                            data: {
                                labels: player_dates,
                                datasets: [{
                                    label: 'receptions',
                                    data: rec_weekly,
                                    borderColor: "red",
                                    fill: false
                                }, {
                                    label: 'targets',
                                    data: targets_weekly,
                                    borderColor: "green",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });

                        new Chart("weeklyChart2", {
                            type: "line",
                            data: {
                                labels: player_dates,
                                datasets: [{
                                    label: 'rec yds',
                                    data: rec_yds_weekly,
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

                        new Chart("weeklyChart3", {
                            type: "line",
                            data: {
                                labels: player_dates,
                                datasets: [{
                                    label: 'rec td',
                                    data: rec_td_weekly,
                                    borderColor: "yellow",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });

                    }
                </script>

                <p id="demo"></p>

            </div>
            <div class="tab-pane fade" id="monthly-tab-pane" role="tabpanel" aria-labelledby="monthly-tab" tabindex="0">



                <canvas id="monthlyChart1" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>

                <canvas id="monthlyChart2" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>

                <canvas id="monthlyChart3" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>

                <script>
                    if (pos == 'QB') {

                        pass_att_monthly = pass_att_monthly.split(",").slice(-17);
                        pass_cmp_monthly = pass_cmp_monthly.split(",").slice(-17);
                        pass_yds_monthly = pass_yds_monthly.split(",").slice(-17);
                        pass_td_monthly = pass_td_monthly.split(",").slice(-17);
                        rush_td_monthly = rush_td_monthly.split(",").slice(-17);
                        rush_att_monthly = rush_att_monthly.split(",").slice(-17);
                        rush_yds_monthly = rush_yds_monthly.split(",").slice(-17);
                        player_dates_months = player_dates_months.split(",").slice(-17);


                        new Chart("monthlyChart1", {
                            type: "line",
                            data: {
                                labels: player_dates_months,
                                datasets: [{
                                    label: 'pass att',
                                    data: pass_att_monthly,
                                    borderColor: "red",
                                    fill: false
                                }, {
                                    label: 'pass cmp',
                                    data: pass_cmp_monthly,
                                    borderColor: "green",
                                    fill: false
                                }, {
                                    label: 'pass td',
                                    data: pass_td_monthly,
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

                        new Chart("monthlyChart2", {
                            type: "line",
                            data: {
                                labels: player_dates_months,
                                datasets: [{
                                    label: 'pass yds',
                                    data: pass_yds_monthly,
                                    borderColor: "purple",
                                    fill: false
                                }, {
                                    label: 'rush yds',
                                    data: rush_yds_monthly,
                                    borderColor: "pink",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });

                        new Chart("monthlyChart3", {
                            type: "line",
                            data: {
                                labels: player_dates_months,
                                datasets: [{
                                    label: 'rush td',
                                    data: rush_td_monthly,
                                    borderColor: "yellow",
                                    fill: false
                                }, {
                                    label: 'rush att',
                                    data: rush_att_monthly,
                                    borderColor: "orange",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });


                    } else if (pos == 'RB') {

                        rush_td_monthly = rush_td_monthly.split(",").slice(-17);
                        rush_att_monthly = rush_att_monthly.split(",").slice(-17);
                        rush_yds_monthly = rush_yds_monthly.split(",").slice(-17);

                        targets_monthly = targets_monthly.split(",").slice(-17);
                        rec_monthly = rec_monthly.split(",").slice(-17);
                        rec_td_monthly = rec_td_monthly.split(",").slice(-17);
                        rec_yds_monthly = rec_yds_monthly.split(",").slice(-17);
                        player_dates_months = player_dates_months.split(",").slice(-17);


                        new Chart("monthlyChart1", {
                            type: "line",
                            data: {
                                labels: player_dates_months,
                                datasets: [{
                                    label: 'rush att',
                                    data: rush_att_monthly,
                                    borderColor: "green",
                                    fill: false
                                }, {
                                    label: 'targets',
                                    data: targets_monthly,
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

                        new Chart("monthlyChart2", {
                            type: "line",
                            data: {
                                labels: player_dates_months,
                                datasets: [{
                                    label: 'rush yds',
                                    data: rush_yds_monthly,
                                    borderColor: "purple",
                                    fill: false
                                }, {
                                    label: 'rec yds',
                                    data: rec_yds_monthly,
                                    borderColor: "pink",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });

                        new Chart("monthlyChart3", {
                            type: "line",
                            data: {
                                labels: player_dates_months,
                                datasets: [{
                                    label: 'rush td',
                                    data: rush_td_monthly,
                                    borderColor: "yellow",
                                    fill: false
                                }, {
                                    label: 'rec td',
                                    data: rec_td_monthly,
                                    borderColor: "orange",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });


                    } else {

                        targets_monthly = targets_monthly.split(",").slice(-17);
                        rec_monthly = rec_monthly.split(",").slice(-17);
                        rec_td_monthly = rec_td_monthly.split(",").slice(-17);
                        rec_yds_monthly = rec_yds_monthly.split(",").slice(-17);
                        player_dates_months = player_dates_months.split(",").slice(-17);


                        new Chart("monthlyChart1", {
                            type: "line",
                            data: {
                                labels: player_dates_months,
                                datasets: [{
                                    label: 'receptions',
                                    data: rec_monthly,
                                    borderColor: "red",
                                    fill: false
                                }, {
                                    label: 'targets',
                                    data: targets_monthly,
                                    borderColor: "green",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });

                        new Chart("monthlyChart2", {
                            type: "line",
                            data: {
                                labels: player_dates_months,
                                datasets: [{
                                    label: 'rec yds',
                                    data: rec_yds_monthly,
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

                        new Chart("monthlyChart3", {
                            type: "line",
                            data: {
                                labels: player_dates_months,
                                datasets: [{
                                    label: 'rec td',
                                    data: rec_td_monthly,
                                    borderColor: "yellow",
                                    fill: false
                                }]
                            },
                            options: {
                                legend: {
                                    display: true
                                }
                            }
                        });

                    }
                </script>

            </div>
            <div class="tab-pane fade" id="total-tab-pane" role="tabpanel" aria-labelledby="total-tab" tabindex="0">

                This is where the receiving chart goes
                <canvas id="totalChart1" style="width:40%; max-width:1000px"></canvas>
                <!--<canvas id="totalChart1" style="width:70%;max-width:700px"></canvas>
                <canvas id="totalChart2" style="width:30%;max-width:400px"></canvas>
                <canvas id="totalChart3" style="width:30%;max-width:400px"></canvas>-->


                <script>
                    if (pos == 'QB') {

                        pass_cmp_pie = pass_cmp_total / pass_att_total
                        pass_td_pie = pass_td_total / pass_cmp_total
                        rush_td_pie = rush_td_total / rush_att_total

                        var pieLabels = ['pass_cmp', 'pass_inc', ];

                        new Chart("totalChart1", {
                            type: "pie",
                            data: {
                                labels: pieLabels,
                                datasets: [{

                                    backgroundColor: ["green", "red"],
                                    data: [pass_cmp_pie, 1 - pass_cmp_pie],
                                    labels: ['pass_cmp', 'pass_inc']
                                }, {
                                    backgroundColor: ["orange", "yellow"],
                                    data: [pass_td_pie, 1 - pass_td_pie],
                                    labels: ['pass_td', 'pass_no_td']
                                }, {
                                    backgroundColor: ["indigo", "cornflowerblue"],
                                    data: [rush_td_pie, 1 - rush_td_pie],
                                    labels: ['rush_td', 'rush_no_td']
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: {
                                    display: false,
                                },
                                tooltips: {
                                    callbacks: {
                                        label: function(tooltipItem, data) {
                                            var dataset = data.datasets[tooltipItem.datasetIndex];
                                            var index = tooltipItem.index;
                                            return dataset.labels[index] + ': ' + dataset.data[index];
                                        }
                                    }
                                }
                            }
                        });

                    }else if(pos == 'RB') {

                        pass_cmp_pie = pass_cmp_total / pass_att_total
                        pass_td_pie = pass_td_total / pass_cmp_total
                        rush_td_pie = rush_td_total / rush_att_total

                        var pieLabels = ['pass_cmp', 'pass_inc', ];

                        new Chart("totalChart1", {
                            type: "pie",
                            data: {
                                labels: pieLabels,
                                datasets: [{

                                    backgroundColor: ["green", "red"],
                                    data: [pass_cmp_pie, 1 - pass_cmp_pie],
                                    labels: ['pass_cmp', 'pass_inc']
                                }, {
                                    backgroundColor: ["orange", "yellow"],
                                    data: [pass_td_pie, 1 - pass_td_pie],
                                    labels: ['pass_td', 'pass_no_td']
                                }, {
                                    backgroundColor: ["indigo", "cornflowerblue"],
                                    data: [rush_td_pie, 1 - rush_td_pie],
                                    labels: ['rush_td', 'rush_no_td']
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: {
                                    display: false,
                                },
                                tooltips: {
                                    callbacks: {
                                        label: function(tooltipItem, data) {
                                            var dataset = data.datasets[tooltipItem.datasetIndex];
                                            var index = tooltipItem.index;
                                            return dataset.labels[index] + ': ' + dataset.data[index];
                                        }
                                    }
                                }
                            }
                        });

                    }else {

                        pass_cmp_pie = pass_cmp_total / pass_att_total
                        pass_td_pie = pass_td_total / pass_cmp_total
                        rush_td_pie = rush_td_total / rush_att_total

                        var pieLabels = ['pass_cmp', 'pass_inc', ];

                        new Chart("totalChart1", {
                            type: "pie",
                            data: {
                                labels: pieLabels,
                                datasets: [{

                                    backgroundColor: ["green", "red"],
                                    data: [pass_cmp_pie, 1 - pass_cmp_pie],
                                    labels: ['pass_cmp', 'pass_inc']
                                }, {
                                    backgroundColor: ["orange", "yellow"],
                                    data: [pass_td_pie, 1 - pass_td_pie],
                                    labels: ['pass_td', 'pass_no_td']
                                }, {
                                    backgroundColor: ["indigo", "cornflowerblue"],
                                    data: [rush_td_pie, 1 - rush_td_pie],
                                    labels: ['rush_td', 'rush_no_td']
                                }]
                            },
                            options: {
                                responsive: true,
                                legend: {
                                    display: false,
                                },
                                tooltips: {
                                    callbacks: {
                                        label: function(tooltipItem, data) {
                                            var dataset = data.datasets[tooltipItem.datasetIndex];
                                            var index = tooltipItem.index;
                                            return dataset.labels[index] + ': ' + dataset.data[index];
                                        }
                                    }
                                }
                            }
                        });

                    }
                </script>

            </div>
            <div class="tab-pane fade" id="comparison-tab-pane" role="tabpanel" aria-labelledby="comparison-tab" tabindex="0">
                comparison-tab
            </div>
        </div>



    </div>



    </div>


</body>

</html>