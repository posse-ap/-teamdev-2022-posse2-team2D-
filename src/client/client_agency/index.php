<?php
session_start();
// require('./dbconnect.php');
if (isset($_GET['btn_logout'])) {
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

<?php
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
?>

<?php

// var_dump($users_infos);


if (!isset($_GET['search_name'])) :
$users_info_stmt = $db->prepare("SELECT * FROM users WHERE agent_id=? and id!=?");
// $users_info_stmt = $db->prepare("SELECT * FROM users WHERE agent_id=?");
$users_info_stmt->bindValue(1, $_SESSION['agent_id'], PDO::PARAM_STR);
$users_info_stmt->bindValue(2, $_SESSION['user_id'], PDO::PARAM_STR);
$users_info_stmt->execute();
$users_infos = $users_info_stmt->fetchAll();

$users_num_stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE agent_id=? and id!=?");
// $users_num_stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE agent_id=?");
$users_num_stmt->bindValue(1, $_SESSION['agent_id'], PDO::PARAM_STR);
$users_num_stmt->bindValue(2, $_SESSION['user_id'], PDO::PARAM_STR);
$users_num_stmt->execute();
$users_nums = $users_num_stmt->fetchAll();

elseif (strlen($_GET['search_name']) == 0) :
$users_info_stmt = $db->prepare("SELECT * FROM users WHERE agent_id=? and id!=?");
// $users_info_stmt = $db->prepare("SELECT * FROM users WHERE agent_id=?");
$users_info_stmt->bindValue(1, $_SESSION['agent_id'], PDO::PARAM_STR);
$users_info_stmt->bindValue(2, $_SESSION['user_id'], PDO::PARAM_STR);
$users_info_stmt->execute();
$users_infos = $users_info_stmt->fetchAll();

$users_num_stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE agent_id=? and id!=?");
// $users_num_stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE agent_id=?");
$users_num_stmt->bindValue(1, $_SESSION['agent_id'], PDO::PARAM_STR);
$users_num_stmt->bindValue(2, $_SESSION['user_id'], PDO::PARAM_STR);
$users_num_stmt->execute();
$users_nums = $users_num_stmt->fetchAll();

else :
$search = $_GET['search_name'];
$users_info_stmt = $db->prepare("SELECT * FROM users WHERE name = '$search' and agent_id=? and id!=?");
// $users_info_stmt = $db->prepare("SELECT * FROM users WHERE name = '$search' and agent_id=?");
$users_info_stmt->bindValue(1, $_SESSION['agent_id'], PDO::PARAM_STR);
$users_info_stmt->bindValue(2, $_SESSION['user_id'], PDO::PARAM_STR);
$users_info_stmt->execute();
$users_infos = $users_info_stmt->fetchAll();

$users_num_stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE name = '$search' and agent_id=? and id!=?");
// $users_num_stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE name = '$search' and agent_id=?");
$users_num_stmt->bindValue(1, $_SESSION['agent_id'], PDO::PARAM_STR);
$users_num_stmt->bindValue(2, $_SESSION['user_id'], PDO::PARAM_STR);
$users_num_stmt->execute();
$users_nums = $users_num_stmt->fetchAll();
    
endif;
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
        <?php foreach ($users_nums as $key => $user_num) { ?>
            <h3>件数 :<span><?Php echo $user_num["COUNT(*)"] ?></span></h3>
        <?php } ?>
    </div>

    <div class="student_search">
        <form method="get" action="index.php" class="search_container">
            <input class="search_space" type="text" size="25" placeholder="氏名(フルネーム)" name="search_name">
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
                        <th scope="col" class="middle">お名前</th>
                        <th scope="col">部署名</th>
                        <th scope="col" class="wide">メールアドレス</th>
                        <th scope="col">電話番号</th>
                        <th scope="col" class="narrow">削除</th>
                    </tr>
                </thead>
                <?php foreach ($users_infos as $key => $users_info) { ?>
                    <tbody>
                        <tr>
                            <th><?php echo $users_info["name"] ?></th>
                            <td class="price"><?php echo $users_info["department_name"] ?></td>
                            <td class="price"><?php echo $users_info["email"] ?></td>
                            <td class="price"><?php echo $users_info["tel"] ?></td>
                            <!-- <td class="price"><a href="../admin_edit/delete.html"><img src="../img/iconmonstr-trash-can-9-240.png" alt=""></a></td> -->
                            <td class="price">
                                <form action="select.php" method="get">
                                    <input type="image" src="../img/iconmonstr-trash-can-9-240.png" class="trash-can">
                                    <input type="hidden" value="<?= $users_info['name']; ?>" name="delete">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>

    <button><a href="../client_add/index.php">エージェンシー追加</a></button>

</body>

</html>