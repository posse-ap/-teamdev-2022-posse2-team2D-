<?php
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
session_start();
if (isset($_GET['btn_logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin_company/index.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
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
            <li><a href="../admin_student/index.php">ユーザー管理</a></li>
            <li><a href="../admin_company/index.php" class="page_focus">企業管理</a></li>
            <li><a href="../admin_submit/index.php">新規エージェンシー</a></li>
        </ul>
    </div>
</header>
    <div class="page to-cart">
        <p>
            <a href="../top.php">トップ</a>
            <span>></span>
            <span class="page_current">企業情報</span>
        </p>
    </div>
    <div class="section_header">
        <form class="search_container" method="get" action="index.php">
            <input class="search_space" type="text" placeholder="企業名を入力してください" name="search">
            <input class="search_button" type="submit" value="検索">
        </form>
        <form action="index.php">
            <button type="submit" class="clear">クリア</button>
        </form>
    </div>

    <div class="section_main">
        <div class="wrap">
            <table>
                <thead>
                    <tr>
                        <th scope="col" class="wide">企業名</th>
                        <th scope="col">掲載期限</th>
                        <th scope="col" class="large">掲載情報を見る</th>
                        <th scope="col" class="large">編集する</th>
                        <th scope="col" class="large">請求情報確認</th>
                        <th scope="col" class="large">エージェンシー情報</th>
                        <th scope="col" class="narrow">削除</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($cnts as $cnt) :?>
                        <tr>
                            <th><?= $cnt['agent_name']; ?></th>
                            <td class="price">2022-10-10</td>
                            <td class="price">
                                <form action="../admin_agent/agent.php" method="get">
                                    <input type="submit" value="掲載情報">
                                    <input type="hidden" value="<?= $cnt['agent_name']; ?>" name="agent">
                                </form>
                            </td>
                            <td class="price">
                                <form action="../admin_edit/index.php" method="get">
                                    <input type="submit" value="編集する">
                                    <input type="hidden" value="<?= $cnt['agent_name']; ?>" name="agent">
                                </form>
                            </td>
                            <td class="price">
                                <form action="../admin_invoice/index.php" method="get">
                                    <input type="submit" value="請求情報">
                                    <input type="hidden" value="<?= $cnt['agent_name']; ?>" name="agent">
                                </form>
                            </td>
                            <td class="price">
                                <form action="../admin_agency/index.php" method="get">
                                    <input type="submit" value="担当者">
                                    <input type="hidden" value="<?= $cnt['agent_name']; ?>" name="agent">
                                </form>
                            </td>
                            <td class="price">
                                <form action="select.php" method="get">
                                    <input type="image" src="../img/iconmonstr-trash-can-9-240.png" class="trash-can">
                                    <input type="hidden" value="<?= $cnt['agent_name']; ?>" name="delete">
                                    <input type="hidden" value="<?= $cnt['agent_name']; ?> " name="delete">
                                    <input type="hidden" value="<?= $cnt['agent_name']; ?>" name="delete">
                                </form>
                            </td>
                            <!-- <img src="../img/iconmonstr-trash-can-9-240.png" alt=""> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- <footer>
    <button id="prev" class="day_back" onclick="prev()"></button>
    <h1 id="page_number">1</h1>
    <button id="next" class="day_front" onclick="next()"></button>
</footer>
-->

    <script src="script.js"></script>
</body>

</html>