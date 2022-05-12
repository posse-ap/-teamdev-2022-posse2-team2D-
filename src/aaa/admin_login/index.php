<?php
session_start();
// require('');

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


if (!empty($_POST)) {
    $login = $db->prepare('SELECT * FROM users WHERE email=? AND password=?');
    $login->execute(array(
        $_POST['email'],
        sha1($_POST['password'])
    ));
    $user = $login->fetch();

    if ($user) {
        $_SESSION = array();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['time'] = time();
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '../admin_top/index.php');
        exit();
    } else {
        $error = 'fail';
    }
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
            <h1>管理者画面 ログインページ</h1>
        </div>
    </header>

    <!-- <section class="login">
        <form class="login-container">
            <p><input type="email" placeholder="Email"></p>
            <p><input type="password" placeholder="Password"></p>
            <p><input type="submit" value="Log in"><a href=""></a></p>
            <p><a href="../admin_top/index.html">パスワードをお忘れの方はこちら</a></p>
        </form>
    </section> -->

    <section class="login">
        <form action="../admin_login/index.php" method="POST" class="login-container">
            <p><input type="email" name="email" placeholder="Email" required></p>
            <p><input type="password" name="password" placeholder="Password" required></p>
            <?php if ($user == []) : ?>
                <span>ログインに失敗しました。正しくご記入ください。</span>
            <?php endif; ?>
            <p><input type="submit" value="Log in"></p>
            <p><a href="../admin_top/index.html">パスワードをお忘れの方はこちら</a></p>
        </form>
    </section>

</body>

</html>