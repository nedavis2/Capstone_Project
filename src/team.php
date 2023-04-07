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
            </div>
        </div>
    </nav>


    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', True);

    require 'php/DBconnect.php';
    $connection = connect();
    ?>





    <div id="teamPageData">





        <?php
        $selectedTeam = $_POST['teamSelect'];
        if (empty($selectedTeam)) {
            echo ('no team found');
        } else {


            $result_set = exec('python ../src/team_data_chart.py ' . escapeshellarg($selectedTeam));
            //$finalResult = explode(",", $result);

        }
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

            var data = <?php echo json_encode($result_set); ?>;

            var [team_pass_att_weekly, team_pass_cmp_weekly, team_pass_td_weekly, team_pass_yds_weekly,
                team_pass_att_monthly, team_pass_cmp_monthly, team_pass_td_monthly, team_pass_yds_monthly,
                team_pass_att_total, team_pass_cmp_total, team_pass_td_total, team_pass_yds_total, team_rush_td_weekly,
                team_rush_yds_weekly, team_rec_td_weekly, team_rec_weekly, team_rush_td_monthly, team_rush_att_monthly,
                team_rush_yds_monthly, team_rec_td_monthly, team_rec_monthly, team_rush_td_total, team_rush_yds_total,
                team_targets_weekly, team_rec_weekly, team_rec_td_weekly, team_rec_yds_weekly, team_targets_monthly,
                team_rec_monthly, team_rec_td_monthly, team_rec_yds_monthly, team_targets_total, team_rec_total,
                team_rec_td_total, team_rec_yds_total, get_dates, get_months
            ] = data.split('#');
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
                <div class="tab-pane fade show active" id="passing-tab-pane" role="tabpanel" aria-labelledby="passing-tab" tabindex="0">
                    test 1
                </div>
                <div class="tab-pane fade show active" id="rushing-tab-pane" role="tabpanel" aria-labelledby="rushing-tab" tabindex="0">
                    test 2
                </div>
                <div class="tab-pane fade show active" id="receiving-tab-pane" role="tabpanel" aria-labelledby="receiving-tab" tabindex="0">
                    test 3
                </div>

                <div class="tab-pane fade" id="monthly-tab-pane" role="tabpanel" aria-labelledby="monthly-tab" tabindex="0">



                </div>
                <div class="tab-pane fade" id="total-tab-pane" role="tabpanel" aria-labelledby="total-tab" tabindex="0">This is where the receiving chart goes</div>
                <div class="tab-pane fade" id="comparison-tab-pane" role="tabpanel" aria-labelledby="comparison-tab" tabindex="0">...</div>
            </div>


        </div>
    </div>



    </div>



</body>

</html>