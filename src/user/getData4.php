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
$agent2 = $_POST['agent2'];
$stmt_tagdos2 = $db->prepare("SELECT * FROM agent_tag JOIN agent ON agent.id = agent_tag.agent_id RIGHT JOIN tag ON tag.id = agent_tag.tag_id where agent_name='$agent2'");
$stmt_tagdos2->execute(array($agent2));
$tagList2 = array();
$row3 = $stmt_tagdos2->fetchAll(PDO::FETCH_ASSOC);
foreach($row3 as $value2):
 $tagList2[]=array(
  'id' =>$value2['id'],
  'tag' =>$value2['tag_name'],
  // 'five'=>$row['publisher_five']+row['decision_five']+$row['speed_five']+$row['registstrant_five']+$row['place_five']
 );
endforeach;
header("Content-type: application/json; charset=UTF-8");
echo json_encode($tagList2);

