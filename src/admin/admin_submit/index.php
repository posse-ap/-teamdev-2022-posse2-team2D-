<?php
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
session_start();
if (isset($_GET['btn_logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
}

if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        if (isset($_POST['agency_name'])) {
            $path = '../../client/img/';
            $agent_name = $_POST['agent_name'];
            $agency_name = $_POST['agency_name'];
            $agency_Tel = $_POST['agency_Tel'];
            $agency_mail = $_POST['agency_mail'];
            $department_name = $_POST['department_name'];
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
            $stmt->bindValue(1, $_POST['agent_name'], PDO::PARAM_STR);
            $stmt->execute();
            $agent_info = $stmt->fetch();
            // var_dump($agent_info);

            // ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
            if (!empty($_FILES['img']['tmp_name']) && is_uploaded_file($_FILES['img']['tmp_name'])) {

                // ファイルを指定したパスへ保存する
                if (move_uploaded_file($_FILES['img']['tmp_name'], $path . $agency_name . '.png')) {
                    if (intval($exist['count(*)'] == 0)) {
                        if ($pas == $pas_check) {
                            $stmt = $db->prepare(
                                'INSERT INTO 
                                    `users` (
                                    `user_img`,
                                    `agent_id`,
                                    `name`,
                                    `department_name`,
                                    `tel`,
                                    `email`,
                                    `password`
                                ) 
                            VALUES
                                (?,?,?,?,?,?,?)
                            '
                            );
                            $stmt->bindValue(1, $agency_name, PDO::PARAM_STR);
                            $stmt->bindValue(2, $agent_info['id'], PDO::PARAM_STR);
                            $stmt->bindValue(3, $agency_name, PDO::PARAM_STR);
                            $stmt->bindValue(4, $department_name, PDO::PARAM_STR);
                            $stmt->bindValue(5, $agency_Tel, PDO::PARAM_STR);
                            $stmt->bindValue(6, $agency_mail, PDO::PARAM_STR);
                            $stmt->bindValue(7, sha1($pas), PDO::PARAM_STR);
                            $stmt->execute();
                            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/admin_submit/index.php');
                            exit();
                        } else {
                            // echo 'アップロードされたファイルの保存に失敗しました。';
                        }
                    }

                    exit();
                } else {
                    exit();
                }
            } else {
                exit();
            }
        }

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/admin_submit/index.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}

$cnt_tag = $db->prepare('select * from tag');
$cnt_tag->execute();
$alltags = $cnt_tag->fetchAll();


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
<bod>
    <header>
        <div class="header_top">
            <h1>管理者画面</h1>
            <form method="get" action="">

                <input type="submit" name="btn_logout" value="ログアウト">
            </form>
        </div>
        <div class="header_bottom">
            <ul>
                <li><a href="../top.php">トップ</a></li>
                <li><a href="../admin_student/index.php">ユーザー管理</a></li>
                <li><a href="../admin_company/index.php">企業管理</a></li>
                <li><a href="../admin_submit/index.php">新規エージェンシー</a></li>
            </ul>
        </div>
    </header>

    <div class="page to-cart">
        <p>
            <a href="../top.php">トップ</a>
            <span>></span>
            <span class="page_current">企業情報登録</span>
        </p>
    </div>

    <div class="page_change">
        <button onclick="change_agent()">企業情報を登録</button>
        <button onclick="change_agency()">担当者情報を登録</button>
    </div>

    <section>
        <form action="insert.php" method="post" enctype="multipart/form-data">
            <div id="agent">
                <h2>企業情報登録</h2>
                <form action="">
                    <table class="contact-table">
                        <tr>
                            <th class="contact-item">企業名</th>
                            <td class="contact-body">
                                <input type="text" name="names" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">企業画像ファイル</th>
                            <td class="contact-body">
                                <input id="inputFile2" name="img" type="file" accept="image/jpeg, image/png" required />
                                <!-- <input type="text" name="image" class="form-text" /> -->
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">公式サイトurl</th>
                            <td class="contact-body">
                                <input type="text" name="link" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">内定実績</th>
                            <td class="contact-body">
                                <input type="text" name="decision" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">掲載社数</th>
                            <td class="contact-body">
                                <input type="text" name="publisher" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">内定最短</th>
                            <td class="contact-body">
                                <input type="text" name="speed" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">登録者数</th>
                            <td class="contact-body">
                                <input type="text" name="registstrant" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">拠点数</th>
                            <td class="contact-body">
                                <input type="text" name="place" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">見出し</th>
                            <td class="contact-body">
                                <input type="text" name="main" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">小見出し</th>
                            <td class="contact-body">
                                <input type="text" name="sub" class="form-text" />
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
                            <th class="contact-item">メールアドレス</th>
                            <td class="contact-body">
                                <input type="text" name="mail" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">電話番号</th>
                            <td class="contact-body">
                                <input type="text" name="tel" class="form-text" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">タグ</th>
                            <td id="input_pluralBox">
                                <div id="input_plural">
                                    <!-- <input type="text" class="form-control" placeholder="サンプルテキストサンプルテキストサンプルテキスト"> -->
                                    <div class="cp_ipselect form-control">
                                        <select name="tag[]" id="tag">
                                            <?php foreach ($alltags as $alltag) :
                                                $alltag['tag_name'] == $tag['tag_name'] ?
                                                    $select = 'selected' : $select = '';
                                            ?>
                                                <option value="<?= $alltag['tag_name']; ?>" <?= $select; ?>><?= $alltag['tag_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <!-- <label class="cp_sl02_selectlabel">閲覧するページを選ぶ</label> -->
                                    </div>
                                    <span class="cp_sl02_highlight"></span>
                                    <span class="cp_sl02_selectbar"></span>
                                    <input type="button" value="＋" class="add pluralBtn">
                                    <input type="button" value="－" class="del pluralBtn">
                                    <p class="error">※カテゴリは5個までです</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="submit_section">
                        <input class="contact-submit" type="submit" value="送信" />
                    </div>
                </form>
            </div>

            <div id="agency">
                <h2>担当者情報登録</h2>
                <form method="POST" action="../admin_submit/index.php" enctype="multipart/form-data">
                    <table class="contact-table">
                        <tr>
                            <th class="contact-item">企業名</th>
                            <td class="contact-body">
                                <input type="text" name="agent_name" class="form-text" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">担当者氏名</th>
                            <td class="contact-body">
                                <input type="text" name="agency_name" class="form-text" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">部署名</th>
                            <td class="contact-body">
                                <input type="text" name="department_name" class="form-text" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">担当者Tel</th>
                            <td class="contact-body">
                                <input type="tel" name="agency_Tel" class="form-text" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">担当者mail</th>
                            <td class="contact-body">
                                <input type="mail" name="agency_mail" class="form-text" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">画像ファイル</th>
                            <td class="contact-body">
                                <!-- <img id="preview1" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="> -->
                                <input id="inputFile" name="img" type="file" accept="image/jpeg, image/png" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">パスワード</th>
                            <td class="contact-body">
                                <input type="password" name="password" class="form-text" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">パスワード<br>(確認用)</th>
                            <td class="contact-body">
                                <input type="password" name="password_check" class="form-text" required />
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