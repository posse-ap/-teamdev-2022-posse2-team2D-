<?php
session_start();
require(dirname(__FILE__) . "/dbconnect.php");

$edit = $_GET['edit'];
// echo $edit;


if (isset($_GET['btn_logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();
    if (!empty($_POST)) {
        if (isset($_POST['name'])) {
            // ファイルへのパス
            $path = '../../client/img/';
            $name = $_POST['name'];
            $Tel = $_POST['Tel'];
            $mail = $_POST['mail'];
            $department_name = $_POST['department_name'];
            // $img = $_POST['img'];
            $stmt = $db->prepare('UPDATE `users` SET name=?, `department_name`=?, `tel`=?, `email`=?,`user_img`=? WHERE name=?');
            $stmt->bindValue(1, $name, PDO::PARAM_STR);
            $stmt->bindValue(2, $department_name, PDO::PARAM_STR);
            $stmt->bindValue(3, $Tel, PDO::PARAM_STR);
            $stmt->bindValue(4, $mail, PDO::PARAM_STR);
            $stmt->bindValue(5, $name, PDO::PARAM_STR);
            $stmt->bindValue(6, $edit, PDO::PARAM_STR);
            $stmt->execute();
        
            // ファイルがアップロードされているかと、POST通信でアップロードされたかを確認
            if (!empty($_FILES['img']['tmp_name']) && is_uploaded_file($_FILES['img']['tmp_name'])) {
        
                // ファイルを指定したパスへ保存する
                move_uploaded_file($_FILES['img']['tmp_name'], $path . $name . '.png');
            }
        }
                
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/admin_agency/edit.php?edit=' . $edit);
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}

$stmt = $db->prepare(
    "SELECT 
        *
    FROM 
        users
    WHERE
        name=?"
);
$stmt->bindValue(1, $edit, PDO::PARAM_STR);
$stmt->execute();
$user_info = $stmt->fetch();
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

    <div class="client_content">
        <div id="client_edit" class="section_content2">
            <!-- <div class="cliant_info"> -->
            <form class="cliant_info2" action="/admin/admin_agency/edit.php?edit=<?= $edit ?>" method="POST" enctype="multipart/form-data">
                <h2>info.</h2>
                <div>
                    <p>氏名</p>
                    <h3><input type="text" name="name" value="<?= $user_info['name'] ?>"></h3>
                    <p>メールアドレス</p>
                    <h3><input type="text" name="mail" value="<?= $user_info['email'] ?>"></h3>
                    <p>電話番号</p>
                    <h3><input type="text" name="Tel" value="<?= $user_info['tel'] ?>"></h3>
                    <p>部署</p>
                    <h3><input type="text" name="department_name" value="<?= $user_info['department_name'] ?>"></h3>
                </div>
                <div>
                    <label style="background-image: url('<?= "../../client/img/" . $user_info['name'] . ".png" ?>');">
                        <img id="preview3" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">
                        <input id="inputFile" name="img" type="file" accept="image/jpeg, image/png" onchange="previewImage(this);">
                    </label>
                    <span>選択されていません</span>
                    <input type="submit" value="確定">
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
            <!-- </div> -->
        </div>
    </div>

</body>

</html>