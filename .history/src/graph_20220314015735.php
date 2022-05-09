<?php
require("./dbconnect.php");

$sum = $db->prepare('SELECT sum(study_hour) FROM study_data');
$sum->execute();
$hour_sum = $sum->fetch();

$sum1 = $db->prepare("SELECT sum(study_hour) FROM study_data WHERE DATE_FORMAT(study_date, '%Y%m')=DATE_FORMAT(NOW(), '%Y%m')");
$sum1->execute();
$sum_month_sum = $sum1->fetch();

$sum2 = $db->prepare("SELECT sum(study_hour) FROM study_data WHERE DATE_FORMAT(study_date, '%Y%m%D')=DATE_FORMAT(NOW(), '%Y%m%D')");
$sum2->execute();
$sum_day_sum = $sum2->fetch();

?>

