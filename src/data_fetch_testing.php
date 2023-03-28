<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pyscript.net/alpha/pyscript.css" />
    <script defer src="https://pyscript.net/alpha/pyscript.js"></script>
    <link rel="stylesheet" href="../dist/css/style.min.css">
    <script src="js/main.js" type="module"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="js/jQFuncs.js"></script>
    <title>Testes</title>
</head>

<body>
    <h1>We are going to try out a few different things</h1>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', True);

    require 'php/DBconnect.php';
    $connection = connect();
    ?>

    <div id="homePageData">


        <?php


        $stmt = $connection->prepare('SELECT DISTINCT player_id, player 
            FROM nfl_pass_rush_receive_raw_data ORDER BY player ASC;');
        $stmt->execute();
        $results = $stmt->fetchAll();


        //print_r($results);

        /*foreach($results as $result) {
                echo $result['player_id'] , "<br>" ;
            }*/
        ?>

        <label for="exampleDataList" class="form-label">Datalist example</label>
        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
        <datalist id="datalistOptions">
            <?php
            foreach ($rawdata as $option) {
                echo '<option value=\'' . $option . '\'>';
            }
            ?>
        </datalist>

</body>

</html>