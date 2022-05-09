<?php

// echo phpinfo();

// ドライバ呼び出しを使用して MySQL データベースに接続します
$dsn = 'mysql:dbname=quizy;charset=utf8;host=db';
$user = 'naoki';
$password = 'password';

try {

    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo '成功';
  
  } catch (PDOException $e) {
  
    echo '接続失敗' . $e->getMessage();
    exit();
  
}
?>

<?php

$dsn = 'mysql:host=db;dbname=kuizy;charset=utf8;';
$user = 'root';
$password = 'secret';



