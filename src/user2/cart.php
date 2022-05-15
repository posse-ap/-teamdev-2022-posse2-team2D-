<?php
$raw = file_get_contents('php://input'); // POSTされた生のデータを受け取る
$data = json_decode($raw); // json形式をphp変数に変換

$res = $data; // やりたい処理

// echoすると返せる
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="reset.css">
  <scrip defer src="cart.js"></script>
</head>
<body>
<header>
    <div class="search2">
      <form class="search2-box" action="top.php" method="get">
        <input type="text" placeholder="検索" name="search">
        <button class="search2-box_icon" type="submit">
        </button>
      </form>
    </div>
    <h1><img src="img/就活の教科書.webp" alt=""></h1>
    <nav>
      <li>就活サイト</li>
      <li>就活支援サービス</li>
      <li>自己分析診断ツール</li>
      <li>ES添削サービス</li>
      <li>就活エージェント</li>
    </nav>
    <div class="close"><img src="img/iconmonstr-x-mark-11-240.png" alt=""></div>
    <div class="open"><img src="img/iconmonstr-arrow-down-circle-lined-240.png" alt=""></div>
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
          <div class="search">
            <form class="search-box" action="top.php" method="get">
              <input type="text" placeholder="検索" name="search">
              <button class="search-box_icon" type="submit">
              </button>
            </form>
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
<div class="home">
<div class="page to-cart">
<?php if(isset($_GET['detail'])):?>
  <p>
  <a href="#" onclick="history.go(-2)">トップ</a>
  <span>></span>
  <a href="#" onclick="history.back()"><?= $_GET['detail'];?></a>
  <span>></span>
  <span class="page_current">カート</span>
  </p>
  <?php else: ?>
  <p>
  <a href="#" onclick="history.back()">トップ</a>
  <span>></span>
  <span class="page_current">カート</span>
  </p>
  <?php endif; ?>
</div>
<div class="cart-container">
<section class="step">
      <img src="img/flow0.png" alt="">
    </section>
</div>
<section class="carts">
  <h4 class="carts-title">カート確認</h4>
  <ul id="carts_list">

  </ul>
  <p class="carts-count">企業数:<span class="count"></span></p>
  <!-- <p class="cart-inquiry">※申し込み後3日後になってもエージェ
    ンシーから連絡がなかった場合、こち
    らにお問い合わせください</p> -->
    <form action="apply.php" method="get" class="form">
      <!-- <button type="submit">申し込む</button> -->
      <input type="hidden" value="<?= $_GET['detail'];?>" name="detail">
    </form>
  <p class="none">カートに何も入っていません</p>
</section>
</div>
<input type="submit" value="一覧に戻る" class="no cart_no" onclick="history.back()">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="cart.js"></script>
</body>
</html>