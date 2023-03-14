<?php


$nfl_prr_data = file_get_contents('https://stewart-gibson.shinyapps.io/NFL_All_Data_Downloader/_w_1aab92e6/session/1970078c2acb24eaf4c4bbefb546b354/download/downloadData?w=1aab92e6');
$data = str_getcsv($nfl_prr_data);



$fp = fopen('nfl_data.csv', 'w');



fputcsv($fp, $data);


fclose($fp);
?>