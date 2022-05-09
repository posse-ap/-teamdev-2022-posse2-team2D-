<?php

// echo phpinfo();

// ドライバ呼び出しを使用して MySQL データベースに接続します
$dsn = 'mysql:dbname=quizy;charset=utf8;host=db';
$user = 'naoki';
$password = 'password';

try {
    $dbh = new PDO($dsn, $user, $password);
    // $dbh = new PDO(
    //     'mysql:host=db;dbname=quizy;charset=utf8mb4',
    //     'naoki',
    //     'password'
    // );
    echo "接続成功\n";
} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
    exit();
}

// $id = $_GET['id'];

// $choice = $pdo->prepare('SELECT * FROM choices WHERE big_question_id='.$id);
// $choice->execute(array($_REQUEST['id']));
// $choice_data = $choice->fetchAll();

// $question = $pdo->prepare('SELECT * FROM questions WHERE big_question_id='.$id);
// $question->execute(array($_REQUEST['id']));
// $question_data = $question->fetchAll();

?>

<?php
// require('quiz.php');


// big_questions テーブルから '東京の難読地名クイズ'、'広島県の難読地名クイズ'をそれぞれ取得
// WHERE で一つだけ取得すると、foreach() で書いても大丈夫
$sql1 = "SELECT * FROM big_questions WHERE id = 1";
$sql2 = "SELECT * FROM big_questions WHERE id = 2";

// 上で定義した変数に対し処理
$stmt1 = $db->query($sql1);
$stmt2 = $db->query($sql2);


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>quizy</title>
</head>

<body>
  <?php
  $url = $_SERVER['REQUEST_URI'];
  if(strstr($url, '1')) : ?>
    <?php foreach ($stmt1 as $row1) : ?>
    <p>
      <a href="/quiz?question_id=<?php echo $row1['id']; ?>"><?php echo $row1['id'] . '：' . $row1['name']; ?></a>
    </p>
    <?php endforeach; ?>
  <?php elseif (strstr($url, '2')): ?>
    <?php foreach ($stmt2 as $row2) : ?>
    <p>
      <a href="/quiz?question_id=<?php echo $row2['id']; ?>"><?php echo $row2['id'] . '：' . $row2['name']; ?></a>
    </p>
    <?php endforeach; ?>
  <?php endif; ?>






  


  


  
  



</body>

</html>



<!-- <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSSE課題</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <script src="quizy.js"></script>
</body>
</html> -->
