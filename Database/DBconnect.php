<?php
$mysqli = new mysqli("localhost","root","","capstone_project");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();

  
}

if ($result = $mysqli -> query("SELECT player FROM nfl_pass_rush_receive_raw_data where player = 'aaron rodgers' and game_date = '2019-09-05'")) {
  echo var_dump($result);
  // Free result set
  $result -> free_result();
}

$mysqli -> close();

?>