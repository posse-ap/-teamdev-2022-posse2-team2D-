<?php
session_start();
// require('../dbconnect.php');
if(isset($_GET['btn_logout']) ) {
	unset($_SESSION['user_id']);
    unset($_SESSION['password']);
    unset($_SESSION['time']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/client_agency/index.php');
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

    <div class="number">
        <h3>件数 :<span>10</span></h3>
    </div>

    <div class="student_search">
    <form method="get" action="#" class="search_container">
        <input type="text" size="25" placeholder="氏名">
        <input type="submit" value="検索">
    </form>
    </div>

    <div class="section_main">
        <div class="wrap">
            <table>
                <thead>
                    <tr>
                        <th scope="col" class="middle">お名前</th>
                        <th scope="col">部署名</th>
                        <th scope="col" class="wide">メールアドレス</th>
                        <th scope="col">電話番号</th>
                        <th scope="col" class="narrow">削除</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>あああああああ</th>
                        <td class="price">人事部</td>
                        <td class="price">naoki1010nissy@gmail.com</td>
                        <td class="price">090-2066-9112</td>
                        <td class="price"><a href="../admin_edit/delete.html"><img src="../img/iconmonstr-trash-can-9-240.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <th>西山直輝</th>
                        <td class="price">人事部</td>
                        <td class="price">naoki1010nissy@gmail.com</td>
                        <td class="price">090-2066-9112</td>
                        <td class="price"><a href="../admin_edit/delete.html"><img src="../img/iconmonstr-trash-can-9-240.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <th>西山直輝</th>
                        <td class="price">人事部</td>
                        <td class="price">naoki1010nissy@gmail.com</td>
                        <td class="price">090-2066-9112</td>
                        <td class="price"><a href="../admin_edit/delete.html"><img src="../img/iconmonstr-trash-can-9-240.png" alt=""></a></td>
                    </tr>
                    <tr>
                        <th>西山直輝</th>
                        <td class="price">人事部</td>
                        <td class="price">naoki1010nissy@gmail.com</td>
                        <td class="price">090-2066-9112</td>
                        <td class="price"><a href="../admin_edit/delete.html"><img src="../img/iconmonstr-trash-can-9-240.png" alt=""></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <button>エージェンシー追加</button>
    
</body>
</html>