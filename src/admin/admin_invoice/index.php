<?php
// ini_set('display_errors', 1);
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

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin_invoice/index.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/admin/login.php');
    exit();
}
$now = date('Y-m');
$graduate = substr($now, 2, 2);
$confirm = substr($_GET['search_grad'], 0, 2);
$gra = $_GET['search_grad'];

date_default_timezone_set('Asia/Tokyo');
if (isset($_GET['nengetu'])) {
    $selectday = $_GET['nengetu'];
} else {
    $selectday = date('Y-m');
}
$agent =  $_GET['agent'];
$search = $_GET['search'];
$sea = '%' . $search . '%';
$like = $selectday . '%';
if (!isset($_GET['search_grad'])) :
    $stmt = $db->prepare("SELECT * FROM agent_user JOIN agent ON agent.id = agent_user.agent_id RIGHT JOIN apply_info ON apply_info.id = agent_user.user_id where agent_name = '$agent' and created_at like '$like'");
    $stmt->execute();
    $cnts = $stmt->fetchAll();
elseif (strlen($_GET['search_grad']) == 0) :
    $stmt = $db->prepare("SELECT * FROM agent_user JOIN agent ON agent.id = agent_user.agent_id RIGHT JOIN apply_info ON apply_info.id = agent_user.user_id where agent_name = '$agent' and created_at like '$like'");
    $stmt->execute();
    $cnts = $stmt->fetchAll();
else :
    $stmt = $db->prepare("SELECT * FROM agent_user JOIN agent ON agent.id = agent_user.agent_id RIGHT JOIN apply_info ON apply_info.id = agent_user.user_id where agent_name = '$agent' and created_at like '$like' and graduate_year = '$gra'");
    $stmt->execute();
    $cnts = $stmt->fetchAll();
endif;

$now = date('Y-m');
$deadline = new DateTime($now);
$deadline->modify('+1 months');

$stmt_count = $db->prepare("SELECT count(agent_name) FROM agent_user JOIN agent ON agent.id = agent_user.agent_id RIGHT JOIN apply_info ON apply_info.id = agent_user.user_id where agent_name = '$agent' and created_at like '$like'");
$stmt_count->execute();
$count = $stmt_count->fetch();


$student = $count['count(agent_name)'];
if (!isset($nengetu)) {
    $nengetu = '';
}
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
                <li><a href="../top.php">トップ</a></li>
                <li><a href="../admin_student/index.php">お申込履歴</a></li>
                <li><a href="../admin_company/index.php" class="page_focus">企業管理</a></li>
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
            <span class="page_current">請求情報</span>
        </p>
    </div>


    <div class="section_top">
        <div>
            <h3>
                <form action="index.php?" method="get">
                    <input type="hidden" value="<?= $_GET['agent']; ?>" name="agent">
                    <?php
                    $nowMonth = date('m');
                    $nowYear = date("Y");
                    for ($i = $nowYear - 2; $i <= $nowYear; $i++) {
                        for ($ii = 1; $ii < 13; $ii++) {
                            if ($i . '-' . $dd == date('Y-m')) {
                                break;
                            }
                            $dd = sprintf('%002d', $ii);
                            if ($i . '-' . $dd == $selectday) {
                                if ($dd == 12) {
                                    $one = 1;
                                    $zeroOne = sprintf('%002d', $one);
                                    $afterYear = $i + 1;
                                    $afterMonth1 = str_replace($i, $afterYear, $selectday);
                                    $afterMonth = str_replace('-' . $dd, '-' . $zeroOne, $afterMonth1);
                                    $before = $dd - 1;
                                    $before2 = sprintf('%002d', $before);
                                    $beforeMonth = str_replace('-' . $dd, '-' . $before2, $selectday);
                                } elseif ($dd == 1) {
                                    $twelve = 12;
                                    $beforeYear = $i - 1;
                                    $beforeMonth1 = str_replace($i, $beforeYear, $selectday);
                                    $beforeMonth = str_replace('-' . $dd, '-' . $twelve, $beforeMonth1);
                                    $after = $dd + 1;
                                    $after2 = sprintf('%002d', $after);
                                    $afterMonth = str_replace('-' . $dd, '-' . $after2, $selectday);
                                } else {
                                    $after = $dd + 1;
                                    $after2 = sprintf('%002d', $after);
                                    $afterMonth = str_replace('-' . $dd, '-' . $after2, $selectday);
                                    $before = $dd - 1;
                                    $before2 = sprintf('%002d', $before);
                                    $beforeMonth = str_replace('-' . $dd, '-' . $before2, $selectday);
                                }
                                $nengetu .= '<option value="' . $selectday . '" selected >' . $i . '年' . $dd . '月</option>';
                            } else {
                                $nengetu .= '<option value="' . $i . '-' . $dd . '">' . $i . '年' . $dd . '月</option>';
                            }
                        }
                    }

                    // echo $nengetu;

                    echo '<select name="nengetu" onchange="submit(this.form)">' . $nengetu . '</select>'; ?>
                </form>
            </h3>
        </div>
        <div class="section_header">
            <section class="invoice_info">
                <h2>お申し込み学生数</h2>
                <h2 class="number"><?= $student; ?></h2>
                <h2>請求金額</h2>
                <h2 class="number"><?= $student * 5000; ?>円</h2>
            </section>
        </div>
    </div>


    <div class="section_content">
        <div class="side">
            <div class="agent_name">
                <h3 class="agent_name">企業名</h3>
                <!-- <form action=""><h2><input class="big_search_space" type="text" placeholder="企業名を入力してください" value="マイナビ"></h2></form> -->
                <h2 class="agent"><?= $_GET['agent']; ?></h2>
            </div>
            <section class="section_side">
                <div>
                    <h3>請求日:<br><span><?= $deadline->format('Y-m'); ?>-03</span></h3>
                    <h3>支払期日:<br><span><?= $deadline->format('Y-m'); ?>-10</span></h3>
                </div>
                <button>情報文書化</button>
            </section>
        </div>

        <div class="main_box">
            <div class="form">
                <form class="search_container" action="index.php" method="get">
                    <select class="search_select" name="search_grad" id="graduate" onchange="submit(this.form)">
                        <option value="">卒業年を選択</option>
                        <?php for ($i = 0; $i < 6; $i++) {
                            $graduation = $graduate + $i;
                            $selected = $graduation == $confirm ? 'selected' : ''; ?>
                            <option value="<?= $graduation; ?>卒" <?= $selected; ?>><?= $graduation; ?>卒</option>
                        <?php } ?>
                    </select>
                    <input type="hidden" value="<?= $_GET['agent']; ?>" name="agent">
                    <input type="hidden" value="<?= $selectday; ?>" name="nengetu">
                </form>
                <form action="index.php" method="get">
                    <input type="submit" value="クリア">
                    <input type="hidden" value="<?= $_GET['agent']; ?>" name="agent">
                    <input type="hidden" value="<?= $selectday; ?>" name="nengetu">
                </form>
            </div>

            <div class="section_main">
                <div class="wrap">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col" class="middle">お名前</th>
                                <th scope="col" class="wide">メールアドレス</th>
                                <th scope="col">電話番号</th>
                                <th scope="col" class="narrow">卒業年</th>
                                <th scope="col" class="wide">住所</th>
                                <th scope="col">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cnts as $cnt) : ?>
                                <tr>
                                    <td><?= $cnt['name']; ?></td>
                                    <td class="price"><?= $cnt['email']; ?></td>
                                    <td class="price"><?= $cnt['tel']; ?></td>
                                    <td class="price"><?= $cnt['graduate_year']; ?></td>
                                    <td class="price"><?= $cnt['adress']; ?></td>
                                    <td class="price">
                                        <form action="select.php" method="post">
                                            <input type="image" src="../img/iconmonstr-trash-can-9-240.png" class="trash-can">
                                            <input type="hidden" value="<?= $cnt['id']; ?>" name="deleteUser">
                                            <input type="hidden" value="<?= $agent; ?>" name="delete">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>






</body>

</html>
<?php
