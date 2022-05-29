<?php
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
session_name("admin");
session_start();
if (isset($_GET['btn_logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin_agency/index.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}
$agent = $_GET['agent'];
$_SESSION['agency_delete'] = $agent;
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
                <img src="../img/iconmonstr-log-out-16-240 (1).png" alt="">
                <input type="submit" name="btn_logout" value="ログアウト">
            </form>
        </div>
    <div class="header_bottom">
        <ul>
            <li><a href="../top.php">トップ</a></li>
            <li><a href="../admin_student/index.php">お申込履歴</a></li>
            <li><a href="../admin_company/index.php" class="page_focus">企業管理</a></li>
            <li><a href="../admin_submit/index.php">新規エージェンシー</a></li>
        </ul>
    </div>
</header>
    <div class="page to-cart">
        <p>
            <a href="../top.php">トップ</a>
            <span>></span>
            <a href="../admin_company/index.php">企業情報</a>
            <span>></span>
            <span class="page_current">企業担当者</span>
        </p>
    </div>

    <h2><?= $agent; ?>社 担当者情報</h2>

    <div class="section_header">
        <form class="search_container" method="get" action="index.php">
            <input class="search_space" type="text" placeholder="名前を入力してください" name="search">
            <input type="hidden" name='agent' value="<?= $_GET['agent']; ?>">
            <input class="search_button" type="submit" value="検索">
        </form>
        <form action="index.php">
            <input type="hidden" name='agent' value="<?= $_GET['agent']; ?>">
            <button type="submit" class="clear">クリア</button>
        </form>
        <!-- <div>
    <h3>件数 :<span>10</span></h3>
</div> -->
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
                        <th scope="col">担当者編集</th>
                        <th scope="col" class="narrow">削除</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cnts as $cnt) : ?>
                        <tr>
                            <td><?= $cnt['name']; ?></td>
                            <td class="price"><?= $cnt['department_name']; ?></td>
                            <td class="price"><?= $cnt['email']; ?></td>
                            <td class="price"><?= $cnt['tel']; ?></td>
                            <td class="price">
                                <form action="edit.php" method="get">
                                    <input type="submit" value="担当者編集">
                                    <input type="hidden" value="<?= $cnt['name']; ?>" name="edit">
                                </form>
                            </td>
                            <td>
                                <form action="select.php" method="get">
                                    <input type="image" src="../img/iconmonstr-trash-can-9-240.png" class="trash-can">
                                    <input type="hidden" value="<?= $cnt['id']; ?>" name="delete">
                                    <!-- <input type="hidden" value="<?= $agent; ?>" name="agent"> -->
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- <div>
        <h3>件数 :<span>10</span></h3>
    </div> -->
        </div>
        <!-- <footer>
    <button id="prev" class="day_back" onclick="prev()"></button>
    <h1 id="page_number">1</h1>
    <button id="next" class="day_front" onclick="next()"></button>
</footer> -->

</body>

</html>