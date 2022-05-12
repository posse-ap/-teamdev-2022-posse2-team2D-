<?php
session_start();
// require('./src/dbconnect.php');

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

        header('Location: http://' . $_SERVER['HTTP_HOST'] . 'src\admin\admin_top\index.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . 'src\admin\admin_login\index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

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
            <a href="../admin_login/index.html"><img src="../img/iconmonstr-log-out-16-240 (1).png" alt="">ログアウト</a>
        </div>
        <div class="header_bottom">
            <ul>
                <li><a href="../admin_top/index.html" class="page_focus">トップ</a></li>
                <li><a href="../admin_student/index.html">ユーザー管理</a></li>
                <li><a href="../admin_company/index.html">企業管理</a></li>
                <li><a href="../admin_submit/index.html">新規エージェンシー</a></li>
            </ul>
        </div>
    </header>
    <section>
        <h2>こちらは管理者画面です</h2>
        <div class="admin_buttons">
            <a href="../admin_student/index.html">学生管理<img src="../img/iconmonstr-school-23-240.png" alt=""></a>
            <a href="../admin_company/index.html">企業管理<img src="../img/iconmonstr-building-20-240.png" alt=""></a>
            <a href="../admin_submit/index.html">企業追加<img src="../img/iconmonstr-customer-9-240.png" alt=""></a>
        </div>
    </section>


</body>

</html>