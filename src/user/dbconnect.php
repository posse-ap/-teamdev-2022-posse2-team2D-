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
};

if (!isset($_GET['narrow'])) :
  if (!isset($_GET['search'])) :
    // require(dirname(__FILE__) . "/dbconnect.php");
    $shuffle = isset($_GET['shuffle']) ? $_GET['shuffle'] : 'agent_name';
    // $shuffle = 'agent_name';
    $cnt_stmt = $db->prepare("select * from agent order by $shuffle desc");
    $cnt_stmt->execute();
    $cnts = $cnt_stmt->fetchAll();
    elseif (strlen($_GET['search']) == 0):
      $shuffle = isset($_GET['shuffle']) ? $_GET['shuffle'] : 'agent_name';
      // $shuffle = 'agent_name';
      $cnt_stmt = $db->prepare("select * from agent order by $shuffle desc");
      $cnt_stmt->execute();
      $cnts = $cnt_stmt->fetchAll();
  else :
    $search = $_GET['search'];
    $sea = '%' . $search . '%';
    $cnt_stmt = $db->prepare("select * from agent where agent_name like '$sea'");
    $cnt_stmt->execute();
    $cnts = $cnt_stmt->fetchAll();
  endif;
else :
  // ini_set('display_errors', 1);
  $narrows = $_GET['narrow'];
  $inClause = substr(str_repeat(',?', count($narrows)), 1);
  $shuffle = isset($_GET['shuffle']) ? $_GET['shuffle'] : 'agent_name';
  // echo $narrow;
  $cnt_stmt = $db->prepare(sprintf("select distinct agent.* from agent inner join agent_tag on agent.id = agent_tag.agent_id inner join tag on tag.id = agent_tag.tag_id where tag_name in (%s) order by $shuffle desc", $inClause));
  $cnt_stmt->execute($narrows);
  $cnts = $cnt_stmt->fetchAll();
// foreach ($cnts as $cnt) :
//   var_dump($cnt);
// endforeach;
// foreach($cnts as $cnt):
//   // echo $id;
//   echo $cnt['agent_name'];

// var_dump($cnts) . '<br>';
endif;

if (!isset($_GET['narrow'])) :
    // require(dirname(__FILE__) . "/dbconnect.php");
    $shuffle = isset($_GET['shuffle']) ? $_GET['shuffle'] : 'agent_name';
    // $shuffle = 'agent_name';
    $$cnt_all = $db->prepare("select * from agent order by $shuffle desc");
    $$cnt_all->execute();
    $alls = $$cnt_all->fetchAll();
else :
  // ini_set('display_errors', 1);
  $narrows = $_GET['narrow'];
  $inClause = substr(str_repeat(',?', count($narrows)), 1);
  $shuffle = isset($_GET['shuffle']) ? $_GET['shuffle'] : 'agent_name';
  // echo $narrow;
  $$cnt_all = $db->prepare(sprintf("select distinct agent.* from agent inner join agent_tag on agent.id = agent_tag.agent_id inner join tag on tag.id = agent_tag.tag_id where tag_name in (%s) order by $shuffle desc", $inClause));
  $$cnt_all->execute($narrows);
  $alls = $$cnt_all->fetchAll();
// foreach ($$all as $cnt) :
//   var_dump($cnt);
// endforeach;
// foreach($cnts as $cnt):
//   // echo $id;
//   echo $cnt['agent_name'];

// var_dump($cnts) . '<br>';
endif;