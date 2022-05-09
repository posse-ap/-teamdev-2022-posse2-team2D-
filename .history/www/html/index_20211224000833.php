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

$id = $_GET['id'];

$options = $dbh->prepare('SELECT * FROM choices WHERE big_question_id='.$id);
$options->execute(array($_REQUEST['id']));
$options_result = $options->fetchAll();

$questions = $
?>

<!DOCTYPE html>
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
</html>
