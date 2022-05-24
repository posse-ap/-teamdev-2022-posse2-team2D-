<?php  
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
session_start();
if(isset($_GET['btn_logout']) ) {
	unset($_SESSION['user_id']);
    unset($_SESSION['time']);
    // header("Location: " . $_SERVER['PHP_SELF']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}
// $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
// $stmt = $db->prepare('delete from study where id=?');
// $stmt->bind_param('i',$id);
// $stmt->execute();
// $selectDate = filter_input(INPUT_GET,'nengetu',FILTER_SANITIZE_SPECIAL_CHARS);

$deleteAll = $_GET['deleteAll'];

$delete = $_POST['delete'] ;
$deleteUser = $_POST['deleteUser'];
if(isset($deleteAll)):
$stmt_delete = $db->prepare("delete from apply_info where id = '$deleteAll'");
$stmt_delete->execute();

else:
$stmt_delete = $db->prepare("delete from agent_user where agent_id = '$delete' and user_id = '$deleteUser'");
$stmt_delete->execute();
// $cnt = $stmt_delete->fetch();
endif;
header('Location: index.php'); 
exit();
