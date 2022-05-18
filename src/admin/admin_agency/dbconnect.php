<?php
$dsn = 'mysql:host=db;dbname=db_mydb;charset=utf8;';
$user = 'db_user';
$password = 'password';

try {
  $db = new PDO($dsn, $user, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo '接続失敗: ' . $e->getMessage();
  exit();
}

$agent = $_GET['agent'];
$stmt_id = $db->prepare("select id from agent where agent_name = '$agent'");
$stmt_id->execute();
$ids = $stmt_id->fetch();
$id = $ids['id'];

$stmt = $db->prepare("select * from users where agent_id = '$id'");
$stmt->execute();
$cnts = $stmt->fetchAll();