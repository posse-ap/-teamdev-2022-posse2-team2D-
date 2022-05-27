<?php
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

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin_student/index.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}
?>

<?php
// $apply_info_stmt = $db->prepare("SELECT * FROM apply_info");
// $apply_info_stmt->execute();
// $apply_infos = $apply_info_stmt->fetchAll();
// var_dump($apply_info);

// $info_num_stmt = $db->prepare("SELECT COUNT(*) FROM apply_info");
// $info_num_stmt->execute();
// $info_nums = $info_num_stmt->fetchAll();
// var_dump($info_num)
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
        </div>
        <div class="header_bottom">
            <ul>
                <li><a href="../top.php" class="page_focus">トップ</a></li>
                <li><a href="../admin_student/index.php">お申込履歴</a></li>
                <li><a href="../admin_company/index.php">企業管理</a></li>
                <li><a href="../admin_submit/index.php">新規エージェンシー</a></li>
            </ul>
        </div>
    </header>

    <div class="page to-cart">
        <p>
            <a href="../top.php">トップ</a>
            <span>></span>
            <span class="page_current">お申込履歴</span>
        </p>
    </div>


    <div class="section_header">
        <form class="search_container" method="get" action="index.php">
            <input class="search_space" type="text" placeholder="学生氏名 (フルネーム)" name="search_name">
            <input class="search_space" type="text" placeholder="企業名を入力してください" name="search_company">
            <input class="search_space" type="date" placeholder="年月日検索 (○○○○/○○/○○)" name="search_date">
            <input class="search_button" type="submit" value="検索">
        </form>
        <form action="index.php">
            <button type="submit" class="clear">クリア</button>
        </form>
        <div>
            <?php foreach ($info_nums as $key => $info_num) { ?>
                <h3>件数 :<span><?php echo $info_num["COUNT(*)"] ?></span></h3>
            <?php } ?>
        </div>
    </div>

    <div class="section_main">
        <div class="wrap">
            <table>
                <thead>
                    <tr>
                        <th scope="col" class="middle">お名前</th>
                        <th scope="col" class="wide">メールアドレス</th>
                        <th scope="col">電話番号</th>
                        <!-- <th scope="col">大学名</th>
                        <th scope="col">学部学科</th> -->
                        <!-- <th scope="col" class="narrow">卒業年</th> -->
                        <th scope="col" class="wide">住所</th>
                        <th scope="col" class="wide">お申し込み日</th>
                        <th scope="col" class="wide">ユーザー詳細</th>
                        <th scope="col" class="narrow">削除</th>
                    </tr>
                </thead>
                <?php foreach ($apply_infos as $key => $apply_info) {
                    $theDate    = new DateTime($apply_info["created_at"]);
                    $stringDate = $theDate->format('Y-m-d');

                ?>
                    <tbody>
                        <tr>
                            <th><?php echo $apply_info["name"] ?></th>
                            <td class="price"><?php echo $apply_info["email"] ?></td>
                            <td class="price"><?php echo $apply_info["tel"] ?></td>
                            <!-- <td class="price"><?php echo $apply_info["college"] ?></td>
                            <td class="price"><?php echo $apply_info["faculty"] ?></td> -->
                            <!-- <td class="price"><?php echo $apply_info["graduate_year"] ?></td> -->
                            <td class="price"><?php echo $apply_info["adress"] ?></td>
                            <td class="price"><?= $apply_info["created_at"]; ?></td>
                            <td class="price">
                                <form action="../admin_student/detail.php" method="get">
                                    <input type="submit" value="詳細">
                                    <input type="hidden" value="<?= $apply_info['name']; ?>" name="user">
                                </form>
                            </td>
                            <td class="price">
                                <form action="select.php" method="get">
                                    <input type="image" src="../img/iconmonstr-trash-can-9-240.png" class="trash-can">
                                    <input type="hidden" value="<?= $apply_info['id'] ?>" name="deleteAll">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>

    <!-- <footer>
        <button id="prev" class="day_back" onclick="prev()"></button>
        <h1 id="page_number">1</h1>
        <button id="next" class="day_front" onclick="next()"></button>
    </footer> -->

</body>

<script src="script.js"></script>

</html>