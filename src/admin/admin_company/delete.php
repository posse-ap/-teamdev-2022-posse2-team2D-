<?php
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
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

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin_company/delete.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}
// $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
// $stmt = $db->prepare('delete from study where id=?');
// $stmt->bind_param('i',$id);
// $stmt->execute();
// $selectDate = filter_input(INPUT_GET,'nengetu',FILTER_SANITIZE_SPECIAL_CHARS);

$stmt = $db->prepare("select id from agent where agent_name = '$delete'");
$stmt->execute();
$id = $stmt->fetch();
$agent_id = $id[0];

$stmt_delete_agency = $db->prepare("delete from users where agent_id = '$agent_id'");
$stmt_delete_agency->execute();


$stmt_delete = $db->prepare("delete from agent where agent_name = '$delete'");
$stmt_delete->execute();

$path = '../../user/img/';
$file = $path . $delete . '.png';

if (file_exists($file)) {
    //ファイルを削除する
    if (unlink($file)) {
        header('Location: index.php');
        exit();
    } else {
        echo $file . 'の削除に失敗しました。';
    }
}


