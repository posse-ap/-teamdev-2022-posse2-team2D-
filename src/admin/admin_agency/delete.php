<?php  
session_start();
if(isset($_GET['btn_logout']) ) {
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
$delete = $_GET['delete'] ;
$stmt_delete = $db->prepare("delete from users where name = '$delete'");
$stmt_delete->execute();
// $cnt = $stmt_delete->fetch();

header('Location: index.php'); 
exit();