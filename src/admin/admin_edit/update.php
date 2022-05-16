<?php
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
$name = $_POST['names'];
$image = $_POST['image'];
$link = $_POST['link'];
$publisher = $_POST['publisher'];
$speed = $_POST['speed'];
$decision= $_POST['decision'];
$registstrant = $_POST['registstrant'];
$place = $_POST['place'];
$agent = $_POST['agent'];

$stmt_agentid = $db->prepare("select id from agent where agent_name ='$agent'");
$stmt_agentid->execute();
$agentid = $stmt_agentid->fetch();
$aid = $agentid['id']; 

//deleteしてさらにinsert
$stmt_delete = $db->prepare("delete from agent_tag where agent_id = '$aid' ");
$stmt_delete->execute();

$tags = $_POST['tag'];
foreach ($tags as $tag) : 
$stmt_tag = $db->prepare("select id from tag where tag_name = '$tag'");
$stmt_tag->execute();
$tagid = $stmt_tag->fetch();
$tid = $tagid['id'];

$stmt_insert = $db->prepare("insert into agent_tag (agent_id,tag_id) value('$aid','$tid')");
$stmt_insert->execute();
endforeach; 


$stmt = $db->prepare("update agent set agent_name='$name',image='$image',link='$link',publisher='$publisher',speed='$speed',decision=$decision,registstrant='$registstrant',place='$place' where agent_name = '$agent'");
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <section class="delete">
      <!-- <input type="submit" value="戻る" class="no" onclick="history.back()"> -->
      <a href="../admin_company/index.php">戻る</a>
  </section>
</body>

</html>