<?php
session_start();
$dsn = 'mysql:host=db;dbname=db_mydb;charset=utf8;';
$user = 'db_user';
$password = 'password';
try {
  $db = new PDO($dsn, $user, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo '接続失敗: ' . $e->getMessage();
  exit();
}
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
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/client_student/index.php');
    exit();
  }
} else {
  header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/login.php');
  exit();
}

$selected = $_GET['nengetu'] == 'all' ? 'selected' : '';

date_default_timezone_set('Asia/Tokyo');
if (isset($_GET['nengetu'])) {
  $selectday = $_GET['nengetu'];
} else {
  $selectday = date('Y-m');
}
$agent =  $_SESSION['agent_name'];
$search = $_GET['search'];
$like = $selectday . '%';

$now = date('Y-m');
$deadline = new DateTime($now);
$deadline->modify('+1 months');

$graduate = substr($now, 2, 2);  
$confirm = substr($_GET['search_grad'],0,2);

$stmt_count = $db->prepare("SELECT count(agent_name) FROM agent_user JOIN apply_info ON apply_info.id = agent_user.user_id JOIN agent ON agent.id = agent_user.agent_id  where agent_name = '$agent' and created_at like '$like'");
$stmt_count->execute();
$count = $stmt_count->fetch();

$student = $count['count(agent_name)'];
if (!isset($nengetu)) {
  $nengetu = '';
}

// echo $_SESSION['agent_name'];

$search_date_sra = $_GET['search_date'];
$search_date = str_replace('/', '-', $search_date_sra);
$like_search = $search_date . '%';
if (isset($_GET['search_name']) && strlen($_GET['search_grad']) == 0 && strlen($search_date) == 0) :
  $search_n = $_GET['search_name'];
  $sea_n = '%' . $search_n . '%';
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and created_at like '$like' and name like '$sea_n' or kana like '$sea_n' order by created_at desc");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_grad']) && strlen($_GET['search_name']) == 0 && strlen($search_date) == 0) :
  $search_g = $_GET['search_grad'];
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and created_at like '$like' and graduate_year = '$search_g' order by created_at desc");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_name']) && isset($_GET['search_grad']) && strlen($search_date) == 0) :
  $search_n = $_GET['search_name'];
  $search_g = $_GET['search_grad'];
  $sea_n = '%' . $search_n . '%';
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and created_at like '$like'and name like ? or kana like ? and graduate_year = ? order by created_at desc");
  $apply_info_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(2, $sea_n, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(3, $search_g, PDO::PARAM_STR);
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($search_date) && strlen($_GET['search_name']) == 0 && strlen($_GET['search_grad']) == 0) :
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user JOIN agent ON agent.id = agent_user.agent_id RIGHT JOIN apply_info ON apply_info.id = agent_user.user_id where agent_name = '$agent' and created_at like '$like' and created_at like '$like_search' order by created_at desc");
  $apply_info_stmt->execute();
  $apply_infos =  $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_name']) && isset($search_date) && strlen($_GET['search_grad']) == 0) :
  $search_n = $_GET['search_name'];
  $sea_n = '%' . $search_n . '%';
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and created_at like '$like' and name like ? or kana like ? and created_at like ? order by created_at desc");
  $apply_info_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(2, $sea_n, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(3, $like_search, PDO::PARAM_STR);
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_grad']) && isset($search_date) && strlen($_GET['search_name']) == 0) :
  $search_g = $_GET['search_grad'];
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and created_at like '$like' and graduate_year = ? and created_at like ? order by created_at desc");
  $apply_info_stmt->bindValue(1, $search_g, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(2, $like_search, PDO::PARAM_STR);
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
elseif (isset($_GET['search_name']) && isset($_GET['search_grad']) && isset($search_date)) :
  $search_n = $_GET['search_name'];
  $search_g = $_GET['search_grad'];
  $sea_n = '%' . $search_n . '%';
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and created_at like '$like' and name like ? or kana like ? and graduate_year = ? and created_at like ? order by created_at desc");
  $apply_info_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(2, $sea_n, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(3, $search_g, PDO::PARAM_STR);
  $apply_info_stmt->bindValue(4, $like_search, PDO::PARAM_STR);
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
else :
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and created_at like '$like' order by created_at desc");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
endif;

if (strlen($_GET['search_grad']) == 0 && strlen($_GET['search_name']) == 0 && strlen($search_date) == 0) {
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and created_at like '$like' order by created_at desc");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();
}


if ($_GET['nengetu'] == 'all') {
  $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' order by created_at desc");
  $apply_info_stmt->execute();
  $apply_infos = $apply_info_stmt->fetchAll();

  $stmt_count = $db->prepare("SELECT count(agent_name) FROM agent_user JOIN apply_info ON apply_info.id = agent_user.user_id JOIN agent ON agent.id = agent_user.agent_id  where agent_name = '$agent' order by created_at desc");
  $stmt_count->execute();
  $count = $stmt_count->fetch();

  $student = $count['count(agent_name)'];
  if (isset($_GET['search_name']) && strlen($_GET['search_grad']) == 0 && strlen($search_date) == 0) :
    $search_n = $_GET['search_name'];
    $sea_n = '%' . $search_n . '%';
    $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and name like '$sea_n' or kana like '$sea_n' order by created_at desc");
    $apply_info_stmt->execute();
    $apply_infos = $apply_info_stmt->fetchAll();
  elseif (isset($_GET['search_grad']) && strlen($_GET['search_name']) == 0 && strlen($search_date) == 0) :
    $search_g = $_GET['search_grad'];
    $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent'and graduate_year = '$search_g' order by created_at desc");
    $apply_info_stmt->execute();
    $apply_infos = $apply_info_stmt->fetchAll();
  elseif (isset($_GET['search_name']) && isset($_GET['search_grad']) && strlen($search_date) == 0) :
      $search_n = $_GET['search_name'];
      $search_g = $_GET['search_grad'];
      $sea_n = '%' . $search_n . '%';
      $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent'and name like ? or kana like ? and graduate_year = ? order by created_at desc");
      $apply_info_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
      $apply_info_stmt->bindValue(2, $sea_n, PDO::PARAM_STR);
      $apply_info_stmt->bindValue(3, $search_g, PDO::PARAM_STR);
      $apply_info_stmt->execute();
      $apply_infos = $apply_info_stmt->fetchAll();
  elseif (isset($search_date) && strlen($_GET['search_name']) == 0 && strlen($_GET['search_grad']) == 0) :
    $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user JOIN agent ON agent.id = agent_user.agent_id RIGHT JOIN apply_info ON apply_info.id = agent_user.user_id where agent_name = '$agent'and created_at like '$like_search' order by created_at desc");
    $apply_info_stmt->execute();
    $apply_infos =  $apply_info_stmt->fetchAll();
  elseif (isset($_GET['search_name']) && isset($search_date) && strlen($_GET['search_grad']) == 0) :
      $search_n = $_GET['search_name'];
      $sea_n = '%' . $search_n . '%';
      $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and name like ? or kana like ? and created_at like ? order by created_at desc");
      $apply_info_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
      $apply_info_stmt->bindValue(2, $sea_n, PDO::PARAM_STR);
      $apply_info_stmt->bindValue(3, $like_search, PDO::PARAM_STR);
      $apply_info_stmt->execute();
      $apply_infos = $apply_info_stmt->fetchAll();
  elseif (isset($_GET['search_grad']) && isset($search_date) && strlen($_GET['search_name']) == 0) :
      $search_g = $_GET['search_grad'];
      $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and graduate_year = ? and created_at like ? order by created_at desc");
      $apply_info_stmt->bindValue(1, $search_g, PDO::PARAM_STR);
      $apply_info_stmt->bindValue(2, $like_search, PDO::PARAM_STR);
      $apply_info_stmt->execute();
      $apply_infos = $apply_info_stmt->fetchAll();
  elseif (isset($_GET['search_name']) && isset($_GET['search_grad']) && isset($search_date)) :
    $search_n = $_GET['search_name'];
    $search_g = $_GET['search_grad'];
    $sea_n = '%' . $search_n . '%';
    $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' and created_at like '$like' and name like ? or kana like ? and graduate_year = ? and created_at like ? order by created_at desc");
    $apply_info_stmt->bindValue(1, $sea_n, PDO::PARAM_STR);
    $apply_info_stmt->bindValue(2, $sea_n, PDO::PARAM_STR);
    $apply_info_stmt->bindValue(3, $search_g, PDO::PARAM_STR);
    $apply_info_stmt->bindValue(4, $like_search, PDO::PARAM_STR);
    $apply_info_stmt->execute();
    $apply_infos = $apply_info_stmt->fetchAll();
  else :
    $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' order by created_at desc");
    $apply_info_stmt->execute();
    $apply_infos = $apply_info_stmt->fetchAll();
  endif;

  if (strlen($_GET['search_grad']) == 0 && strlen($_GET['search_name']) == 0 && strlen($search_date) == 0) {
    $apply_info_stmt = $db->prepare("SELECT distinct apply_info.* FROM agent_user inner JOIN apply_info ON agent_user.user_id=apply_info.id inner JOIN agent ON agent_user.agent_id=agent.id WHERE agent_name = '$agent' order by created_at desc");
    $apply_info_stmt->execute();
    $apply_infos = $apply_info_stmt->fetchAll();
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
  <link rel="stylesheet" href="../reset.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
</head>

<body>
  <header>
    <div class="header_top">
      <h1>就活の教科書 <span>クライアント画面</span></h1>
      <nav>
        <a href="../top.php" class="top">トップ</a>
        <a href="../client_agent/index.php" class=" agent">掲載情報</a>
        <a href="../client_student/index.php" class="student page_focus">学生情報</a>
        <a href="../client_agency/index.php" class="manage">担当者管理</a>
        <a href="../client_add/index.php" class="agency">担当者追加</a>
        <a href="../client_application/index.php" class="editer">編集申請</a>
        <a href="../client_inquiry/index.php" class="call ">お問い合わせ</a>
      </nav>
    </div>
    <div class="header_bottom">
      <form method="get" action="">

        <input type="submit" name="btn_logout" value="ログアウト">
      </form>
    </div>
  </header>

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

          echo '<select name="nengetu" onchange="submit(this.form)"    class="nengetu">' . $nengetu . '<option value="all"' . $selected . '>過去すべて</option>' . '</select>'; ?>
        </form>のお申込み状況
      </h3>
    </div>
    <section class="invoice_info">
      <h2>お申し込み学生数</h2>
      <h2 class="number"><?= $student; ?></h2>
      <h2>請求金額</h2>
      <h2 class="number"><?= $student * 5000; ?>円</h2>
    </section>
  </div>

  <div class="section_top2">
    <!-- <h1>学生情報</h1> -->
  </div>

  <div class="section_content">
    <section class="section_side">
      <div>
        <button>ダウンロード</button>
        <h3>請求日:<br><span><?= $deadline->format('Y-m'); ?>-03</span></h3>
        <h3>支払期日:<br><span><?= $deadline->format('Y-m'); ?>-10</span></h3>
      </div>
      <div>
        <div>
          <a href="../client_inquiry/index.php">いたづら、重複など見つけた場合</a>
        </div><br>
        <p>⚠ 迷惑ユーザー、重複の対応については、月末の翌日まで受け付けます</p>
      </div>
    </section>

    <div class="main_box">
      <div class="form">
        <form method="get" action="index.php" class="search_container">
          <input class="search_space" type="text" size="20" placeholder="学生氏名" name="search_name">
          <!-- <input class="search_space" type="text" size="20" placeholder="卒業年 （○○卒)" name="search_grad"> -->
          <select name="search_grad" id="graduate">
            <option value="">卒業年を選択</option>
            <?php for($i=0;$i<6;$i++){
              $graduation = $graduate+$i ;
              $selected = $graduation == $confirm ? 'selected' : ''
              ;?>
              <option value="<?= $graduation;?>卒"><?= $graduation;?>卒</option>
            <?php }?>
          </select>
          <input type="date" size="20" placeholder="" name="search_date">
          <input type="hidden" value="<?= $selectday ;?>" name="nengetu">
          <input class="search_button" type="submit" value="検索">
        </form>
        <form action="index.php">
          <button type="submit" class="clear">クリア</button>
        </form>
      </div>
      <div class="wrap">
        <table border="1">
          <thead>
            <tr>
              <th scope="col" class="middle">お名前</th>
              <th scope="col" class="wide">メールアドレス</th>
              <th scope="col">電話番号</th>
              <th scope="col">大学名</th>
              <th scope="col">学部学科</th>
              <th scope="col" class="narrow">卒業年</th>
              <th scope="col" class="wide">住所</th>
              <th scope="col">申込日</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($apply_infos as $key => $apply_info) {
              $theDate    = new DateTime($apply_info["created_at"]);
              $stringDate = $theDate->format('Y-m-d');
            ?>
              <tr>
                <td class="price"><?php echo $apply_info["name"] ?></td>
                <td class="price"><?php echo $apply_info["email"] ?></td>
                <td class="price"><?php echo $apply_info["tel"] ?></td>
                <td class="price"><?php echo $apply_info["college"] ?></td>
                <td class="price"><?php echo $apply_info["faculty"] ?></td>
                <td class="price"><?php echo $apply_info["graduate_year"] ?></td>
                <td class="price"><?php echo $apply_info["adress"] ?></td>
                <td class="price"><?php echo $stringDate ?></td>
              </tr>
            <?php } ?>
            <!-- <p class="none">該当する学生がいません</p> -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="script.js"></script>
  <script>
    const nengetu = document.querySelector('.nengetu');
    const date = document.querySelector('input[name="search_date"]')
    const past = document.querySelector('.past');
    const all = document.querySelector('.all');
    <?php if ($_GET['nengetu'] !== 'all') : ?>
      date.style.display = 'none';
    <?php endif; ?>
    // const nothing = document.querySelector('.none');
    // <?php if (!isset($apply_infos)) : ?>
    //   nothing.style.display = 'block'
    // <?php endif; ?>
  </script>
</body>

</html>