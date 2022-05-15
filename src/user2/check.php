<?php
    $checks = $_POST['check'];
    $name = $_POST['name'];
    $katakana = $_POST['katakana'];
    $Tel = $_POST['Tel'];
    $mail = $_POST['mail'];
    $university = $_POST['university'];
    $faculty = $_POST['faculty'];
    $graduate = $_POST['graduate'];
    $home = $_POST['home'];
    $free = $_POST['free'];
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
    <div class="page">
      <?php if (isset($_GET['detail'])) : ?>
        <p>
          <a href="#" onclick="history.go(-4)">トップ</a>
          <span>></span>
          <a href="#" onclick="history.go(-3)"><?= $_GET['detail']; ?></a>
          <span>></span>
          <a href="#" onclick="history.go(-2)">カート</a>
          <span>></span>
          <a href="#" onclick="history.back()">申し込み</a>
          <span>></span>
          <span class="page_current">内容確認</span>
        </p>
      <?php else : ?>
        <p>
          <a href="#" onclick="history.go(-3)">トップ</a>
          <span>></span>
          <a href="#" onclick="history.go(-2)">カート</a>
          <span>></span>
          <a href="#" onclick="history.back()">申し込み</a>
          <span>></span>
          <span class="page_current">内容確認</span>
        </p>
      <?php endif; ?>
    </div>
    <!-- <div class="title">
      <img src="img/iconmonstr-handshake-7-240.png" alt="">
      <h1>申し込み</h1>
    </div> -->

    <section class="step">
      <img src="img/flow2.png" alt="">
    </section>

    <section class="check">
      <div class="agent-data">
        <h3>お申込みエージェント</h3>
        <ul>
          <?php foreach ($checks as $check) : ?>
            <li><?= $check; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <form action="thanks.php" method="post">
        <table class="">
          <tr>
            <th class="">お名前</th>
            <td class="">
              <h3><?= $name;?></h3>
              <input type="hidden" value="<?= $name;?>" name="name_check">
            </td>
          </tr>
          <tr>
            <th class="">カナ</th>
            <td class="">
              <h3><?= $katakana;?></h3>
              <input type="hidden" value="<?= $katakana;?>" name="katakana_check">
            </td>
          </tr>
          <tr>
            <th class="">Tel</th>
            <td class="">
              <h3><?= $Tel;?></h3>
              <input type="hidden" value="<?= $Tel;?>" name="Tel_check">
            </td>
          </tr>
          <tr>
            <th class="">mail</th>
            <td class="">
              <h3><?= $mail;?></h3>
              <input type="hidden" value="<?= $mail;?>" name="mail_check">
            </td>
          </tr>
          <tr>
            <th class="">大学名</th>
            <td class="">
              <h3><?= $university;?></h3>
              <input type="hidden" value="<?= $university;?>" name="university_check">
            </td>
          </tr>
          <tr>
            <th class="">学部・学科</th>
            <td class="">
              <h3><?= $faculty;?></h3>
              <input type="hidden" value="<?= $faculty;?>" name="faculty_check">
            </td>
          </tr>
          <tr>
            <th class="">卒業年</th>
            <td class="">
              <h3><?= $graduate;?></h3>
              <input type="hidden" value="<?= $graduate;?>" name="graduate_check">
            </td>
          </tr>
          <tr>
            <th class="">住所</th>
            <td class="">
              <h3><?= $home;?></h3>
              <input type="hidden" value="<?= $home;?>" name="home_check">
            </td>
          </tr>
          <tr>
            <th class="">自由記入欄</th>
            <td class="">
              <h3><?= $free;?></h3>
              <input type="hidden" value="<?= $free;?>" name="free_check">
            </td>
          </tr>
        </table>
        <?php foreach($checks as $check):?>
        <input type="hidden" value="<?= $check;?>" name="thanks[]">
        <?php endforeach;?>
        <input class="contact-submit" type="submit" value="申し込む" />
      </form>
    </section>
  </div>

</body>

</html>