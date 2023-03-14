<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!--<script src="../src/js/charts.js" type="module"></script>-->
    <link rel="stylesheet" href="/Capstone_project/dist/css/style.min.css">
    <title>Silicon Stadium</title>
    <link rel="icon" type="image/x-icon" href="../src/picSource/favicon.ico">
</head>

<body id="teamPage">
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', True);

    require 'php/DBconnect.php';
    $connection = connect();
    ?>



    <div id="teamPageData">

        <div class="all">
            <button class="navLink" onclick="location.href='../src/index.php'">Home</button>
            <button class="navLink" onclick="location.href='../src/fantasy.php'">Fantasy</button>
            <button class="navLink" onclick="location.href='../src/support.php'">Support</button>
        </div>
        <div id="teamDataDump">
            <?php
            $selectedTeam = $_POST['teamSelect'];
            if (empty($selectedTeam)) {
                echo ('no team found');
            } else {


                $result = exec('python ../src/team_data_chart.py ' . escapeshellarg($selectedTeam));
                $finalResult = explode(",", $result);
                $xVar =range(0,count($finalResult)-1);
    


            }
            ?>

            <canvas id="teamChart" style="width:50%;max-width:700px;background-color:white"></canvas>

            <script>
                var data1 =
                    <?php echo json_encode($finalResult); ?>;

                var xValues = <?php echo json_encode($xVar); ?>;
                new Chart("teamChart", {
                    type: "line",
                    data: {
                        labels: xValues,
                        datasets: [{
                            data: data1,
                            borderColor: "red",
                            fill: false
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        }
                    }
                });
            </script>


        </div>

    </div>

</body>

</html>