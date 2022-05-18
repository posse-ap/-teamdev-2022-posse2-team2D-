<?php
require(dirname(__FILE__) . "/dbconnect.php");
// session_start();
// // require('../dbconnect.php');
// if (isset($_GET['btn_logout'])) {
//     unset($_SESSION['user_id']);
//     unset($_SESSION['time']);
//     unset($_SESSION['password']);
//     // header("Location: " . $_SERVER['PHP_SELF']);
// }
// if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
//     $_SESSION['time'] = time();

//     if (!empty($_POST)) {
//         // $stmt = $db->prepare('INSERT INTO events SET title=?');
//         // $stmt->execute(array(
//         //     $_POST['title']
//         // ));

//         header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/top.php');
//         exit();
//     }
// } else {
//     header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/login.php');
//     exit();
// }
$name = $_POST['names'];
$image = $_POST['image'];
$link = $_POST['link'];
$publisher = $_POST['publisher'];
$speed = $_POST['speed'];
$decision = $_POST['decision'];
$registstrant = $_POST['registstrant'];
$place = $_POST['place'];
$main = $_POST['main'];
$sub = $_POST['sub'];
$agent = $_POST['agent'];

if ($decision < 10000) {
  $decision_five = 1;
} elseif ($decision < 25000) {
  $decision_five = 2;
} elseif ($decision < 40000) {
  $decision_five = 3;
} elseif ($decision < 60000) {
  $decision_five = 4;
} else {
  $decision_five = 5;
}

if ($publisher < 10000) {
  $publisher_five = 1;
} elseif ($publisher < 25000) {
  $publisher_five = 2;
} elseif ($publisher < 40000) {
  $publisher_five = 3;
} elseif ($publisher < 60000) {
  $publisher_five = 4;
} else {
  $publisher_five = 5;
}

if ($registstrant < 10000) {
  $registstrant_five = 1;
} elseif ($registstrant < 25000) {
  $registstrant_five = 2;
} elseif ($registstrant < 40000) {
  $registstrant_five = 3;
} elseif ($registstrant < 60000) {
  $registstrant_five = 4;
} else {
  $registstrant_five = 5;
}

if ($place < 5) {
  $place_five = 1;
} elseif ($place < 10) {
  $place_five = 2;
} elseif ($place < 15) {
  $place_five = 3;
} elseif ($place < 20) {
  $place_five = 4;
} else {
  $place_five = 5;
}

if ($speed < 5) {
  $speed_five = 1;
} elseif ($speed < 4) {
  $speed_five = 2;
} elseif ($speed < 3) {
  $speed_five = 3;
} elseif ($speed < 2) {
  $speed_five = 4;
} else {
  $speed_five = 5;
}

// $stmt_agentid = $db->prepare("select id from agent where agent_name ='$agent'");
// $stmt_agentid->execute();
// $agentid = $stmt_agentid->fetch();
// $aid = $agentid['id'];

// //deleteしてさらにinsert
// $stmt_delete = $db->prepare("delete from agent_tag where agent_id = '$aid' ");
// $stmt_delete->execute();

// $tags = $_POST['tag'];
// foreach ($tags as $tag) :
//   $stmt_tag = $db->prepare("select id from tag where tag_name = '$tag'");
//   $stmt_tag->execute();
//   $tagid = $stmt_tag->fetch();
//   $tid = $tagid['id'];

//   $stmt_insert = $db->prepare("insert into agent_tag (agent_id,tag_id) value('$aid','$tid')");
//   $stmt_insert->execute();
// endforeach;

// $stmt_copy = $db->prepare("select * into edit_agent from agent");
// $stmt_copy->execute();
// $stmt = $db->prepare("update agent set agent_name='$name',image='$image',link='$link',publisher_five='$publisher_five',speed_five='$speed_five',decision_five=$decision_five,registstrant_five='$registstrant_five',place_five='$place_five',publisher='$publisher',speed='$speed',decision=$decision,registstrant='$registstrant',place='$place' where agent_name = '$agent'");
// $stmt->execute();
$stmt_agentid = $db->prepare("select id from agent where agent_name ='$agent'");
$stmt_agentid->execute();
$agentid = $stmt_agentid->fetch();
$aid = $agentid['id'];
echo $aid;

$stmt_count = $db->prepare("select count(agent_name) from edit_agent where agent_name ='$agent'");
$stmt_count->execute();
$count = $stmt_count->fetch();



  $stmt = $db->prepare("insert into edit_agent(id,agent_name,image,link,publisher_five,decision_five,speed_five,registstrant_five,place_five,publisher,decision,speed,registstrant,place,main,sub) value('$aid','$name','$image','$link','$publisher_five','$decision_five','$speed_five','$registstrant_five','$place_five','$publisher','$decision','$speed','$registstrant','$place','$main','$sub')");
  $stmt->execute();


// $client = $_SESSION['agent_name'];



$stmt_delete = $db->prepare("delete from edit_agent_tag where agent_id = '$aid' ");
$stmt_delete->execute();

$tags = $_POST['tag'];
foreach ($tags as $tag) :
  $stmt_tag = $db->prepare("select id from tag where tag_name = '$tag'");
  $stmt_tag->execute();
  $tagid = $stmt_tag->fetch();
  $tid = $tagid['id'];
  echo $tid;

  $stmt_insert = $db->prepare("insert into edit_agent_tag(agent_id,tag_id) value('$aid','$tid')");
  $stmt_insert->execute();
endforeach;


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
    <form action="../top.php">
      <input type="submit" value="戻る">
    </form>
  </section>
</body>

</html>