<?php
session_start();
require('../dbconnect.php');

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
        $_SESSION['password'] = $user['password'];
        $_SESSION['time'] = time();
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/top.php');
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
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <header>
        <h1>就活の教科書 <span>クライアント画面</span></h1>
    </header>

    <section class="login">
        <form action="../client/login.php" method="POST" class="login-container">
            <p><input type="email" name="email" placeholder="Email" required></p>
            <p><input type="password" name="password" placeholder="Password" required></p>
            <?php if($user == []): ?>
            <span>ログインに失敗しました。正しくご記入ください。</span>
            <?php endif; ?>
            <p><input type="submit" value="Log in"></p>
            <p><a href="../client/pas_reset.php">パスワードをお忘れの方はこちら</a></p>
        </form>
    </section>

</body>

</html>