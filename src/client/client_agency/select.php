<?php
session_start();
if (isset($_GET['btn_logout'])) {
  unset($_SESSION['user_id']);
  unset($_SESSION['time']);
  // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
  $_SESSION['time'] = time();

  if (!empty($_POST)) {
    $stmt = $db->prepare('INSERT INTO events SET title=?');
    $stmt->execute(array(
      $_POST['title']
    ));

    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/top.php');
    exit();
  }
} else {
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
  exit();
}
$delete = $_GET['delete'];
echo $delete;
?>

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
}
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
  <header>
    <div class="header_top">
      <h1>就活の教科書 <span>クライアント画面</span></h1>
      <nav>
        <a href="../top.php">トップ</a>
        <a href="../cliant_agent/index.php" class="page_focus">掲載情報</a>
        <a href="../cliant_student/index.php">個人情報</a>
        <a href="../client_agency/index.php">担当者管理</a>
        <a href="../client_add/index.php">担当者追加</a>
        <a href="../client_application/index.php">編集申請</a>
        <a href="../cliant_inquiry/index.php">お問い合わせ</a>
      </nav>
    </div>
    <div class="header_bottom">
      <form method="get" action="">
        <img src="../img/iconmonstr-log-out-16-240 (1).png" alt="">
        <input type="submit" name="btn_logout" value="ログアウト">
      </form>
    </div>
  </header>
  <section class="delete">
    <p>本当に削除しますか？</p>
    <form action="delete.php" method="get">
      <input type="hidden" value="<?= $delete; ?>" name="delete">
      <input type="submit" value="はい" class="yes">
    </form>
    <input type="submit" value="いいえ" class="no" onclick="history.back()">
  </section>
</body>

</html>