<?php
session_start();

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

if (isset($_POST['agency_name'])) {
    $path = '../../client/img/';
    $company_name = $_POST['company_name'];
    $agency_name = $_POST['agency_name'];
    $agency_Tel = $_POST['agency_Tel'];
    $agency_mail = $_POST['agency_mail'];
    $department = $_POST['department_name'];
    $pas = $_POST['password'];
    $pas_check = $_POST['password_check'];
    $stmt = $db->prepare('SELECT count(*) from users where password=?');
    $stmt->bindValue(1, sha1($pas), PDO::PARAM_STR);
    $stmt->execute();
    $exist = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt = $db->prepare(
        "SELECT 
            *
        FROM 
            agent
        WHERE
            agent_name=?"
    );
    $stmt->bindValue(1,$_POST['company_name'], PDO::PARAM_STR);
    $stmt->execute();
    $agent_info = $stmt->fetch();
    var_dump($agent_info);

    // var_dump($exist);
    echo 'POSTあったよ';
    if(intval($exist['count(*)'] == 0)){
        if ($pas == $pas_check) {
            $stmt = $db->prepare(
            'INSERT INTO 
            `users` (
            `user_img`,
            `company_id`,
            `name`,
            `department_name`,
            `tel`,
            `email`,
            `password`
        ) 
    VALUES
        (?,?,?,?,?,?,?)
    ');
            $stmt->bindValue(1, $agency_name, PDO::PARAM_STR);
            $stmt->bindValue(2, $agent_info['id'], PDO::PARAM_STR);
            $stmt->bindValue(3, $agency_name, PDO::PARAM_STR);
            $stmt->bindValue(4, $department, PDO::PARAM_STR);
            $stmt->bindValue(5, $agency_Tel, PDO::PARAM_STR);
            $stmt->bindValue(6, $agency_mail, PDO::PARAM_STR);
            $stmt->bindValue(7, sha1($pas), PDO::PARAM_STR);
            $stmt->execute();

                   // ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
    if( !empty($_FILES['img']['tmp_name']) && is_uploaded_file($_FILES['img']['tmp_name']) ) {
    
        // ファイルを指定したパスへ保存する
        if( move_uploaded_file( $_FILES['img']['tmp_name'], $path.$agency_name . '.png') ) {
            echo 'アップロードされたファイルを保存しました。';
        } else {
            echo 'アップロードされたファイルの保存に失敗しました。';
        }
    }

            echo 'パス一致';
        } else {
            echo 'パス不一致';
        }
    }else{
        echo 'このパスワードはすでに使われております';
    }
    }


if(isset($_GET['btn_logout']) ) {
	unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        // $stmt = $db->prepare('INSERT INTO events SET title=?');
        // $stmt->execute(array(
        //     $_POST['title']
        // ));

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/top.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}


// $stmt = $db->prepare(
//     "SELECT 
//         *
//     FROM 
//         agent
//     WHERE
//         agent_name=?"
// );
// $stmt->bindValue(1, 'マイナビ', PDO::PARAM_STR);
// $stmt->execute();
// $agent_info = $stmt->fetch();
// var_dump($agent_info);
// $abc = 'マイナビ';
// $stmt = $db->prepare(
//     "SELECT 
//         *
//     FROM 
//         agent
//     WHERE
//         agent_name=?"
// );
// $stmt->bindValue(1,$abc, PDO::PARAM_STR);
// $stmt->execute();
// $agent_info = $stmt->fetch();
// var_dump($agent_info);
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
            <!-- <a href="../admin_login/index.html">ログアウト</a> -->
        </div>
    <div class="header_bottom">
        <ul>
            <li><a href="../top.php" class="page_focus">トップ</a></li>
            <li><a href="../admin_student/index.php">ユーザー管理</a></li>
            <li><a href="../admin_company/index.php">企業管理</a></li>
            <li><a href="../admin_submit/index.php">新規エージェンシー</a></li>
        </ul>
    </div>
    </header>

<div class="page_change">
    <button onclick="change_company()">企業情報を登録</button>
    <button onclick="change_agency()">担当者情報を登録</button>
</div>

<section>
    <div id="company">
        <h2>企業情報登録</h2>
        <form action="">
            <table class="contact-table">
                <tr>
                    <th class="contact-item">企業名</th>
                    <td class="contact-body">
                        <input type="text" name="企業名" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">企業画像ファイル</th>
                    <td class="contact-body">
                        <input type="text" name="file" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">公式サイトurl</th>
                    <td class="contact-body">
                        <input type="text" name="url" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">見出し</th>
                    <td class="contact-body">
                        <input type="text" name="見出し" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">アピールポイント</th>
                    <td class="contact-body">
                        <input type="text" name="appeal" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">内定実績</th>
                    <td class="contact-body">
                        <input type="text" name="内定実績" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">掲載者数</th>
                    <td class="contact-body">
                        <input type="text" name="掲載者数" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">内定最短</th>
                    <td class="contact-body">
                        <input type="text" name="内定最短" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">実績</th>
                    <td class="contact-body">
                        <input type="text" name="実績" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">サービスの手順1</th>
                    <td class="contact-body">
                        <input type="text" name="step1" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">サービスの手順2</th>
                    <td class="contact-body">
                        <input type="text" name="step2" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">サービスの手順3</th>
                    <td class="contact-body">
                        <input type="text" name="step3" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">掲載期限</th>
                    <td class="contact-body">
                        <input type="text" name="limit" class="form-text" />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">タグ</th>
                    <td id="input_pluralBox">
                        <div id="input_plural">
                            <!-- <input type="text" class="form-control" placeholder="サンプルテキストサンプルテキストサンプルテキスト"> -->
                            <div class="cp_ipselect form-control">
                                <select id="choice" class="cp_sl02" onchange="inputChange()" required>
                                <!-- <option value="" hidden disabled selected></option> -->
                                <option value="1">トップページ画面</option>
                                <option value="2">詳細ページ画面</option>
                                <option value="3">契約情報</option>
                                </select>
                                <span class="cp_sl02_highlight"></span>
                                <span class="cp_sl02_selectbar"></span>
                                <!-- <label class="cp_sl02_selectlabel">閲覧するページを選ぶ</label> -->
                                <input type="button" value="＋" class="add pluralBtn">
                                <input type="button" value="－" class="del pluralBtn">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <input class="contact-submit" type="submit" value="送信" />
        </form>
    </div>

    <div id="agency">
        <h2>担当者情報登録</h2>
        <form method="POST" action="../admin_submit/index.php" enctype="multipart/form-data">
            <table class="contact-table">
                <tr>
                    <th class="contact-item">企業名</th>
                    <td class="contact-body">
                        <input type="text" name="company_name" class="form-text" required/>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">担当者氏名</th>
                    <td class="contact-body">
                        <input type="text" name="agency_name" class="form-text" required/>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">部署名</th>
                    <td class="contact-body">
                        <input type="text" name="department_name" class="form-text" required/>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">担当者Tel</th>
                    <td class="contact-body">
                        <input type="tel" name="agency_Tel" class="form-text" required/>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">担当者mail</th>
                    <td class="contact-body">
                        <input type="email" name="agency_mail" class="form-text" required/>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">画像ファイル</th>
                    <td class="contact-body">
                    <!-- <img id="preview1" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="> -->
                    <input id="inputFile" name="img" type="file" accept="image/jpeg, image/png" onchange="previewImage(this);" required />
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">パスワード</th>
                    <td class="contact-body">
                        <input type="password" name="password" class="form-text" required/>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">パスワード<br>(確認用)</th>
                    <td class="contact-body">
                        <input type="password" name="password_check" class="form-text" required/>
                    </td>
                </tr>
            </table>
            <input class="contact-submit" type="submit" value="送信" />
        </form>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="script.js"></script>
    
</body>
</html>

