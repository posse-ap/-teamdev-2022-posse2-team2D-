<?php
require(dirname(__FILE__) . "/dbconnect.php");
// $delete = $_GET['delete'];
// echo $delete;

$delete = $_GET['delete'];
// $stmt_delete = $db->prepare("delete from users where name = '$delete'");
// $stmt_delete->execute();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../reset.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <div class="header_top">
      <h1>管理者画面</h1>
      <form method="get" action="">

        <input type="submit" name="btn_logout" value="ログアウト">
      </form>
    </div>
    <div class="header_bottom">
      <ul>
        <li><a href="../top.php">トップ</a></li>
        <li><a href="../admin_student/index.php">ユーザー管理</a></li>
        <li><a href="../admin_company/index.php">企業管理</a></li>
        <li><a href="../admin_submit/index.php">新規エージェンシー</a></li>
      </ul>
    </div>
  </header>
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
    <form action="delete.php" method="get">
      <!-- <input type="hidden" value="<?= $delete; ?>" name="delete"> -->
      <input type="hidden" value="<?= $delete; ?>" name="delete">
      <input type="submit" value="はい" class="yes">
    </form>
    <input type="button" value="いいえ" class="no" onclick="history.back()">
  </section>
</body>

</html>