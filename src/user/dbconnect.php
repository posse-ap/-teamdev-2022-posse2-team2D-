<?php
$dsn = 'mysql:host=mysql;dbname=webapp;charset=utf8;';
$user = 'naoki';
$password = 'password';

try{
  $pdo = new PDO($dsn ,$user ,$password,[
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,//連想配列
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//例外
    PDO::ATTR_EMULATE_PREPARES => false,//SQLインジェクション対策
  ]);
  // echo '接続成功';
}catch(PDOException $e){
  echo '接続失敗' ,$e->getMessage() . "\n";
  exit();
}


// $stmt_shuffle = $pdo->prepare('select publisher_five from agent where agent_name=:name ');
// $stmt_shuffle->bindValue('name',$cnt["agent_name"],PDO::PARAM_STR);
// $stmt_shuffle->execute();
// $shuffles = $stmt_shuffle->fetchAll();

?>

