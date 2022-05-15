<?php
session_start();
require('../dbconnect.php');
$error = [];
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        // $login = $db->prepare('SELECT * FROM users WHERE password=?');
        // $login->execute(array(
        //     sha1($_POST['now'])
        // ));
        // $user = $login->fetch();
    
        if ($_SESSION['password'] == sha1($_POST['now']) ) {
            // $_SESSION = array();
            // $_SESSION['user_id'] = $user['id'];
            // $_SESSION['time'] = time();
            $id = $_SESSION['user_id'];
            $new_password = sha1($_POST['new']);
            echo  $new_password;
            if (sha1($_POST['new']) == sha1($_POST['new_check'])){
                $stmt = $db->prepare('UPDATE `users` SET password=? WHERE `id`=?');
                $stmt->bindValue(1, $new_password, PDO::PARAM_STR);
                $stmt->bindValue(2, $id, PDO::PARAM_INT);
                $stmt->execute();
                unset($_SESSION['user_id']);
                unset($_SESSION['time']);
                unset($_SESSION['password']);
                // header("Location: " . $_SERVER['PHP_SELF']);
                // header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/pas_change.php');
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/login.php');
                exit();
            } else {
                $error['change'] = 'no_check';
                echo '確認用と一致しませんでした';
            }
            
            // header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/login.php');
        } else {
            $error['change'] = 'no_match';
            echo 'もとのパスワードと一致しませんでした';
        }
    }

} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/login.php');
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
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="top.css">
</head>
<body>

    <header>
        <div class="header_top">
            <h1>就活の教科書 <span>クライアント画面</span></h1>
            <nav>
                <a href="../client/top.php" class="page_focus">トップ</a>
                <a href="../client/cliant_agent/index.php">掲載情報</a>
                <a href="../client/cliant_student/index.php">個人情報</a>
                <a href="../client/client_agency/index.php">担当者管理</a>
                <a href="../client/client_add/index.php">担当者追加</a>
                <a href="../client/client_application/index.php">編集申請</a>
                <a href="../client/cliant_inquiry/index.php">お問い合わせ</a>
            </nav>
        </div>
        <div class="header_bottom">
            <form method="get" action="">
                <img src="../admin/img/iconmonstr-log-out-16-240 (1).png" alt="">
                <input type="submit" name="btn_logout" value="ログアウト">
            </form>
        </div>
    </header>

    <h1 class="pass_change">パスワード変更</h1>
    <section class="login">
        <form action="../client/pas_change.php" method="POST" class="login-container">
            <p>現在のパスワード</p>
            <p><input type="password" name="now" placeholder="Password" required></p>
            <p>新しいパスワード</p>
            <p><input type="password" name="new" placeholder="Password" required></p>
            <p>新しいパスワード(確認)</p>
            <p><input type="password"  name="new_check" placeholder="Password" required></p>
            <?php if(isset($error['change']) && $error['change'] === 'no_match' ): ?>
            <span>もとのパスワードと一致しませんでした</span>
            <?php endif; ?>
            <?php if(isset($error['change']) && $error['change'] === 'no_check'): ?>
            <span>確認用と一致しませんでした</span>
            <?php endif; ?>
            <p><input type="submit" value="確定"></p>
        </form>
        <p>パスワードを変更すると自動的にログアウトします<br><br>新しいパスワードでログインし直してください</p>
    </section>
</body>
</html>