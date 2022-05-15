<?php
$dsn = 'mysql:host=db;dbname=shukatsu;charset=utf8;';
$user = 'root';
$password = 'password';

try{
  $pdo = new PDO($dsn,$user,$password,[
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,//連想配列
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//例外
    PDO::ATTR_EMULATE_PREPARES => false,//SQLインジェクション対策
  ]);
  echo '接続成功';
}catch(PDOException $e){
  echo '接続失敗' ,$e->getMessage() . "\n";
  exit();
}



// $stmt_shuffle = $pdo->prepare('select publisher_five from agent where agent_name=:name ');
// $stmt_shuffle->bindValue('name',$cnt["agent_name"],PDO::PARAM_STR);
// $stmt_shuffle->execute();
// $shuffles = $stmt_shuffle->fetchAll();

?>

<?php
if (!isset($_GET['narrow'])) :
  if (!isset($_GET['search'])) :
    // require(dirname(__FILE__) . "/dbconnect.php");
    $shuffle = isset($_GET['shuffle']) ? $_GET['shuffle'] : 'agent_name';
// $shuffle = 'agent_name';
$cnt_stmt = $pdo->prepare("select * from agent order by $shuffle desc");
$cnt_stmt->execute();
$cnts = $cnt_stmt->fetchAll();
    else :
      $search = $_GET['search'];
      $cnt_stmt = $pdo->prepare("select * from agent where agent_name like '$search'");
      $cnt_stmt->execute();
      $cnts = $cnt_stmt->fetchAll();
    endif;
  else :
        // ini_set('display_errors', 1);
        $narrows = $_GET['narrow'];
        $inClause = substr(str_repeat(',?',count($narrows)),1);
        $shuffle = isset($_GET['shuffle']) ? $_GET['shuffle'] : 'agent_name';
          // echo $narrow;
          $cnt_stmt = $pdo->prepare(sprintf("select * from agent_tag join agent on agent.id = agent_tag.agent_id right join tag on tag.id = agent_tag.tag_id where tag_name in (%s) order by $shuffle desc",$inClause));
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

// $names = array('taro', 'yuta', 'makoto');

// $inClause = substr(str_repeat(',?', count($names)), 1);

// $stmt = $pdo->prepare(sptinrf('
// select * from user where name in (%s)
// ', $inClause));

// $stmt->execute($names);
// $stmt->fetchAll();

?>