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

$agent_stmt = $db->prepare("SELECT * FROM agent ");
$agent_stmt->execute();
$agents = $agent_stmt->fetchAll();

//検索機能なし、表示だけ
// $apply_info_stmt = $db->prepare("SELECT * FROM apply_info");
// $apply_info_stmt->execute();
// $apply_infos = $apply_info_stmt->fetchAll();

//学生氏名検索機能のみ
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

//企業名検索機能のみ
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

//学生氏名・企業検索の二つ合わせたやつ
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

//日時検索
// $search_date_sra = $_GET['search_date'];
// $search_date = str_replace('/','-',$search_date_sra);
// $like = $search_date . '%';
// if (!isset($_GET['search_date'])) :
//   $apply_info_stmt = $db->prepare("SELECT * FROM agent_user JOIN agent ON agent.id = agent_user.agent_id RIGHT JOIN apply_info ON apply_info.id = agent_user.user_id");
//   $apply_info_stmt->execute();
//   $apply_infos =  $apply_info_stmt->fetchAll();
// elseif (strlen($_GET['search_date']) == 0) :
//   $apply_info_stmt = $db->prepare("SELECT * FROM agent_user JOIN agent ON agent.id = agent_user.agent_id RIGHT JOIN apply_info ON apply_info.id = agent_user.user_id");
//   $apply_info_stmt->execute();
//   $apply_infos =  $apply_info_stmt->fetchAll();
// else :
//   $apply_info_stmt = $db->prepare("SELECT * FROM agent_user JOIN agent ON agent.id = agent_user.agent_id RIGHT JOIN apply_info ON apply_info.id = agent_user.user_id where created_at like '$like'");
//   $apply_info_stmt->execute();
//   $apply_infos =  $apply_info_stmt->fetchAll();
// endif;

$search_date_sra = $_GET['search_date'];
$search_date = str_replace('/', '-', $search_date_sra);
$like = $search_date . '%';
if (isset($_GET['search_name']) && strlen($_GET['search_company']) == 0 && strlen($search_date) == 0) :
  $search_n = $_GET['search_name'];
  $sea_n = '%' . $search_n . '%';
  $apply_info_stmt = $db->prepare("SELECT * FROM apply_info WHERE name like '$sea_n' order by created_at desc");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_company']) && strlen($_GET['search_name']) == 0 && strlen($search_date) == 0) :
  $search_c = $_GET['search_company'];
  $sea_c = '%' . $search_c . '%';
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name like '$sea_c' order by created_at desc");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_name']) && isset($_GET['search_company']) && strlen($search_date) == 0) :
  $search_n = $_GET['search_name'];
  $search_c = $_GET['search_company'];
  $sea_n = '%' . $search_n . '%';
  $sea_c = '%' . $search_c . '%';
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE name like ? and agent_name like ? order by created_at desc");
  $apply_info_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(2, $sea_c, PDO::PARAM_STR);
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($search_date) && strlen($_GET['search_name']) == 0 && strlen($_GET['search_company']) == 0) :
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user JOIN agent ON agent.id = agent_user.agent_id RIGHT JOIN apply_info ON apply_info.id = agent_user.user_id where created_at like '$like' order by created_at desc");
  $apply_info_stmt->execute();
  $apply_infos =  $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_name']) && isset($search_date) && strlen($_GET['search_company']) == 0) :
  $search_n = $_GET['search_name'];
  $sea_n = '%' . $search_n . '%';
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE name like ? and created_at like ? order by created_at desc");
  $apply_info_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(2, $like, PDO::PARAM_STR);
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_company']) && isset($search_date) && strlen($_GET['search_name']) == 0) :
  $search_c = $_GET['search_company'];
  $sea_c = '%' . $search_c . '%';
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name like ? and created_at like ? order by created_at desc");
  $apply_info_stmt->bindValue(1, $sea_c, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(2, $like, PDO::PARAM_STR);
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_name']) && isset($_GET['search_company']) && isset($search_date)) :
  $search_n = $_GET['search_name'];
  $search_c = $_GET['search_company'];
  $sea_n = '%' . $search_n . '%';
  $sea_c = '%' . $search_c . '%';
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE name like ? and agent_name like ? and created_at like ? order by created_at desc");
  $apply_info_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(2, $sea_c, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(3, $like, PDO::PARAM_STR);
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
else :
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id order by created_at desc");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
endif;

if (strlen($_GET['search_company']) == 0 && strlen($_GET['search_name']) == 0 && strlen($search_date) == 0) {
  $apply_info_stmt = $db->prepare("SELECT * FROM apply_info order by created_at desc");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
}



//件数表示機能
// if (!isset($_GET['search_name'])) :
//   $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info");
//   $info_num_stmt->execute();
//   $info_nums = $info_num_stmt->fetchAll();
// elseif (strlen($_GET['search_name']) == 0) :
//   $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info");
//   $info_num_stmt->execute();
//   $info_nums = $info_num_stmt->fetchAll();
// else :
//   $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info WHERE name = '$search_n'");
//   $info_num_stmt->execute();
//   $info_nums = $info_num_stmt->fetchAll();
// endif;

// if (isset($_GET['search_name']) && strlen($_GET['search_company']) == 0) :
//   $search_n = $_GET['search_name'];
//   $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info WHERE name = '$search_n'");
//   $info_num_stmt->execute();
//   $info_nums = $info_num_stmt->fetchAll();
// elseif (isset($_GET['search_company']) && strlen($_GET['search_name']) == 0) :
//   $search_c = $_GET['search_company'];
//   $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$search_c'");
//   $info_num_stmt->execute();
//   $info_nums = $info_num_stmt->fetchAll();
// elseif (isset($_GET['search_name']) && isset($_GET['search_company'])) :
//   if (strlen($_GET['search_name']) == 0 or strlen($_GET['search_company']) == 0) :
//     $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id");
//     $info_num_stmt->execute();
//     $info_nums = $info_num_stmt->fetchAll();
//   else :
//     $search_n = $_GET['search_name'];
//     $search_c = $_GET['search_company'];
//     $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE name = ? and agent_name = ?");
//     $info_num_stmt->bindValue(1, $search_n, PDO::PARAM_STR);
//     $info_num_stmt->bindValue(2, $search_c, PDO::PARAM_STR);
//     $info_num_stmt->execute();
//     $info_nums = $info_num_stmt->fetchAll();
//   endif;
// else :
//   $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id");
//   $info_num_stmt->execute();
//   $info_nums = $info_num_stmt->fetchAll();
// endif;

// if (strlen($_GET['search_company']) == 0 && strlen($_GET['search_name']) == 0) {
//   $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info");
//   $info_num_stmt->execute();
//   $info_nums = $info_num_stmt->fetchAll();
// }

$search_date_sra = $_GET['search_date'];
$search_date = str_replace('/', '-', $search_date_sra);
$like = $search_date . '%';
if (isset($_GET['search_name']) && strlen($_GET['search_company']) == 0 && strlen($search_date) == 0) :
  $search_n = $_GET['search_name'];
  $sea_n = '%' . $search_n . '%';
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info WHERE name like '$sea_n'");
  $info_num_stmt->execute();
  $info_nums = $info_num_stmt->fetchAll();
elseif (isset($_GET['search_company']) && strlen($_GET['search_name']) == 0 && strlen($search_date) == 0) :
  $search_c = $_GET['search_company'];
  $sea_c = '%' . $search_c . '%';
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name like '$sea_c'");
  $info_num_stmt->execute();
  $info_nums = $info_num_stmt->fetchAll();
elseif (isset($_GET['search_name']) && isset($_GET['search_company']) && strlen($search_date) == 0) :
  $search_n = $_GET['search_name'];
  $search_c = $_GET['search_company'];
  $sea_n = '%' . $search_n . '%';
  $sea_c = '%' . $search_c . '%';
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE name like ? and agent_name like ?");
  $info_num_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
  $info_num_stmt->bindValue(2, $sea_c, PDO::PARAM_STR);
  $info_num_stmt->execute();
  $info_nums = $info_num_stmt->fetchAll();
elseif (isset($search_date) && strlen($_GET['search_name']) == 0 && strlen($_GET['search_company']) == 0) :
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info where created_at like '$like'");
  $info_num_stmt->execute();
  $info_nums =  $info_num_stmt->fetchAll();
elseif (isset($_GET['search_name']) && isset($search_date) && strlen($_GET['search_company']) == 0) :
  $search_n = $_GET['search_name'];
  $sea_n = '%' . $search_n . '%';
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE name like ? and created_at like ?");
  $info_num_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
  $info_num_stmt->bindValue(2, $like, PDO::PARAM_STR);
  $info_num_stmt->execute();
  $info_nums = $info_num_stmt->fetchAll();
elseif (isset($_GET['search_company']) && isset($search_date) && strlen($_GET['search_name']) == 0) :
  $search_c = $_GET['search_company'];
  $sea_c = '%' . $search_c . '%';
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name like ? and created_at like ?");
  $info_num_stmt->bindValue(1, $sea_c, PDO::PARAM_STR);
  $info_num_stmt->bindValue(2, $like, PDO::PARAM_STR);
  $info_num_stmt->execute();
  $info_nums = $info_num_stmt->fetchAll();
elseif (isset($_GET['search_name']) && isset($_GET['search_company']) && isset($search_date)) :
  $search_n = $_GET['search_name'];
  $search_c = $_GET['search_company'];
  $sea_n = '%' . $search_n . '%';
  $sea_c = '%' . $search_c . '%';
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE name like ? and agent_name like ? and created_at like ?");
  $info_num_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
  $info_num_stmt->bindValue(2, $sea_c, PDO::PARAM_STR);
  $info_num_stmt->bindValue(3, $like, PDO::PARAM_STR);
  $info_num_stmt->execute();
  $info_nums = $info_num_stmt->fetchAll();
else :
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id");
  $info_num_stmt->execute();
  $info_nums = $info_num_stmt->fetchAll();
endif;

if (strlen($_GET['search_company']) == 0 && strlen($_GET['search_name']) == 0 && strlen($search_date) == 0) {
  $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info");
  $info_num_stmt->execute();
  $info_nums = $info_num_stmt->fetchAll();
}
