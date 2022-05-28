<?php
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
session_start();
if (isset($_GET['btn_logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}

$agent = $_GET['agent'];
$cnt_edit = $db->prepare("select * from agent where agent_name = '$agent'");
$cnt_edit->execute();
$cnt = $cnt_edit->fetch();
$id = $cnt['id'];

$cnt_tag = $db->prepare('select * from tag');
$cnt_tag->execute();
$alltags = $cnt_tag->fetchAll();

$stmt_agentEdit = $db->prepare("select * from edit_agent where id = '$id'");
$stmt_agentEdit->execute();
$agentEdit = $stmt_agentEdit->fetch();

if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        if (isset($_POST['tag']) && is_array($_POST['tag'])) {
                $array = array_diff($_POST['tag'], ["F"]);
                $_SESSION['tags'] = $array;
        }

        // header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin_edit/index.php');
        // exit();
    }else{
        $stmt = $db->prepare('SELECT * FROM agent_tag JOIN agent ON agent.id = agent_tag.agent_id RIGHT JOIN tag ON tag.id = agent_tag.tag_id where agent_name=:name');
        $stmt->bindValue('name', $cnt['agent_name'], PDO::PARAM_STR);
        $stmt->execute();
        $tags = $stmt->fetchAll();
        $_SESSION['tags'] = [];
        foreach ($tags as $tag) : 
            array_push( $_SESSION['tags'] , $tag['tag_name'] );
        endforeach;
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}

$_SESSION['agent'] = $_GET['agent'];
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
            <a href="../admin_company/index.php">企業情報</a>
            <span>></span>
            <span class="page_current">企業情報編集</span>
        </p>
    </div>

    <div class="page_change">
        <button onclick="change_agent()">企業情報を編集</button>
        <button onclick="change_agency()">企業からの編集申請<img src="../img/通知.png" alt="" class="alert"></button>
    </div>

    <section>
        <form action="update.php" method="post" enctype="multipart/form-data">
            <div id="agent">
                <h2>企業情報編集:<?= $_GET['agent']; ?></h2>
                <table class="contact-table">
                    <tr>
                        <th class="contact-item">企業名</th>
                        <td class="contact-body">
                            <input type="text" name="names" class="form-text" value="<?= $cnt['agent_name']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">企業画像ファイル</th>
                        <td class="contact-body">
                            <!-- <input id="inputFile" name="img" type="file" accept="image/jpeg, image/png" /> -->
                        <label class="edit_img" style="background-image: url('<?= "../../user/img/" . $cnt['agent_name'] . ".png?" . uniqid() ?>');">
                            <img id="preview3" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                            <input id="inputFile" name="img" type="file" accept="image/jpeg, image/png" onchange="previewImage(this);">
                        </label>
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
                            <input type="text" name="deadline" class="form-text" value="<?= $cnt['deadline']; ?>" />
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
                        <th class="contact-item">アピールポイント1（タイトル）</th>
                        <td class="contact-body">
                            <input type="text" name="apeal1" class="form-text" value="<?= $cnt['apeal1']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">アピールポイント1</th>
                        <td class="contact-body">
                            <input type="text" name="apeal1_content" class="form-text" value="<?= $cnt['apeal1_content']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">アピールポイント2（タイトル）</th>
                        <td class="contact-body">
                            <input type="text" name="apeal2" class="form-text" value="<?= $cnt['apeal2']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">アピールポイント2</th>
                        <td class="contact-body">
                            <input type="text" name="apeal2_content" class="form-text" value="<?= $cnt['apeal2_content']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">タグ</th>
                        <td class="contact-body">
                                <div>
                                    <button onclick="modal_open()" type="button">+</button>
                                    <ul id="tagList"></ul>
                                    <ul id="tagList2">
                                        <?php foreach ($_SESSION['tags'] as $tag) : ?>
                                            <li><?= $tag ?></li>
                                            <input type="hidden" name="selected_tag[]" value="<?= $tag ?>" class="form-text" />
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                </table>
                <div class="submit_section">
                    <input class="contact-submit" type="submit" value="送信" />
                    <input type="hidden" name="agent" value="<?= $_GET['agent']; ?>">
                </div>
        </form>
        </div>

        <form id="modal" class="modal" onSubmit="return false;">
                <button id="cancel_btn" class="cancel" type="button" onclick="cancel()">×</button>
                <div class="modal_content">
                    <section class="modal_left">
                        <h2>タグを選択してください</h2>
                        <div class="submit__form__item">
                            <dt class="modal_title">サービス内容</dt>
                            <dd class="check_flex">
                                <?php for ($i = 0; $i <= 5; $i++) { ?>
                                    <input type="checkbox" name="tag[]" value="<?= $alltags[$i]['tag_name'] ?>" id="check<?= $i ?>" class="check" <?=
                                                                                                                                                in_array($alltags[$i]['tag_name'], $_SESSION['tags']) ? 'checked' : ''

                                                                                                                                                ?>>
                                    <label for="check<?= $i ?>" class="check_2"></label>
                                    <label for="check<?= $i ?>" class="check_1"><?= $alltags[$i]['tag_name'] ?></label>
                                <?php } ?>
                            </dd>
                        </div>
                        <div class="submit__form__item">
                            <dt class="modal_title">得意分野</dt>
                            <dd class="check_flex">
                                <?php for ($i = 6; $i <= 11; $i++) { ?>
                                    <input type="checkbox" name="tag[]" value="<?= $alltags[$i]['tag_name'] ?>" id="check<?= $i ?>" class="check" <?= in_array($alltags[$i]['tag_name'], $_SESSION['tags']) ? 'checked' : '' ?>>
                                    <label for="check<?= $i ?>" class="check_2"></label>
                                    <label for="check<?= $i ?>" class="check_1"><?= $alltags[$i]['tag_name'] ?></label>
                                <?php } ?>
                                <br>
                                <?php for ($i = 12; $i <= 14; $i++) { ?>
                                    <input type="checkbox" name="tag[]" value="<?= $alltags[$i]['tag_name'] ?>" id="check<?= $i ?>" class="check" <?= in_array($alltags[$i]['tag_name'], $_SESSION['tags']) ? 'checked' : '' ?>>
                                    <label for="check<?= $i ?>" class="check_2"></label>
                                    <label for="check<?= $i ?>" class="check_1"><?= $alltags[$i]['tag_name'] ?></label>
                                <?php } ?>
                            </dd>
                        </div>
                    </section>
                </div>

                <div class="submit__form__footer">
                    <button id="button1" class="submit__form__button">確定</button>
                </div>

            </form>

        <script>
                function previewImage(obj) {
                    var fileReader = new FileReader();
                    fileReader.onload = (function() {
                        document.getElementById('preview3').src = fileReader.result;
                    });
                    fileReader.readAsDataURL(obj.files[0]);
                }
        </script>

        <div id="agency">
            <h2><?= $_GET['agent']; ?>からの編集申請</h2>
            <form action="update_client.php" method="post">
                <table class="contact-table">
                    <tr>
                        <th class="contact-item">企業名</th>
                        <td class="contact-body">
                            <input type="text" name="names2" class="form-text" value="<?= $agentEdit['agent_name']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">企業画像ファイル</th>
                        <td class="contact-body">
                        <img src="<?= file_exists("../../user/img/編集申請_" . $agentEdit['agent_name'] . ".png") ? "../../user/img/編集申請_" . $agentEdit['agent_name'] . ".png?" .  uniqid()  : "../../user/img/" . $agentEdit['agent_name'] . ".png?" .  uniqid() ?>" alt="">
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">公式サイトurl</th>
                        <td class="contact-body">
                            <input type="text" name="link" class="form-text" value="<?= $agentEdit['link']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">見出し</th>
                        <td class="contact-body">
                            <input type="text" name="main" class="form-text" value="<?= $agentEdit['main']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">小見出し</th>
                        <td class="contact-body">
                            <input type="text" name="sub" class="form-text" value="<?= $agentEdit['sub']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">内定実績</th>
                        <td class="contact-body">
                            <input type="text" name="decision" class="form-text" value="<?= $agentEdit['decision']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">掲載社数</th>
                        <td class="contact-body">
                            <input type="text" name="publisher" class="form-text" value="<?= $agentEdit['publisher']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">内定最短</th>
                        <td class="contact-body">
                            <input type="text" name="speed" class="form-text" value="<?= $agentEdit['speed']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">登録者数</th>
                        <td class="contact-body">
                            <input type="text" name="registstrant" class="form-text" value="<?= $agentEdit['registstrant']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">拠点数</th>
                        <td class="contact-body">
                            <input type="text" name="place" class="form-text" value="<?= $agentEdit['place']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">サービスの手順1</th>
                        <td class="contact-body">
                            <input type="text" name="step1" class="form-text" value="<?= $agentEdit['step1']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">サービスの手順2</th>
                        <td class="contact-body">
                            <input type="text" name="step2" class="form-text" value="<?= $agentEdit['step2']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">サービスの手順3</th>
                        <td class="contact-body">
                            <input type="text" name="step3" class="form-text" value="<?= $agentEdit['step3']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">掲載期限</th>
                        <td class="contact-body">
                            <input type="text" name="deadline" class="form-text" value="<?= $agentEdit['deadline']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">メールアドレス</th>
                        <td class="contact-body">
                            <input type="text" name="mail" class="form-text" value="<?= $agentEdit['mail']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">電話番号</th>
                        <td class="contact-body">
                            <input type="text" name="tel" class="form-text" value="<?= $agentEdit['tel']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">アピールポイント1（タイトル）</th>
                        <td class="contact-body">
                            <input type="text" name="apeal1" class="form-text" value="<?= $agentEdit['apeal1']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">アピールポイント1</th>
                        <td class="contact-body">
                            <input type="text" name="apeal1_content" class="form-text" value="<?= $agentEdit['apeal1_content']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">アピールポイント2（タイトル）</th>
                        <td class="contact-body">
                            <input type="text" name="apeal2" class="form-text" value="<?= $agentEdit['apeal2']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th class="contact-item">アピールポイント2</th>
                        <td class="contact-body">
                            <input type="text" name="apeal2_content" class="form-text" value="<?= $agentEdit['apeal2_content']; ?>" />
                        </td>
                    </tr>
                    <?php
                        $stmt = $db->prepare('SELECT distinct tag.* FROM edit_agent_tag inner join edit_agent ON edit_agent.id = edit_agent_tag.agent_id inner join tag ON tag.id = edit_agent_tag.tag_id where agent_name=:name');
                        $stmt->bindValue('name', $agentEdit['agent_name'], PDO::PARAM_STR);
                        $stmt->execute();
                        $tags = $stmt->fetchAll();
                        var_dump($tags);
                        ?>
                    <tr>
                        <th class="contact-item">タグ</th>
                        <td class="contact-body">
                                <div>
                                    <ul>
                                        <?php foreach ($tags as $tag) : ?>
                                            <li><?= $tag['tag_name'] ?></li>
                                            <input type="hidden" name="selected_tag[]" value="<?= $tag['tag_name'] ?>" class="form-text" />
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <!-- <tr>
                        <th class="contact-item">タグ</th>
                        <td id="input_pluralBox">
                            <div id="input_plural">
                                <div class="cp_ipselect form-control2">
                                    <?php
                                    // $stmt = $db->prepare('SELECT * FROM edit_agent_tag inner join edit_agent ON edit_agent.id = edit_agent_tag.agent_id inner join tag ON tag.id = edit_agent_tag.tag_id where agent_name=:name');
                                    // $stmt->bindValue('name', $agentEdit['agent_name'], PDO::PARAM_STR);
                                    // $stmt->execute();
                                    // $tags = $stmt->fetchAll(); ?>
                                    <?php foreach ($tags as $tag) : ?>
                                        <select name="tag[]" id="tag2">
                                            <?php foreach ($alltags as $alltag) :
                                                $alltag['tag_name'] == $tag['tag_name'] ?
                                                    $select = 'selected' : $select = '';
                                            ?>
                                                <option value="<?= $alltag['tag_name']; ?>" <?= $select; ?>><?= $alltag['tag_name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endforeach; ?>
                                </div>
                                <span class="cp_sl02_highlight"></span>
                                <span class="cp_sl02_selectbar"></span>
                                <input type="button" value="＋" class="add2 pluralBtn">
                                <input type="button" value="－" class="del2 pluralBtn">
                            </div>
                        </td>
                    </tr> -->
                </table>
                <div class="submit_section">
                    <input class="contact-submit" type="submit" value="承認" />
                    <input type="hidden" name="agent" value="<?= $agentEdit['id']; ?>">
                </div>
            </form>
            <form action="delete.php" method="get" class="contact-submit">
                <!-- <input type="image" src="../img/iconmonstr-trash-can-9-240.png"> -->
                <input class="contact-submit" type="submit" value="拒否" />
                <input type="hidden" name="delete" value="<?= $agentEdit['id']; ?>">
            </form>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <script>
        $(function() {
            $("#button1").click(function() {
                $.ajax({
                        url: "testform.php",
                        type: "POST",
                        data: $("#modal").serialize(),
                        dataType: "json",
                        timespan: 1000,
                    })
                    .done(function(data1, textStatus, jqXHR) {
                        $("#tagList").empty();
                        console.log(data1); // 登録しました

                        $.each(data1, function(index, value) {
                            $("#tagList").append('<li>'+value+'</li>' + '<input type="hidden" name="selected_tag[]" value="' + value + '"/>' );
                        })
                    })
                    .fail(function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.status); //例：404
                        console.log(textStatus); //例：error
                        console.log(errorThrown); //例：NOT FOUND
                    })
                    .always(function() {
                        // console.log("complete");
                    });
                // event.preventDefault();
                modal.style.display = 'none';
                $("#tagList2").empty();
            });
        });
    </script>

</bod>

</html>