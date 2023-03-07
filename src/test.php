<?php 
$selectedPlayer = 'aaron rodgers';

$result = exec('python ../src/test.py ' . escapeshellarg($selectedPlayer));
echo $result;

?>