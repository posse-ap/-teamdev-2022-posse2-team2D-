<?php
session_name("admin");
session_start();
if (isset($_GET['btn_logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

    if (!empty($_POST)) {
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin_agency/delete.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
// $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
// $stmt = $db->prepare('delete from study where id=?');
// $stmt->bind_param('i',$id);
// $stmt->execute();
// $selectDate = filter_input(INPUT_GET,'nengetu',FILTER_SANITIZE_SPECIAL_CHARS);
$delete = $_GET['delete'];

$stmt = $db->prepare("select * from users where id = '$delete'");
$stmt->execute();
$cnts = $stmt->fetchAll();

$stmt_delete = $db->prepare("delete from users where id = '$delete'");
$stmt_delete->execute();



$path = '../../client/img/';
$file = $path . $cnts[0]['name'] . '.png';

if (isset($file)) {
    //ファイルを削除する
    if (unlink($file)) {
        header('Location: index.php'); 
        exit();
    } else {
        echo $file . 'の削除に失敗しました。';
    }
}


?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="delete">
        <!-- <input type="submit" value="戻る" class="no" onclick="history.back()"> -->
        <a href="../admin_agency/index.php">戻る</a>
    </section>
</body>

</html>
