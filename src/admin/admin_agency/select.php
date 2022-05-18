<?php
require(dirname(__FILE__) . "/dbconnect.php");
// $delete = $_GET['delete'];
// echo $delete;

$delete = $_GET['delete'] ;
$stmt_delete = $db->prepare("delete from users where name = '$delete'");
$stmt_delete->execute();
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
<div class="page to-cart">
        <p>
        <a href="#" onclick="history.go(-2)">トップ</a>
        <span>></span>
        <a href="#" onclick="history.back()">企業情報</a>
        <span>></span>
        <span class="page_current">企業情報削除</span>
        </p>
    </div>
  <section class="delete">
    <p>本当に削除しますか？</p>
    <form action="index.php" method="get">
      <!-- <input type="hidden" value="<?= $delete; ?>" name="delete"> -->
      <input type="hidden" value="<?= $delete;?>" name="agent">
      <input type="submit" value="はい" class="yes">
    </form>
      <input type="submit" value="いいえ" class="no" onclick="history.back()">
  </section>
</body>

</html>