<?php
$dsn = 'mysql:host=db;dbname=shukatsu;charset=utf8;';
$user = 'root';
$password = 'password';

try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo '接続失敗: ' . $e->getMessage();
    exit();
}


$name_check = $_POST['name_check'];
$katakana_check = $_POST['katakana_check'];
$Tel_check = $_POST['Tel_check'];
$mail_check = $_POST['mail_check'];
$university_check = $_POST['university_check'];
$faculty_check = $_POST['faculty_check'];
$graduate_check = $_POST['graduate_check'];
$home_check = $_POST['home_check'];
$free_check = $_POST['free_check'];

//     $stmt = $db->prepare("INSERT INTO
//     `apply_info` (
//         `name`,
//         `tel`,
//         `mail`,
//         `college`
//         `faculty`
//         `graduate_year`
//         `adress`
//     )
// VALUES
//     ('$name', '$katakana', '$Tel', '$mail', '$university', '$faculty', '$graduate', '$home', '$free');");
//     $stmt->execute();

$stmt = $db->prepare(
    'INSERT INTO 
    `apply_info` (
        `name`,
        `tel`,
        `mail`,
        `college`,
        `faculty`,
        `graduate_year`,
        `adress`
    ) 
VALUES
    (?,?,?,?,?,?,? )
'
);
$stmt->bindValue(1, $name_check, PDO::PARAM_STR);
$stmt->bindValue(2, $Tel_check, PDO::PARAM_STR);
$stmt->bindValue(3, $mail_check, PDO::PARAM_STR);
$stmt->bindValue(4, $university_check, PDO::PARAM_STR);
$stmt->bindValue(5, $faculty_check, PDO::PARAM_STR);
$stmt->bindValue(6, $graduate_check, PDO::PARAM_STR);
$stmt->bindValue(7, $home_check, PDO::PARAM_STR);
$stmt->execute();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../top/reset.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <header>
        <h1>就活の教科書</h1>
        <nav>
            <h5>就活やり方</h5>
            <h5>就活やり方</h5>
            <h5>就活やり方</h5>
            <h5>就活やり方</h5>
            <h5>就活やり方</h5>
            <h5>就活やり方</h5>
            <h5>就活やり方</h5>
            <h5>就活やり方</h5>
        </nav>
    </header>

    <div class="title">
        <img src="img/iconmonstr-handshake-7-240.png" alt="">
        <h1>申し込み</h1>
    </div>

    <section class="step">
        <div>
            <span>1</span>
            <h2>申し込みページ</h2>
        </div>
        <div>
            <span>2</span>
            <h2>学生情報入力</h2>
        </div>
        <div>
            <span>3</span>
            <h2>内容確認</h2>
        </div>
        <div>
            <span class="step4 color">4</span>
            <h2>登録完了</h2>
        </div>
    </section>

    <section class="success">
        <h1><span>Success!</span></h1>
        <h1>ご登録ありがとうございます！</h1>
    </section>

    <div class="footer">
        <a href="../top/index.html">エージェント企業をもっと見る</a>
    </div>

</body>

</html>