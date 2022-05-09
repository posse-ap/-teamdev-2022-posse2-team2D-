<?php


require('dbconnect.php');

$stmt = $db->query('SELECT * FROM big_questions');
$big_question_results = $stmt->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>クイズにリダイレクト</title>
</head>

<body>
<?php foreach ($big_question_results as $big_question_result) : ?>

<div>
  <a href="/quiz.php?id=<?= $big_question_result['id'] ?>"><?= $big_question_result['id'] . '：' . $big_question_result['name']; ?></a> 
</div>
<?php endforeach; ?>


</body>

</html>