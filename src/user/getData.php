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
$agent = $_POST['agent'];
$stmt_uno = $db->prepare("select * from agent where agent_name='$agent'");
$stmt_uno->execute(array($agent));
$memberList = array();
while($row = $stmt_uno->fetch(PDO::FETCH_ASSOC)){
 $memberList[]=array(
  'id' =>$row['id'],
  'names'=>$row['agent_name'],
  'company'=>$row['publisher'],
  'decision'=>$row['decision'],
  'speed'=>$row['speed'],
  'regist'=>$row['registstrant'],
  'place'=>$row['place'],
  'company_five'=>$row['publisher_five'],
  'decision_five'=>$row['decision_five'],
  'speed_five'=>$row['speed_five'],
  'regist_five'=>$row['registstrant_five'],
  'place_five'=>$row['place_five'],
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
echo json_encode($memberList);





