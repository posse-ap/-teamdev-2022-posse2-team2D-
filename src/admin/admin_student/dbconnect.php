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

// $apply_info_stmt = $db->prepare("SELECT * FROM apply_info");
// $apply_info_stmt->execute();
// $apply_infos = $apply_info_stmt->fetchAll();

if (!isset($_GET['search_name'])) :
  $apply_info_stmt = $db->prepare("SELECT * FROM apply_info");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (strlen($_GET['search_name']) == 0):
  $apply_info_stmt = $db->prepare("SELECT * FROM apply_info");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
else :
  $search = $_GET['search_name'];
  $apply_info_stmt = $db->prepare("SELECT * FROM apply_info WHERE name = '$search'");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
endif;
