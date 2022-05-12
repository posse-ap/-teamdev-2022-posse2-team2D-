<?php
    $name = $_POST['name'];
    $katakana = $_POST['katakana'];
    $Tel = $_POST['Tel'];
    $mail = $_POST['mail'];
    $university = $_POST['university'];
    $faculty = $_POST['faculty'];
    $graduate = $_POST['graduate'];
    $home = $_POST['home'];
    $free = $_POST['free'];
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
            <span class="color">3</span>
            <h2>内容確認</h2>
        </div>
        <div>
            <span class="step4">4</span>
            <h2>登録完了</h2>
        </div>    
    </section>

    <section class="check">
        <form method="post" action="./thanks.php">
            <table class="">
                <tr>
                    <th class="">お名前</th>
                    <td class="">
                        <h3><textarea name="name_check"><?php echo $name ?></textarea></h3>
                    </td>
                </tr>
                <tr>
                    <th class="">カナ</th>
                    <td class="">
                        <h3><textarea name="katakana_check"><?php echo $katakana ?></textarea></h3>
                    </td>
                </tr>
                <tr>
                    <th class="">Tel</th>
                    <td class="">
                        <h3><textarea name="Tel_check"><?php echo $Tel ?></textarea></h3>
                    </td>
                </tr>
                <tr>
                    <th class="">mail</th>
                    <td class="">
                        <h3><textarea name="mail_check"><?php echo $mail ?></textarea></h3>
                    </td>
                </tr>
                <tr>
                    <th class="">大学名</th>
                    <td class="">
                        <h3><textarea name="university_check"><?php echo $university ?></textarea></h3>
                    </td>
                </tr>
                <tr>
                    <th class="">学部・学科</th>
                    <td class="">
                        <h3><textarea name="faculty_check"><?php echo $faculty ?></textarea></h3>
                    </td>
                </tr>
                <tr>
                    <th class="">卒業年</th>
                    <td class="">
                        <h3><textarea name="graduate_check"><?php echo $graduate ?></textarea></h3>
                    </td>
                </tr>
                <tr>
                    <th class="">住所</th>
                    <td class="">
                        <h3><textarea name="home_check"><?php echo $home ?></textarea></h3>
                    </td>
                </tr>
                <tr>
                    <th class="">自由記入欄</th>
                    <td class="">
                        <h3><textarea name="free_check"><?php echo $free ?></textarea></h3>
                    </td>
                </tr>
            </table>
            <input class="contact-submit" type="submit" value="申込み確定" />
        </form>
    </section>
</body>
</html>