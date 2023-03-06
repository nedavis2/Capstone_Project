<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Capstone_project/dist/css/style.min.css">

    <title>Silicon Stadium</title>
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

                $stmt = $connection->prepare("SELECT DISTINCT team FROM nfl_pass_rush_receive_raw_data
                    WHERE team = '$selectedTeam';");
                $stmt->execute();
                $results = $stmt->fetchAll();
                $p = $results[0];
                print("<option value=\"" . $p['team'] . "\">" . $p['team']  . "</option>");

                echo $p[0];
            }
            ?>

        </div>

    </div>

</body>

</html>