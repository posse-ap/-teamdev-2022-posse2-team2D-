<?php
session_start();
require('../dbconnect.php');
echo $_SESSION['reset_mail'];
$reset_mail = $_SESSION['reset_mail'];
$new_password = sha1($_POST['new']);
if (!empty($_POST)) {
    if (sha1($_POST['new']) == sha1($_POST['new_check'])) {
        $stmt = $db->prepare('UPDATE `users` SET password=? WHERE `mail`=?');
        $stmt->bindValue(1, $new_password, PDO::PARAM_STR);
        $stmt->bindValue(2, $reset_mail, PDO::PARAM_STR);
        $stmt->execute();
        // header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/login.php');
        exit();
    } else {
        echo '確認用と一致しませんでした';
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>パスワード変更画面です</h1>
    <section class="login">
        <form action="../client/reset.php" method="POST" class="login-container">
            <p>新しいパスワード</p>
            <p><input type="password" name="new" placeholder="Password" required></p>
            <p>新しいパスワード(確認)</p>
            <p><input type="password" name="new_check" placeholder="Password" required></p>
            <p><input type="submit" value="確定"></p>
        </form>
        <!-- <p>パスワードを変更すると自動的にログアウトします<br><br>新しいパスワードでログインし直してください</p> -->
    </section>
</body>

</html>