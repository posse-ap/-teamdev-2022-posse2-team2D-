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
        <form action="update.php" method="post">
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
                                <input type="text" name="image" class="form-text" value="<?= $cnt['image']; ?>" />
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
                <form action="../admin_agent/select.php" method="get" class="trash-can">
                    <input type="image" src="../img/iconmonstr-trash-can-9-240.png">
                    <input type="hidden" name="delete" value="<?= $_GET['agent']; ?>">
                </form>
            </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="script.js"></script>

</bod>

</html>