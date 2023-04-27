<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <title>Silicon Stadium</title>
    <link rel="icon" type="image/x-icon" href="../src/picSource/favicon.ico">
</head>

<body id="teamPage">

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
                //Checking session
                $_SESSION["TEST"] = True;
                //Including database connection credentials
                require_once 'config.php';
                require 'php/DBconnect.php';
                error_reporting(E_ALL);
                ini_set('display_errors', True);
                //Creating connection
                $connection = connect();
                //Checking login status and displaying user email
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
                ?>
            </li>
        </div>
    </nav>

    <div id="teamPageData" style="color: white; font-family: 'Bangers', cursive; font-size: xx-large; font-weight: 500; text-shadow: -2px 2px 0px black; text-align: center;">
        <?php
        //Receiving selected team from index page
        $selectedTeam = $_POST['teamSelect'];
        if (empty($selectedTeam)) {
            echo ('no team found');
        } else {
            //Sending selected team string to team_data_chart via exec call and saving as a string variable
            $result_set = exec('python ../src/team_data_chart.py ' . escapeshellarg($selectedTeam));
        }
        ?>
        <script>
            //Enable tabs
            const triggerTabList = document.querySelectorAll('#myTab button')
            triggerTabList.forEach(triggerEl => {
                const tabTrigger = new bootstrap.Tab(triggerEl)

                triggerEl.addEventListener('click', event => {
                    event.preventDefault()
                    tabTrigger.show()
                })
            });

            //Copying string variable from PHP to javascript
            var data = <?php echo json_encode($result_set); ?>;

            //Separating strings into arrays
            var [pass_att_weekly, pass_cmp_weekly, pass_td_weekly, pass_yds_weekly,
                pass_att_monthly, pass_cmp_monthly, pass_td_monthly, pass_yds_monthly,
                pass_att_total, pass_cmp_total, pass_td_total, pass_yds_total,
                rush_td_weekly, rush_att_weekly, rush_yds_weekly,
                rush_td_monthly, rush_att_monthly, rush_yds_monthly,
                rush_td_total, rush_att_total, rush_yds_total,
                targets_weekly, rec_weekly, rec_td_weekly, rec_yds_weekly,
                targets_monthly, rec_monthly, rec_td_monthly, rec_yds_monthly,
                targets_total, rec_total, rec_td_total, rec_yds_total
            ] = data.split('#');

        </script>


        <ul class="nav nav-tabs nav-fill " id="myTab" role="tablist">
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


                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="w-passing-tab" data-bs-toggle="tab" data-bs-target="#w-passing-tab-pane" type="button" role="tab" aria-controls="w-passing-tab-pane" aria-selected="true">
                            Passing data
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="w-rushing-tab" data-bs-toggle="tab" data-bs-target="#w-rushing-tab-pane" type="button" role="tab" aria-controls="w-rushing-tab-pane" aria-selected="false">
                            Rushing data
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="w-receiving-tab" data-bs-toggle="tab" data-bs-target="#w-receiving-tab-pane" type="button" role="tab" aria-controls="w-receiving-tab-pane" aria-selected="false">
                            Receiving data
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="w-passing-tab-pane" role="tabpanel" aria-labelledby="w-passing-tab" tabindex="0">

                        <div class="row">
                            <div class="col">
                                <script>
                                    //Text wall start
                                    document.write("Team name:</br>")
                                </script>
                                <?php
                                //Team abbreviation
                                echo $selectedTeam; 
                                ?>;
                                <script>
                                    //Text wall continues
                                    document.write("</br>Stats since 2019:</br>Air TDs:</br>" +
                                        pass_td_total + "</br>Rushing TDs:</br>" +
                                        rush_td_total + "</br>Air Yards</br>" +
                                        pass_yds_total + "</br>Rushing Yards:</br>" +
                                        rush_yds_total)
                                </script>

                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <canvas id="weeklyChart1P" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                                <canvas id="weeklyChart2P" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                            </div>
                        </div>

                        <script>
                            //Set x-axis labels as array
                            var x_dates = ['week 1', 'week 2', 'week 3', 'week 4', 'week 5', 'week 6', 'week 7', 'week 8', 'week 9', 'week 10',
                                'week 11', 'week 12', 'week 13', 'week 14', 'week 15', 'week 16', 'week 17'
                            ]

                            //Split and shorten arrays
                            pass_att_weekly = pass_att_weekly.split(",").slice(-17);
                            pass_cmp_weekly = pass_cmp_weekly.split(",").slice(-17);
                            pass_yds_weekly = pass_yds_weekly.split(",").slice(-17);
                            pass_td_weekly = pass_td_weekly.split(",").slice(-17);

                            //Graph weekly passing data
                            new Chart("weeklyChart1P", {
                                type: "line",
                                data: {
                                    labels: x_dates,
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

                            new Chart("weeklyChart2P", {
                                type: "line",
                                data: {
                                    labels: x_dates,
                                    datasets: [{
                                        label: 'pass yds',
                                        data: pass_yds_weekly,
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
                        </script>

                    </div>
                    <div class="tab-pane fade" id="w-rushing-tab-pane" role="tabpanel" aria-labelledby="w-rushing-tab" tabindex="0">


                        <div class="row">
                            <div class="col">
                                <script>
                                    //Text wall
                                    document.write("Team name:</br>")
                                </script>
                                <?php 
                                //Team abbreviation
                                echo $selectedTeam; 
                                ?>;
                                <script>
                                    //Text wall continues
                                    document.write("</br>Stats since 2019:</br>Air TDs:</br>" +
                                        pass_td_total + "</br>Rushing TDs:</br>" +
                                        rush_td_total + "</br>Air Yards</br>" +
                                        pass_yds_total + "</br>Rushing Yards:</br>" +
                                        rush_yds_total)
                                </script>
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <canvas id="weeklyChart1R" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                                <canvas id="weeklyChart2R" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                                <canvas id="weeklyChart3R" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                            </div>
                        </div>

                        <script>
                            //Split and shorten arrays
                            rush_td_weekly = rush_td_weekly.split(",").slice(-17);
                            rush_att_weekly = rush_att_weekly.split(",").slice(-17);
                            rush_yds_weekly = rush_yds_weekly.split(",").slice(-17);

                            //Graph weekly rushing data
                            new Chart("weeklyChart1R", {
                                type: "line",
                                data: {
                                    labels: x_dates,
                                    datasets: [{
                                        label: 'rush att',
                                        data: rush_att_weekly,
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

                            new Chart("weeklyChart2R", {
                                type: "line",
                                data: {
                                    labels: x_dates,
                                    datasets: [{
                                        label: 'rush yds',
                                        data: rush_yds_weekly,
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

                            new Chart("weeklyChart3R", {
                                type: "line",
                                data: {
                                    labels: x_dates,
                                    datasets: [{
                                        label: 'rush td',
                                        data: rush_td_weekly,
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
                        </script>
                    </div>
                    <div class="tab-pane fade" id="w-receiving-tab-pane" role="tabpanel" aria-labelledby="w-receiving-tab" tabindex="0">


                        <div class="row">
                            <div class="col">
                                <script>
                                    //Text wall
                                    document.write("Team name:</br>")
                                </script>
                                <?php 
                                //Team abbreviation
                                echo $selectedTeam; 
                                ?>;
                                <script>
                                    //Text wall continues
                                    document.write("</br>Stats since 2019:</br>Air TDs:</br>" +
                                        pass_td_total + "</br>Rushing TDs:</br>" +
                                        rush_td_total + "</br>Air Yards</br>" +
                                        pass_yds_total + "</br>Rushing Yards:</br>" +
                                        rush_yds_total)
                                </script>
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <canvas id="weeklyChart1C" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                                <canvas id="weeklyChart2C" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                                <canvas id="weeklyChart3C" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                            </div>
                        </div>

                        <script>
                            //Split and shorten arrays
                            targets_weekly = targets_weekly.split(",").slice(-17);
                            rec_weekly = rec_weekly.split(",").slice(-17);
                            rec_td_weekly = rec_td_weekly.split(",").slice(-17);
                            rec_yds_weekly = rec_yds_weekly.split(",").slice(-17);

                            //Graph weekly receiver data
                            new Chart("weeklyChart1C", {
                                type: "line",
                                data: {
                                    labels: x_dates,
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

                            new Chart("weeklyChart2C", {
                                type: "line",
                                data: {
                                    labels: x_dates,
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

                            new Chart("weeklyChart3C", {
                                type: "line",
                                data: {
                                    labels: x_dates,
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
                        </script>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="monthly-tab-pane" role="tabpanel" aria-labelledby="monthly-tab" tabindex="0">

                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="m-passing-tab" data-bs-toggle="tab" data-bs-target="#m-passing-tab-pane" type="button" role="tab" aria-controls="m-passing-tab-pane" aria-selected="true">
                            Passing data
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="m-rushing-tab" data-bs-toggle="tab" data-bs-target="#m-rushing-tab-pane" type="button" role="tab" aria-controls="m-rushing-tab-pane" aria-selected="false">
                            Rushing data
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="m-receiving-tab" data-bs-toggle="tab" data-bs-target="#m-receiving-tab-pane" type="button" role="tab" aria-controls="m-receiving-tab-pane" aria-selected="false">
                            Receiving data
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="m-passing-tab-pane" role="tabpanel" aria-labelledby="m-passing-tab" tabindex="0">

                        <div class="row">
                            <div class="col">
                                <script>
                                    //Text wall start
                                    document.write("Team name:</br>")
                                </script>
                                <?php 
                                //Team abbreviation
                                echo $selectedTeam; 
                                ?>;
                                <script>
                                    //Text wall continues
                                    document.write("</br>Stats since 2019:</br>Air TDs:</br>" +
                                        pass_td_total + "</br>Rushing TDs:</br>" +
                                        rush_td_total + "</br>Air Yards</br>" +
                                        pass_yds_total + "</br>Rushing Yards:</br>" +
                                        rush_yds_total)
                                </script>
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <canvas id="monthlyChart1PM" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                                <canvas id="monthlyChart2PM" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                            </div>
                        </div>




                        <script>
                            //Set x-axis array for months
                            var x_months = ['month 1', 'month 2', 'month 3', 'month 4', 'month 5', 'month 6', 'month 7', 'month 8',
                                'month 9', 'month 10', 'month 11', 'month 12', 'month 13', 'month 14', 'month 15', 'month 16', 'month 17'
                            ]

                            //Split and shorten arrays
                            pass_att_monthly = pass_att_monthly.split(",").slice(-17);
                            pass_cmp_monthly = pass_cmp_monthly.split(",").slice(-17);
                            pass_yds_monthly = pass_yds_monthly.split(",").slice(-17);
                            pass_td_monthly = pass_td_monthly.split(",").slice(-17);



                            //Graph monthly passing data
                            new Chart("monthlyChart1PM", {
                                type: "line",
                                data: {
                                    labels: x_months,
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

                            new Chart("monthlyChart2PM", {
                                type: "line",
                                data: {
                                    labels: x_months,
                                    datasets: [{
                                        label: 'pass yds',
                                        data: pass_yds_monthly,
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
                        </script>

                    </div>
                    <div class="tab-pane fade" id="m-rushing-tab-pane" role="tabpanel" aria-labelledby="m-rushing-tab" tabindex="0">

                        <div class="row">
                            <div class="col">
                                <script>
                                    //Text wall start
                                    document.write("Team name:</br>")
                                </script>
                                <?php 
                                //Team abbreviation
                                echo $selectedTeam; 
                                ?>;
                                <script>
                                    //Text wall continues
                                    document.write("</br>Stats since 2019:</br>Air TDs:</br>" +
                                        pass_td_total + "</br>Rushing TDs:</br>" +
                                        rush_td_total + "</br>Air Yards</br>" +
                                        pass_yds_total + "</br>Rushing Yards:</br>" +
                                        rush_yds_total)
                                </script>
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <canvas id="monthlyChart1RM" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                                <canvas id="monthlyChart2RM" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                                <canvas id="monthlyChart3RM" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                            </div>
                        </div>

                        <script>
                            //Split and shorten rushing data
                            rush_td_monthly = rush_td_monthly.split(",").slice(-17);
                            rush_att_monthly = rush_att_monthly.split(",").slice(-17);
                            rush_yds_monthly = rush_yds_monthly.split(",").slice(-17);

                            //Graph monthly rushing data
                            new Chart("monthlyChart1RM", {
                                type: "line",
                                data: {
                                    labels: x_months,
                                    datasets: [{
                                        label: 'rush att',
                                        data: rush_att_monthly,
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

                            new Chart("monthlyChart2RM", {
                                type: "line",
                                data: {
                                    labels: x_months,
                                    datasets: [{
                                        label: 'rush yds',
                                        data: rush_yds_monthly,
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

                            new Chart("monthlyChart3RM", {
                                type: "line",
                                data: {
                                    labels: x_months,
                                    datasets: [{
                                        label: 'rush td',
                                        data: rush_td_monthly,
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
                        </script>
                    </div>
                    <div class="tab-pane fade" id="m-receiving-tab-pane" role="tabpanel" aria-labelledby="m-receiving-tab" tabindex="0">

                        <div class="row">
                            <div class="col">
                                <script>
                                    //Text wall starts
                                    document.write("Team name:</br>")
                                </script>
                                <?php 
                                //Team abbreviation
                                echo $selectedTeam; 
                                ?>;
                                <script>
                                    //Text wall continues
                                    document.write("</br>Stats since 2019:</br>Air TDs:</br>" +
                                        pass_td_total + "</br>Rushing TDs:</br>" +
                                        rush_td_total + "</br>Air Yards</br>" +
                                        pass_yds_total + "</br>Rushing Yards:</br>" +
                                        rush_yds_total)
                                </script>
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <canvas id="monthlyChart1CM" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                                <canvas id="monthlyChart2CM" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                                <canvas id="monthlyChart3CM" style="width:15%;max-width:25vw;background-color:white;border-radius: 8px;"></canvas>
                            </div>
                        </div>

                        <script>
                            //Split and shorten monthly receiving data
                            targets_monthly = targets_monthly.split(",").slice(-17);
                            rec_monthly = rec_monthly.split(",").slice(-17);
                            rec_td_monthly = rec_td_monthly.split(",").slice(-17);
                            rec_yds_monthly = rec_yds_monthly.split(",").slice(-17);

                            //Graph monthly receiving data
                            new Chart("monthlyChart1CM", {
                                type: "line",
                                data: {
                                    labels: x_months,
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

                            new Chart("monthlyChart2CM", {
                                type: "line",
                                data: {
                                    labels: x_months,
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

                            new Chart("monthlyChart3CM", {
                                type: "line",
                                data: {
                                    labels: x_months,
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
                        </script>

                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="total-tab-pane" role="tabpanel" aria-labelledby="total-tab" tabindex="0">

                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="t-passing-tab" data-bs-toggle="tab" data-bs-target="#t-passing-tab-pane" type="button" role="tab" aria-controls="t-passing-tab-pane" aria-selected="true">
                            Passing data
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="t-rushing-tab" data-bs-toggle="tab" data-bs-target="#t-rushing-tab-pane" type="button" role="tab" aria-controls="t-rushing-tab-pane" aria-selected="false">
                            Rushing data
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="t-receiving-tab" data-bs-toggle="tab" data-bs-target="#t-receiving-tab-pane" type="button" role="tab" aria-controls="t-receiving-tab-pane" aria-selected="false">
                            Receiving data
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="t-passing-tab-pane" role="tabpanel" aria-labelledby="t-passing-tab" tabindex="0">

                        <div class="row">
                            <div class="col">
                                <script>
                                    //Text wall start
                                    document.write("Team name:</br>")
                                </script>
                                <?php 
                                //Team abbreviation
                                echo $selectedTeam; 
                                ?>;
                                <script>
                                    //Text wall continues
                                    document.write("</br>Stats since 2019:</br>Air TDs:</br>" +
                                        pass_td_total + "</br>Rushing TDs:</br>" +
                                        rush_td_total + "</br>Air Yards</br>" +
                                        pass_yds_total + "</br>Rushing Yards:</br>" +
                                        rush_yds_total)
                                </script>
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <canvas id="totalChart1P" style="width:40%; max-width:1000px"></canvas>
                            </div>
                        </div>

                        <script>
            
                            var pieLabels = [];

                            //Graphing 2019-present passing data
                            new Chart("totalChart1P", {
                                type: "pie",
                                data: {
                                    labels: pieLabels,
                                    datasets: [{

                                        backgroundColor: ["green", "red"],
                                        data: [pass_cmp_total, pass_att_total - pass_cmp_total],
                                        labels: ['completed pass', 'incomplete pass']
                                    }, {
                                        backgroundColor: ["orange", "yellow"],
                                        data: [pass_td_total, pass_att_total - pass_td_total],
                                        labels: ['passing td', 'pass no td']
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
                        </script>


                    </div>
                    <div class="tab-pane fade" id="t-rushing-tab-pane" role="tabpanel" aria-labelledby="t-rushing-tab" tabindex="0">

                        <div class="row">
                            <div class="col">
                                <script>
                                    //Text wall
                                    document.write("Team name:</br>")
                                </script>
                                <?php 
                                //Team abbreviation
                                echo $selectedTeam; 
                                ?>;
                                <script>
                                    //Text wall continues
                                    document.write("</br>Stats since 2019:</br>Air TDs:</br>" +
                                        pass_td_total + "</br>Rushing TDs:</br>" +
                                        rush_td_total + "</br>Air Yards</br>" +
                                        pass_yds_total + "</br>Rushing Yards:</br>" +
                                        rush_yds_total)
                                </script>
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <canvas id="totalChart1R" style="width:40%; max-width:1000px"></canvas>
                            </div>
                        </div>

                        <script>
                            var pieLabels = [];

                            //Graphing 2019-present rushing data
                            new Chart("totalChart1R", {
                                type: "pie",
                                data: {
                                    labels: pieLabels,
                                    datasets: [{

                                        backgroundColor: ["green", "red"],
                                        data: [rush_att_total, targets_total],
                                        labels: ['rush_att', 'non rushing attempts']
                                    }, {
                                        backgroundColor: ["orange", "yellow"],
                                        data: [rush_td_total, rush_att_total - rush_td_total],
                                        labels: ['rushing td', 'rush no td']
                                    }, {
                                        backgroundColor: ["indigo", "cornflowerblue"],
                                        data: [rush_yds_total, rec_yds_total],
                                        labels: ['rush yds', 'reception yds']
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
                        </script>

                    </div>
                    <div class="tab-pane fade" id="t-receiving-tab-pane" role="tabpanel" aria-labelledby="t-receiving-tab" tabindex="0">

                        <div class="row">
                            <div class="col">
                                <script>
                                    //Text wall starts
                                    document.write("Team name:</br>")
                                </script>
                                <?php 
                                //Team abbreviation
                                echo $selectedTeam; 
                                ?>;
                                <script>
                                    //Text wall continues
                                    document.write("</br>Stats since 2019:</br>Air TDs:</br>" +
                                        pass_td_total + "</br>Rushing TDs:</br>" +
                                        rush_td_total + "</br>Air Yards</br>" +
                                        pass_yds_total + "</br>Rushing Yards:</br>" +
                                        rush_yds_total)
                                </script>
                            </div>
                            <div class="col">

                            </div>
                            <div class="col">
                                <canvas id="totalChart1C" style="width:40%; max-width:1000px"></canvas>
                            </div>
                        </div>

                        <script>
                            var pieLabels = [];

                            //Graph 2019-present receiving data
                            new Chart("totalChart1C", {
                                type: "pie",
                                data: {
                                    labels: pieLabels,
                                    datasets: [{

                                        backgroundColor: ["green", "red"],
                                        data: [rec_total, targets_total - rec_total],
                                        labels: ['receptions', 'incompletes']
                                    }, {
                                        backgroundColor: ["orange", "yellow"],
                                        data: [rec_td_total, targets_total - rec_td_total],
                                        labels: ['reception tds', 'target no td']
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
                        </script>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="comparison-tab-pane" role="tabpanel" aria-labelledby="comparison-tab" tabindex="0">

                <div id=comparison-test-container>



                </div>

            </div>
        </div>
    </div>


</body>

</html>