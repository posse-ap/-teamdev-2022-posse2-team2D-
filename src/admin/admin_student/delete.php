<?php  
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
session_name("admin");
session_start();
if(isset($_GET['btn_logout']) ) {
	unset($_SESSION['user_id']);
    unset($_SESSION['time']);
}
if (isset($_SESSION['user_id']) && $_SESSION['time'] + 60 * 60 * 24 > time()) {
    $_SESSION['time'] = time();

        $deleteAll = $_GET['deleteAll'];

$delete = $_POST['delete'] ;
$deleteUser = $_POST['deleteUser'];
if(isset($deleteAll)):
$stmt_delete = $db->prepare("delete from apply_info where id = '$deleteAll'");
$stmt_delete->execute();
header('Location: index.php'); 
exit();
else:
$stmt_delete = $db->prepare("delete from agent_user where agent_id = '$delete' and user_id = '$deleteUser'");
$stmt_delete->execute();
$stmt = $db->prepare("SELECT count(*) from agent_user where user_id =?");
$stmt->bindValue(1, $deleteUser, PDO::PARAM_STR);
$stmt->execute();
$exist = $stmt->fetch(PDO::FETCH_ASSOC);
if (intval($exist['count(*)'] == 0)) {
    $stmt_delete = $db->prepare("delete from apply_info where id = '$deleteUser'");
    $stmt_delete->execute();
    header('Location: index.php'); 
    exit();
}else{
    header('Location: detail.php?user='.$deleteUser.''); 
    exit();
}
endif;


        // header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/top.php');
        // exit();
    }

// $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
// $stmt = $db->prepare('delete from study where id=?');
// $stmt->bind_param('i',$id);
// $stmt->execute();
// $selectDate = filter_input(INPUT_GET,'nengetu',FILTER_SANITIZE_SPECIAL_CHARS);
