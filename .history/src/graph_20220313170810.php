<?php
require("./dbconnect.php");

$stmt = $pdo->query("SELECT*FROM study_data WHERE DATE_FORMAT(study_date, '%Y%m') = DATE_FORMAT(now(), '%Y%m') "
);
$chart_graph_data = $stmt->fetchAll();

$stmt = $pdo->query(
	"SELECT *FROM study_data;"
);
$graph_data = $stmt->fetchAll();

$stmt = $pdo->query(
	"SELECT *FROM study_data  INNER JOIN study_languages ON study_languages.id = study_data.study_language_id;"
);
$graph_data_languages  = $stmt->fetchAll();



$stmt = $pdo->query(
	"SELECT *FROM study_data INNER JOIN study_contents ON study_contents.id = study_data.study_content_id;"
);
$graph_data_contents  = $stmt->fetchAll();

?>