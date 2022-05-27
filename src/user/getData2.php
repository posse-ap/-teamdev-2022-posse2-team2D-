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
$stmt_tagdos = $db->prepare("SELECT * FROM agent_tag JOIN agent ON agent.id = agent_tag.agent_id RIGHT JOIN tag ON tag.id = agent_tag.tag_id where agent_name='$agent'");
$stmt_tagdos->execute(array($agent));
$tagList = array();
$row2 = $stmt_tagdos->fetchAll(PDO::FETCH_ASSOC);
foreach($row2 as $value):
 $tagList[]=array(
  'id' =>$value['id'],
  'tag' =>$value['tag_name'],
  // 'five'=>$row['publisher_five']+row['decision_five']+$row['speed_five']+$row['registstrant_five']+$row['place_five']
 );
endforeach;
header("Content-type: application/json; charset=UTF-8");
echo json_encode($tagList);
// $stmt_taguno = $db->prepare('SELECT * FROM agent_tag JOIN agent ON agent.id = agent_tag.agent_id RIGHT JOIN tag ON tag.id = agent_tag.tag_id where agent_name=$agent');
// $stmt_taguno->execute(array($agent));
// $tagList = array();
// while($row = $stmt_uno->fetch(PDO::FETCH_ASSOC)){
//  $tagList[]=array(
//   'tag' =>$row['tag_name'],
//  );
// }echo json_encode($tagList);
