<?php
/* htmlspecialcharsを短くする */
function h($value) {
	return htmlspecialchars($value, 'ENT_QUOTES');
}

$dsn = 'mysql:host=mysql;dbname=webapp;charset=utf8;';
$user = 'naoki';
$password = 'password';

try {
  $db = new PDO($dsn, $user, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo '接続失敗: ' . $e->getMessage();
  exit();
}