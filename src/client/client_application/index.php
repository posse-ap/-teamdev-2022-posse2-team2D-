<?php
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
session_start();
// require('../dbconnect.php');
if (isset($_GET['btn_logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    unset($_SESSION['password']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        if (isset($_POST['names'])) {
            $path = '../../user/img/';
            $name = $_POST['names'];
            $image = $_POST['image'];
            $link = $_POST['link'];
            $publisher = $_POST['publisher'];
            $speed = $_POST['speed'];
            $decision = $_POST['decision'];
            $registstrant = $_POST['registstrant'];
            $place = $_POST['place'];
            $main = $_POST['main'];
            $sub = $_POST['sub'];
            $step1 = $_POST['step1'];
            $step2 = $_POST['step2'];
            $step3 = $_POST['step3'];
            $mail = $_POST['mail'];
            $tel = $_POST['tel'];
            $agent = $_POST['agent'];

            if ($decision < 10000) {
                $decision_five = 1;
            } elseif ($decision < 25000) {
                $decision_five = 2;
            } elseif ($decision < 40000) {
                $decision_five = 3;
            } elseif ($decision < 60000) {
                $decision_five = 4;
            } else {
                $decision_five = 5;
            }

            if ($publisher < 10000) {
                $publisher_five = 1;
            } elseif ($publisher < 25000) {
                $publisher_five = 2;
            } elseif ($publisher < 40000) {
                $publisher_five = 3;
            } elseif ($publisher < 60000) {
                $publisher_five = 4;
            } else {
                $publisher_five = 5;
            }

            if ($registstrant < 10000) {
                $registstrant_five = 1;
            } elseif ($registstrant < 25000) {
                $registstrant_five = 2;
            } elseif ($registstrant < 40000) {
                $registstrant_five = 3;
            } elseif ($registstrant < 60000) {
                $registstrant_five = 4;
            } else {
                $registstrant_five = 5;
            }

            if ($place < 5) {
                $place_five = 1;
            } elseif ($place < 10) {
                $place_five = 2;
            } elseif ($place < 15) {
                $place_five = 3;
            } elseif ($place < 20) {
                $place_five = 4;
            } else {
                $place_five = 5;
            }

            if ($speed < 2) {
                $speed_five = 5;
            } elseif ($speed < 3) {
                $speed_five = 4;
            } elseif ($speed < 4) {
                $speed_five = 3;
            } elseif ($speed < 5) {
                $speed_five = 2;
            } else {
                $speed_five = 1;
            }

            // $stmt_agentid = $db->prepare("select id from agent where agent_name ='$agent'");
            // $stmt_agentid->execute();
            // $agentid = $stmt_agentid->fetch();
            // $aid = $agentid['id'];

            // //deleteしてさらにinsert
            // $stmt_delete = $db->prepare("delete from agent_tag where agent_id = '$aid' ");
            // $stmt_delete->execute();

            // $tags = $_POST['tag'];
            // foreach ($tags as $tag) :
            //   $stmt_tag = $db->prepare("select id from tag where tag_name = '$tag'");
            //   $stmt_tag->execute();
            //   $tagid = $stmt_tag->fetch();
            //   $tid = $tagid['id'];

            //   $stmt_insert = $db->prepare("insert into agent_tag (agent_id,tag_id) value('$aid','$tid')");
            //   $stmt_insert->execute();
            // endforeach;

            // $stmt_copy = $db->prepare("select * into edit_agent from agent");
            // $stmt_copy->execute();
            // $stmt = $db->prepare("update agent set agent_name='$name',image='$image',link='$link',publisher_five='$publisher_five',speed_five='$speed_five',decision_five=$decision_five,registstrant_five='$registstrant_five',place_five='$place_five',publisher='$publisher',speed='$speed',decision=$decision,registstrant='$registstrant',place='$place' where agent_name = '$agent'");
            // $stmt->execute();
            $stmt_agentid = $db->prepare("select id from agent where agent_name ='$agent'");
            $stmt_agentid->execute();
            $agentid = $stmt_agentid->fetch();
            $aid = $agentid['id'];
            echo $aid;

            $stmt_count = $db->prepare("select count(agent_name) from edit_agent where agent_name ='$agent'");
            $stmt_count->execute();
            $count = $stmt_count->fetch();

            $stmt = $db->prepare("insert into edit_agent(id,agent_name,image,link,publisher_five,decision_five,speed_five,registstrant_five,place_five,publisher,decision,speed,registstrant,place,main,sub,step1,step2,step3,mail,tel) value('$aid','$name','$image','$link','$publisher_five','$decision_five','$speed_five','$registstrant_five','$place_five','$publisher','$decision','$speed','$registstrant','$place','$main','$sub','$step1','$step2','$step3','$mail','$tel')");
            $stmt->execute();
        }
        
            // ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
            if (!empty($_FILES['img']['tmp_name']) && is_uploaded_file($_FILES['img']['tmp_name'])) {
                // ファイルを指定したパスへ保存する
                if (move_uploaded_file($_FILES['img']['tmp_name'], $path . '編集申請_' . $name . '.png')) {
                    // echo 'アップロードされたファイルを保存しました。';
                } else {
                    // echo 'アップロードされたファイルの保存に失敗しました。';
                }
            } else {
            }

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client_application/index.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/login.php');
    exit();
}
$agent = $_SESSION['agent_name'];
$cnt_edit = $db->prepare("select * from agent where agent_name = '$agent'");
$cnt_edit->execute();
$cnt = $cnt_edit->fetch();

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

    <!-- <div class="page to-cart">
        <p>
            <a href="../top.php">トップ</a>
            <span>></span>
            <a href="../admin_company/index.php">企業情報</a>
            <span>></span>
            <span class="page_current">企業情報編集</span>
        </p>
    </div> -->

    <!-- <div class="page_change">
        <button onclick="change_agent()">企業情報を編集</button>
        <button onclick="change_agency()">担当者情報を編集</button>
    </div> -->

    <section>
        <form action="index.php" method="POST" enctype="multipart/form-data">
            <div id="agent">
                <h2>企業情報編集:<?= $_SESSION['agent_name']; ?></h2>
                <form action="">
                    <table class="contact-table">
                        <tr>
                            <th class="contact-item">企業名</th>
                            <td class="contact-body">
                                <input type="text" name="names" class="form-text" value="<?= $_SESSION['agent_name']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">企業画像ファイル</th>
                            <td class="contact-body">
                            <input id="inputFile" name="img" type="file" accept="image/jpeg, image/png" onchange="previewImage(this);" required />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">公式サイトurl</th>
                            <td class="contact-body">
                                <input type="text" name="link" class="form-text" value="<?= $cnt['link']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">見出し</th>
                            <td class="contact-body">
                                <input type="text" name="main" class="form-text" value="<?= $cnt['main']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">小見出し</th>
                            <td class="contact-body">
                                <input type="text" name="sub" class="form-text" value="<?= $cnt['sub']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">内定実績</th>
                            <td class="contact-body">
                                <input type="text" name="decision" class="form-text" value="<?= $cnt['decision']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">掲載社数</th>
                            <td class="contact-body">
                                <input type="text" name="publisher" class="form-text" value="<?= $cnt['publisher']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">内定最短</th>
                            <td class="contact-body">
                                <input type="text" name="speed" class="form-text" value="<?= $cnt['speed']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">登録者数</th>
                            <td class="contact-body">
                                <input type="text" name="registstrant" class="form-text" value="<?= $cnt['registstrant']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">拠点数</th>
                            <td class="contact-body">
                                <input type="text" name="place" class="form-text" value="<?= $cnt['place']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">サービスの手順1</th>
                            <td class="contact-body">
                                <input type="text" name="step1" class="form-text" value="<?= $cnt['step1']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">サービスの手順2</th>
                            <td class="contact-body">
                                <input type="text" name="step2" class="form-text" value="<?= $cnt['step2']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">サービスの手順3</th>
                            <td class="contact-body">
                                <input type="text" name="step3" class="form-text" value="<?= $cnt['step3']; ?>" />
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
                                <input type="text" name="mail" class="form-text" value="<?= $cnt['mail']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">電話番号</th>
                            <td class="contact-body">
                                <input type="text" name="tel" class="form-text" value="<?= $cnt['tel']; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th class="contact-item">タグ</th>
                            <td id="input_pluralBox">
                                <div id="input_plural">
                                    <!-- <input type="text" class="form-control" placeholder="サンプルテキストサンプルテキストサンプルテキスト"> -->
                                    <div class="cp_ipselect form-control">
                                        <?php
                                        // require(dirname(__FILE__) . "/dbconnect.php");
                                        $stmt = $db->prepare('SELECT * FROM agent_tag JOIN agent ON agent.id = agent_tag.agent_id RIGHT JOIN tag ON tag.id = agent_tag.tag_id where agent_name=:name');
                                        $stmt->bindValue('name', $cnt['agent_name'], PDO::PARAM_STR);
                                        $stmt->execute();
                                        $tags = $stmt->fetchAll(); ?>
                                        <?php foreach ($tags as $tag) : ?>
                                            <select name="tag[]" id="tag">
                                                <?php foreach ($alltags as $alltag) :
                                                    $alltag['tag_name'] == $tag['tag_name'] ?
                                                        $select = 'selected' : $select = '';
                                                ?>
                                                    <option value="<?= $alltag['tag_name']; ?>" <?= $select; ?>><?= $alltag['tag_name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endforeach; ?>
                                        <!-- <label class="cp_sl02_selectlabel">閲覧するページを選ぶ</label> -->
                                    </div>
                                    <span class="cp_sl02_highlight"></span>
                                    <span class="cp_sl02_selectbar"></span>
                                    <input type="button" value="＋" class="add pluralBtn">
                                    <input type="button" value="－" class="del pluralBtn">
                                </div>
                            </td>
                        </tr>
                    </table>
                    <div class="submit_section">
                        <input class="contact-submit" type="submit" value="送信" />
                        <input type="hidden" name="agent" value="<?= $_SESSION['agent_name']; ?>">
                    </div>
                </form>
            </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="script.js"></script>

</bod>

</html>