<?php
session_name("client");
session_start();

// require('../dbconnect.php');
if (isset($_GET['btn_logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    unset($_SESSION['password']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/client_inquiry/index.php');
        exit();
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
    <link rel="stylesheet" href="../reset.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <div class="header_top">
            <h1>就活の教科書 <span>クライアント画面</span></h1>
            <nav>
                <a href="../top.php" class="top">トップ</a>
                <a href="../client_agent/index.php" class=" agent">掲載情報</a>
                <a href="../client_student/index.php" class="student">学生情報</a>
                <a href="../client_agency/index.php" class="manage">担当者管理</a>
                <a href="../client_add/index.php" class="agency">担当者追加</a>
                <a href="../client_application/index.php" class="editer">編集申請</a>
                <a href="../client_inquiry/index.php" class="call page_focus">お問い合わせ</a>
            </nav>
        </div>
        <div class="header_bottom">
            <form method="get" action="">

                <input type="submit" name="btn_logout" value="ログアウト">
            </form>
        </div>
    </header>

    <section>
        <h2>いたずら、重複を発見した方など<br>
            <span>boozerにお問い合わせがある方</span>
        </h2><br>
        <p>お手数ですが下記までご連絡ください。</p>
        <div class="info_box">
            <h3>電話番号:000-111-2221</h3>
            <h3>メールアドレス:nnn-nnnn@gmail.com</h3>
        </div>
        <p>⚠　迷惑ユーザー、重複の対応については、月末の翌日まで受け付けます</p>
    </section>

</body>

</html>