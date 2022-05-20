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

// if (!isset($_GET['search_name'])):
//   $apply_info_stmt = $db->prepare("SELECT * FROM apply_info");
//   $apply_info_stmt->execute();
//   $apply_infos = $apply_info_stmt->fetchAll();
// elseif (strlen($_GET['search_name']) == 0) :
//   $apply_info_stmt = $db->prepare("SELECT * FROM apply_info");
//   $apply_info_stmt->execute();
//   $apply_infos = $apply_info_stmt->fetchAll();
// else :
//   $search_n = $_GET['search_name'];
//   $apply_info_stmt = $db->prepare("SELECT * FROM apply_info WHERE name = '$search_n'");
//   $apply_info_stmt->execute();
//   $apply_infos = $apply_info_stmt->fetchAll();
// endif;

// echo $search_n;
// echo $search_c;

// if (!isset($_GET['search_company'])) :
//   $apply_info_stmt = $db->prepare("SELECT * FROM agent_user JOIN apply_info ON agent_user.user_id=apply_info.id JOIN agent ON agent_user.agent_id=agent.id ");
//   $apply_info_stmt->execute();
//   $apply_infos_c = $apply_info_stmt->fetchAll();
// elseif (strlen($_GET['search_company']) == 0) :
//   $apply_info_stmt = $db->prepare("SELECT * FROM agent_user JOIN apply_info ON agent_user.user_id=apply_info.id JOIN agent ON agent_user.agent_id=agent.id ");
//   $apply_info_stmt->execute();
//   $apply_infos_c = $apply_info_stmt->fetchAll();
// else :
//   $search_c = $_GET['search_company'];
//   $apply_info_stmt = $db->prepare("SELECT * FROM agent_user JOIN apply_info ON agent_user.user_id=apply_info.id JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$search_c'");
//   $apply_info_stmt->execute();
//   $apply_infos = $apply_info_stmt->fetchAll();
// endif;

//二つ合わせたやつ
// if (!isset($_GET['search_name']) or !isset($_GET['search_company'])):
//   $apply_info_stmt = $db->prepare("SELECT * FROM agent_user JOIN apply_info ON agent_user.user_id=apply_info.id JOIN agent ON agent_user.agent_id=agent.id");
//   $apply_info_stmt->execute();
//   $apply_infos = $apply_info_stmt->fetchAll();
// elseif (strlen($_GET['search_name']) == 0 or strlen($_GET['search_company']) == 0) :
//   $apply_info_stmt = $db->prepare("SELECT * FROM agent_user JOIN apply_info ON agent_user.user_id=apply_info.id JOIN agent ON agent_user.agent_id=agent.id");
//   $apply_info_stmt->execute();
//   $apply_infos = $apply_info_stmt->fetchAll();
// else :
//   $search_n = $_GET['search_name'];
//   $search_c = $_GET['search_company'];
//   $apply_info_stmt = $db->prepare("SELECT * FROM agent_user JOIN apply_info ON agent_user.user_id=apply_info.id JOIN agent ON agent_user.agent_id=agent.id WHERE name = ? and agent_name = ?");
//   $apply_info_stmt -> bindValue(1, $search_n, PDO::PARAM_STR);
//   $apply_info_stmt -> bindValue(2, $search_c, PDO::PARAM_STR);
//   $apply_info_stmt->execute();
//   $apply_infos = $apply_info_stmt->fetchAll();
// endif;


if (isset($_GET['search_name']) && strlen($_GET['search_company']) == 0) :
  $search_n = $_GET['search_name'];
  $apply_info_stmt = $db->prepare("SELECT * FROM apply_info WHERE name = '$search_n'");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_company']) && strlen($_GET['search_name']) == 0) :
  $search_c = $_GET['search_company'];
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$search_c'");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_name']) && isset($_GET['search_company'])) :
  if (strlen($_GET['search_name']) == 0 or strlen($_GET['search_company']) == 0) :
    $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id");
    $apply_info_stmt->execute();
    $apply_infos = $apply_info_stmt->fetchAll();
  else :
    $search_n = $_GET['search_name'];
    $search_c = $_GET['search_company'];
    $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE name = ? and agent_name = ?");
    $apply_info_stmt->bindValue(1, $search_n, PDO::PARAM_STR);
    $apply_info_stmt->bindValue(2, $search_c, PDO::PARAM_STR);
    $apply_info_stmt->execute();
    $apply_infos = $apply_info_stmt->fetchAll();
  endif;
// elseif (strlen($_GET['search_name']) == 0 && strlen($_GET['search_company']) == 0) :
//   $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id");
//   $apply_info_stmt->execute();
//   $apply_infos = $apply_info_stmt->fetchAll();
else :
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
endif;

// var_dump($apply_infos);


if (!isset($_GET['search_name'])) :
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info");
  $info_num_stmt->execute();
  $info_nums = $info_num_stmt->fetchAll();
elseif (strlen($_GET['search_name']) == 0) :
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info");
  $info_num_stmt->execute();
  $info_nums = $info_num_stmt->fetchAll();
else :
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info WHERE name = '$search_n'");
  $info_num_stmt->execute();
  $info_nums = $info_num_stmt->fetchAll();
endif;


if(strlen($_GET['search_company']) == 0 && strlen($_GET['search_name']) == 0){
  $apply_info_stmt = $db->prepare("SELECT * FROM apply_info");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
}