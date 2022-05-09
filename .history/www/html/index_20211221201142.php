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
?>

