<?php
session_name("client");
session_start();

require('../dbconnect.php');



if (isset($_POST['name'])) {
    // ファイルへのパス
    $path = './img/';
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];
    $department_name = $_POST['department_name'];
    $img = $_POST['img'];
    $stmt = $db->prepare('UPDATE `users` SET `name`=?, `department_name`=?, `tel`=?, `email`=?,`user_img`=? WHERE password=?');
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $department_name, PDO::PARAM_STR);
    $stmt->bindValue(3, $tel, PDO::PARAM_STR);
    $stmt->bindValue(4, $mail, PDO::PARAM_STR);
    $stmt->bindValue(5, $name, PDO::PARAM_STR);
    $stmt->bindValue(6, $_SESSION['password'], PDO::PARAM_STR);
    $stmt->execute();

    $file = './img/' .  $_SESSION['manager_name'] . '.png';
    if(file_exists($file)){
    rename($file, './img/' . $name . '.png');
    }

    // ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
    if (!empty($_FILES['img']['tmp_name']) && is_uploaded_file($_FILES['img']['tmp_name'])) {

        // ファイルを指定したパスへ保存する
        move_uploaded_file($_FILES['img']['tmp_name'], $path . $name . '.png');
    }
}

if (isset($_GET['btn_logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['password']);
    unset($_SESSION['time']);
    unset($_SESSION['agent_name']);
    unset($_SESSION['agent_id']);
    unset($_SESSION['manager_name']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/top.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/login.php');
    exit();
}

$stmt = $db->prepare(
    "SELECT 
        *
    FROM 
        users
    JOIN 
        agent ON users.agent_id = agent.id
    WHERE
        password=?"
);
$stmt->bindValue(1, $_SESSION['password'], PDO::PARAM_STR);
$stmt->execute();
$user_info = $stmt->fetch();


$_SESSION['agent_name'] = $user_info['agent_name'];
$_SESSION['agent_id'] = $user_info['agent_id'];
$_SESSION['manager_name'] = $user_info['name'];

$nowMonth = date('n');
date_default_timezone_set('Asia/Tokyo');
$agent =  $_SESSION['agent_name'];
$selectday = date('Y-m');
$like = $selectday . '%';
$stmt_count = $db->prepare("SELECT count(agent_name) FROM agent_user JOIN apply_info ON apply_info.id = agent_user.user_id JOIN agent ON agent.id = agent_user.agent_id  where agent_name = '$agent' and created_at like '$like'");
$stmt_count->execute();
$count = $stmt_count->fetch();
$student = $count['count(agent_name)'];

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>

<body>
    <header class="topHeader">
        <div class="header_top">
            <h1>就活の教科書 <span>クライアント画面</span></h1>
            <nav>
                <a href="../client/top.php" class="tops page_focus">トップ</a>
                <a href="../client/client_agent/index.php" class="agent">掲載情報</a>
                <a href="../client/client_student/index.php" class="student">学生情報</a>
                <a href="../client/client_agency/index.php" class="manage">担当者管理</a>
                <a href="../client/client_add/index.php" class="agency  ">担当者追加</a>
                <a href="../client/client_application/index.php" class="editer">編集申請</a>
                <a href="../client/client_inquiry/index.php" class="call ">お問い合わせ</a>
            </nav>
        </div>
        <div class="header_bottom">
            <form method="get" action="">
                <input type="submit" name="btn_logout" value="ログアウト">
            </form>
            <!-- <a href="../client_login/index.html">ログアウト</a> -->
        </div>
    </header>

    <section class="top">
        <div class="top_content">
            <h1>ようこそ！ <p><?php echo $user_info['agent_name'] ?></p> 様</h1>
            <div>
                <h3><span><?php echo $nowMonth ?></span>月の請求情報</h3>
            </div>
        </div>
        <section class="invoice_info">
            <h2>お申し込み学生数</h2>
            <h2 class="number"><span><?= $student; ?></span>人</h2>
            <h2>請求金額</h2>
            <h2 class="number"><span><?= $student * 5000; ?></span> 円</h2>
        </section>
    </section>

    <section>
        <div class="main_contents">
            <div class="content_left">
                <div class="client_content">
                    <div id="client_info" class="section_content">
                        <div class="client_info">
                            <h2>info.</h2>
                            <div class="info_content">
                                <p>氏名</p>
                                <h3><?= $user_info['name'] ?></h3>
                                <p>メールアドレス</p>
                                <h3><?= $user_info['email'] ?></h3>
                                <p>電話番号</p>
                                <h3><?= $user_info['5'] ?></h3>
                                <p>部署</p>
                                <h3><?= $user_info['department_name'] ?></h3>
                            </div>
                            <div>
                                <div class="client_img" style="background-image: url('<?= "./img/" . $user_info['name'] . ".png?" .  uniqid() ?>');"></div>
                                <button onclick="edit()">編集</button>
                                <a href="pas_change.php">パスワード変更はこちら</a>
                            </div>
                        </div>
                    </div>
                    <div id="client_edit" class="section_content2">
                        <!-- <div class="client_info"> -->
                        <form class="client_info2" action="../client/top.php" method="POST" enctype="multipart/form-data">
                            <h2>info.</h2>
                            <div>
                                <p>氏名</p>
                                <h3><input type="text" name="name" value="<?= $user_info['name'] ?>"></h3>
                                <p>メールアドレス</p>
                                <h3><input type="text" name="mail" value="<?= $user_info['email'] ?>"></h3>
                                <p>電話番号</p>
                                <h3><input type="text" name="tel" value="<?= $user_info['5'] ?>"></h3>
                                <p>部署</p>
                                <h3><input type="text" name="department_name" value="<?= $user_info['department_name'] ?>"></h3>
                            </div>
                            <div class="img_form">
                                <label style="background-image: url('<?= "./img/" . $user_info['name'] . ".png?" .  uniqid() ?>');">
                                    <img id="preview" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                                    <input id="inputFile" name="img" type="file" accept="image/jpeg, image/png" onchange="previewImage(this);">
                                </label>
                                <span>選択してください</span>
                                <!-- <button class="edit_button" onclick="save()"></button> -->
                                <input type="submit" value="確定">
                            </div>
                        </form>
                        <script>
                            function previewImage(obj) {
                                var fileReader = new FileReader();
                                fileReader.onload = (function() {
                                    document.getElementById('preview').src = fileReader.result;
                                });
                                fileReader.readAsDataURL(obj.files[0]);
                            }
                        </script>
                        <!-- </div> -->
                    </div>
                </div>

                <div class="client_buttons">
                    <button><a href="../client/client_add/index.php">新規担当者作成</a></button>
                </div>
                <div class="client_buttons">
                    <button><a href="../client/client_inquiry/index.php">お問い合わせはこちらから</a></button>
                </div>
            </div>

            <div class="content_right">
                <div class="page_buttons">
                    <a href="../client/client_agent/index.php"><img src="../client/img/iconmonstr-monitoring-6-240.png" alt=""><span>掲載情報</span></a>
                    <a href="../client/client_student/index.php"><img src="../client/img/iconmonstr-school-23-240.png" alt=""><span>学生の情報</span></a>
                </div>
                <div class="page_buttons">
                    <a href="../client/client_agency/index.php"><img src="../client/img/iconmonstr-customer-9-240.png" alt=""><span>担当者一覧</span></a>
                    <a href="../client/client_application/index.php"><img src="../client/img/iconmonstr-pencil-9-240.png" alt=""><span>編集申請</span></a>
                </div>
            </div>
        </div>
    </section>
    <script src="top.js"></script>
</body>

</html>