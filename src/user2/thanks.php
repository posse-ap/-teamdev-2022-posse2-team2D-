<?php
  require(dirname(__FILE__) . "/dbconnect.php");
  ini_set('display_errors', 1);
$thanks = $_POST['thanks'];
$name_check = $_POST['name_check'];
$katakana_check = $_POST['katakana_check'];
$Tel_check = $_POST['Tel_check'];
$mail_check = $_POST['mail_check'];
$university_check = $_POST['university_check'];
$faculty_check = $_POST['faculty_check'];
$graduate_check = $_POST['graduate_check'];
$home_check = $_POST['home_check'];
$free_check = $_POST['free_check'];
date_default_timezone_set('Asia/Tokyo');
$time = date('Y-m-d',time());

$stmt = $pdo->prepare(
    'INSERT INTO 
    `apply_info` (
        `name`,
        `kana`,
        `tel`,
        `mail`,
        `college`,
        `faculty`,
        `graduate_year`,
        `adress`,
        `date`
    ) 
VALUES
    (?,?,?,?,?,?,?,?,? )
'
);
$stmt->bindValue(1, $name_check, PDO::PARAM_STR);
$stmt->bindValue(2,$katakana_check,PDO::PARAM_STR);
$stmt->bindValue(3, $Tel_check, PDO::PARAM_STR);
$stmt->bindValue(4, $mail_check, PDO::PARAM_STR);
$stmt->bindValue(5, $university_check, PDO::PARAM_STR);
$stmt->bindValue(6, $faculty_check, PDO::PARAM_STR);
$stmt->bindValue(7, $graduate_check, PDO::PARAM_STR);
$stmt->bindValue(8, $home_check, PDO::PARAM_STR);
$stmt->bindValue(9,$time,PDO::PARAM_STR);
$stmt->execute();

$stmt_user = $pdo->prepare("select id from apply_info where name = '$name_check'");
$stmt_user->execute();
$users = $stmt_user->fetch();
$user = $users['id'];

foreach($thanks as $thank):
$stmt_id = $pdo->prepare("select id from agent where agent_name = '$thank'");
$stmt_id->execute();
$ids = $stmt_id->fetch();
$id = $ids['id'];


$stmt_relation = $pdo->prepare("insert into agent_user (agent_id,user_id) value ('$id','$user')");
$stmt_relation->execute();
endforeach;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="reset.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header>
    <h1><img src="img/就活の教科書.webp" alt="" /></h1>
    <nav>
      <li>就活サイト</li>
      <li>就活支援サービス</li>
      <li>自己分析診断ツール</li>
      <li>ES添削サービス</li>
      <li>就活エージェント</li>
    </nav>
    <div class="head">
      <button class="mobile-menu-icon" onclick="slider()">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
      </button>
      <div class="menu-content">
        <h1>Menu</h1>
        <div class="search">
          <h2 class="search-title">エージェント検索</h2>
          <div class="search-box">
            <input type="text" placeholder="検索" />
            <button class="search-box_icon" type="submit"></button>
          </div>
        </div>
        <form class="category" action="top.php" method="get">
          <p class="category-title">絞り込み条件</p>
          <div class="category-box">
            <p>サービス内容</p>
            <label>
              <input type="checkbox" class="checkbox" value="面接対策" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              面接対策
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="ES添削" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              ES添削
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="1on1" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              1on1
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="非公開求人" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              非公開求人
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="スケジュール管理" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              スケジュール管理
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="オンライン" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              オンライン
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="対面" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              対面
            </label>
            <p>得意分野</p>
            <label>
              <input type="checkbox" class="checkbox" value="IT" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              IT
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="マスコミ" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              マスコミ
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="商社" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              商社
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="金融" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              金融
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="外資" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              外資
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="総合" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              総合
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="スタートアップ" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              スタートアップ
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="ベンチャー" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              ベンチャー
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="大手" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              大手
            </label>
            <p>拠点</p>
            <label>
              <input type="checkbox" class="checkbox" value="首都圏" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              首都圏
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="関西" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              関西
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="地方" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              地方
            </label>
          </div>
          <div class="shuffle">
            <p>並び変える</p>
            <div class="shuffle-box">
              <select name="shuffle" id="">
                <option value="agent_name" selected>選択してください</option>
                <option value="publisher">掲載社数</option>
                <option value="decision">内定実績</option>
                <option value="speed">スピード</option>
                <option value="registstrant">登録者数</option>
                <option value="place">拠点数</option>
              </select>
            </div>
          </div>
          <button type="submit" class="submit">検索</button>
        </form>
        <form action="top.php?shuffle=agent_name">
          <button type="submit" class="clear">クリア</button>
        </form>
        <div class="navigation">
          <li>就活サイト</li>
          <li>就活支援サービス</li>
          <li>自己分析診断ツール</li>
          <li>ES添削サービス</li>
          <li>就活エージェント</li>
        </div>
      </div>
    </div>
  </header>
  <div class="container">
    <div class="title">
      <img src="img/iconmonstr-handshake-7-240.png" alt="">
      <h1>申し込み</h1>
    </div>

    <section class="step">
      <img src="img/flow3.png" alt="">
    </section>

    <section class="success">
      <h1><span>Success!</span></h1>
      <h1>ご登録ありがとうございます！</h1>
    </section>

    <div class="link">
      <a href="top.php">エージェント企業をもっと見る</a>
    </div>
  </div>

  <script src="clear.js"></script>
</body>

</html>