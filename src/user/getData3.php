<?php
session_start();
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
$agent2 = $_POST['agent2'];
$_SESSION['agent2'] = $agent2;
$stmt_uno2 = $db->prepare("select * from agent where agent_name='$agent2'");
$stmt_uno2->execute(array($agent2));
$memberList2 = array();
while($row4 = $stmt_uno2->fetch(PDO::FETCH_ASSOC)){
 $memberList2[]=array(
  'id' =>$row4['id'],
  'names'=>$row4['agent_name'],
  'company'=>$row4['publisher'],
  'decision'=>$row4['decision'],
  'speed'=>$row4['speed'],
  'regist'=>$row4['registstrant'],
  'place'=>$row4['place'],
  'company_five'=>$row4['publisher_five'],
  'decision_five'=>$row4['decision_five'],
  'speed_five'=>$row4['speed_five'],
  'regist_five'=>$row4['registstrant_five'],
  'place_five'=>$row4['place_five'],
  // 'five'=>$row['publisher_five']+row['decision_five']+$row['speed_five']+$row['registstrant_five']+$row['place_five']
 );
}

// $stmt_taguno = $db->prepare('SELECT * FROM agent_tag JOIN agent ON agent.id = agent_tag.agent_id RIGHT JOIN tag ON tag.id = agent_tag.tag_id where agent_name=$agent');
// $stmt_taguno->execute(array($agent));
// $tagList = array();
// while($row = $stmt_uno->fetch(PDO::FETCH_ASSOC)){
//  $tagList[]=array(
//   'tag' =>$row['tag_name'],
//  );
// }echo json_encode($tagList);
header("Content-type: application/json; charset=UTF-8");
echo json_encode($memberList2);