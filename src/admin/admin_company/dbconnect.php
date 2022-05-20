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

if (!isset($_GET['search'])) :
  $cnt_stmt = $db->prepare("select * from agent");
  $cnt_stmt->execute();
  $cnts = $cnt_stmt->fetchAll();
elseif (strlen($_GET['search']) == 0):
  $cnt_stmt = $db->prepare("select * from agent");
  $cnt_stmt->execute();
  $cnts = $cnt_stmt->fetchAll();
else :
  $search = $_GET['search'];
  $sea = '%' . $search . '%';
  $cnt_stmt = $db->prepare("select * from agent where agent_name like '$sea'");
  $cnt_stmt->execute();
  $cnts = $cnt_stmt->fetchAll();
endif;