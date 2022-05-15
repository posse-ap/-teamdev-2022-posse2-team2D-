<?php
$dsn = 'mysql:host=db;dbname=shukatsu;charset=utf8;';
$user = 'root';
$password = 'password';

try{
  $pdo = new PDO($dsn,$user,$password,[
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,//連想配列
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//例外
    PDO::ATTR_EMULATE_PREPARES => true,//SQLインジェクション対策
  ]);
  echo '接続成功';
}catch(PDOException $e){
  echo '接続失敗' ,$e->getMessage() . "\n";
  exit();
}
