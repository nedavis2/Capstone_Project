<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Capstone_project/dist/css/style.min.css">

    <title>Silicon Stadium</title>
    <link rel="icon" type="image/x-icon" href="../src/picSource/favicon.ico">
</head>

<body id="playerPage">

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', True);

    require 'php/DBconnect.php';
    $connection = connect();
    ?>


    <div id="playerPageData">
        
        <div class="all">
            <button class="navLink" onclick="location.href='../src/index.php'">Home</button>
            <button class="navLink" onclick="location.href='../src/fantasy.php'">Fantasy</button>
            <button class="navLink" onclick="location.href='../src/support.php'">Support</button>
        </div>

        <div id="PlayerRep">
            <div id="playerIntro">
                <p>Player data</p>
            </div>
        </div>

        <div id="playerPageData">
            <?php
            
            
            $selectedPlayer = $_POST['playerSelect'];
            if (empty($selectedPlayer)) {
                echo ('no player found');
            } else {

                
                $result = exec('python ../src/test.py ' . escapeshellarg($selectedPlayer));
                $finalResult = explode(",", $result);
        
            }
            ?>


        </div>



    </div>

    <div id="playerResultSet">
        <div id="pResultName"><?php echo "Player name: " . $finalResult[0]; ?></div>
        <div id="pResultTeam"><?php echo "Player team: " . $finalResult[1]; ?></div>
        <div id="pResultStat1"><?php echo "Total reception yds since 2019: " . $finalResult[2]; ?></div>
        <div id="pResultStat2"><?php echo "Total passes complete since 2019: " . $finalResult[3]; ?></div>
        <div id="pResultStat3"><?php echo "Total passes attempted since 2019: " . $finalResult[4]; ?></div>
    </div>
    
</body>

</html>