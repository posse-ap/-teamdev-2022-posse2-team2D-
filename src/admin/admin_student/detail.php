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

$user =  $_GET['user'];

$apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE name='$user'");
$apply_info_stmt->execute();
$apply_infos = $apply_info_stmt->fetchAll();
// var_dump($apply_infos);

$apply_companies_stmt = $db->prepare("SELECT distinct agent.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE name='$user'");
$apply_companies_stmt->execute();
$apply_companies = $apply_companies_stmt->fetchAll();
// var_dump($apply_companies);


$theDate    = new DateTime($apply_infos[0]["created_at"]);
$stringDate = $theDate->format('Y-m-d');

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
            <a href="../admin_student/index.php">お申込履歴</a>
            <span>></span>
            <span class="page_current">ユーザー詳細</span>
        </p>
    </div>

    <section class="detail_main">
        <div class="section_main2">
            <h2>学生学生情報</h2>
            <div class="wrap2">
                <table class="info">
                    <tr>
                        <th class="">お名前</th>
                        <td class="">
                            <h3><?= $apply_infos['0']['name']; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <th class="">カナ</th>
                        <td class="">
                            <h3><?= $apply_infos['0']['kana']; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <th class="">Tel</th>
                        <td class="">
                            <h3><?= $apply_infos['0']['tel']; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <th class="">mail</th>
                        <td class="">
                            <h3><?= $apply_infos['0']['email']; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <th class="">大学名</th>
                        <td class="">
                            <h3><?= $apply_infos['0']['college']; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <th class="">学部・学科</th>
                        <td class="">
                            <h3><?= $apply_infos['0']['faculty']; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <th class="">卒業年</th>
                        <td class="">
                            <h3><?= $apply_infos['0']['graduate_year']; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <th class="">住所</th>
                        <td class="">
                            <h3><?= $apply_infos['0']['adress']; ?></h3>
                        </td>
                    </tr>
                    <tr>
                        <th class="">お申し込み日</th>
                        </th>
                        <td class="">
                            <h3><?= $stringDate; ?></h3>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="section_main">
            <h2>申込み企業</h2>
            <div class="wrap">
                <table>
                    <thead>
                        <tr>
                            <!-- <img src="../img/iconmonstr-trash-can-9-240.png" alt=""> -->
                            <th scope="col" class="wide">企業名</th>
                            <th scope="col" class="widest">自由記入欄</th>
                            <th scope="col" class="narrow">削除</th>
                        </tr>
                    </thead>
                    <tbody>
                        <? foreach ($apply_companies as $apply_company) : ?>
                            <tr>
                                <td><?= $apply_company['agent_name']; ?></td>
                                <td><?= $apply_infos['0']['free']; ?></td>
                                <td class="price">
                                    <form action="select.php" method="post">
                                        <input type="image" src="../img/iconmonstr-trash-can-9-240.png" class="trash-can">
                                        <input type="hidden" value="<?= $apply_company['id']; ?>" name="delete">
                                        <input type="hidden" value="<?= $apply_infos['0']['id']; ?>" name="deleteUser">
                                    </form>
                                </td>
                                <!-- <img src="../img/iconmonstr-trash-can-9-240.png" alt=""> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</body>

</html>