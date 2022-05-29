<?php
ini_set('display_errors', 1);
require(dirname(__FILE__) . "/dbconnect.php");
//jsに返すデータ。今回は簡略化のためにDBから取得はせず、単に配列とする。
// $animals = ["cat","dog"];
// $fruits = ["apple","orange"];

//AjaxでPost送信された値を受け取る
  // $stmt_uno = $db->prepare("select * from agent where agent_name='$agent'");
  // $stmt_uno->execute();
  // $unos = $stmt_uno->fetch();
$stmt_all = $db->prepare("select * from agent");
$stmt_all->execute();
$all = $stmt_all->fetchAll();
//処理終了
// exit;
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="reset.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@1,700&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Noto+Serif:ital,wght@1,700&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
  <script
  src="https://code.jquery.com/jquery-1.12.4.js"
  integrity="sha256-Qw82+bXyGq6MydymqBxNPYTaUXXq7c8v3CwiYwLLNXU="
  crossorigin="anonymous"></script>
  <script defer src="main.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Crete+Round&family=Koulen&family=Lobster&family=Permanent+Marker&family=Supermercado+One&family=Varela+Round&display=swap" rel="stylesheet">
</head>

<body>
  <div class="black"></div>
  <header>
    <div class="search2">
      <form class="search2-box" action="top.php" method="get">
        <input type="text" placeholder="検索" name="search">
        <!-- <input type="hidden" name="agent" value="<?= $_GET['agent']; ?>">
        <input type="hidden" name="agent2" value="<?= $_GET['agent2']; ?>"> -->
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
      <li>CRAFT</li>
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
              <input type="checkbox" class="checkbox" value="オンライン" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              オンライン
            </label>
            <label>
              <input type="checkbox" class="checkbox" value="対面" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              対面
            </label>
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
            <!-- <label>
              <input type="checkbox" class="checkbox" value="1on1" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              1on1
            </label> -->
            <label>
              <input type="checkbox" class="checkbox" value="非公開求人" name="narrow[]" />
              <span class="checkbox-fontas"></span>
              非公開求人
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
          <li>CRAFT</li>
        </div>
      </div>
    </div>
  </header>
  <section class="compareBar">
    <form action="top.php" method="post">
      <select name="agent" id="agent">
        <option value="選択してください">選択してください</option>
        <?php foreach ($alls as $all) : ?>
          <option value="<?= $all['agent_name']; ?>" <?= $_POST['agent'] == "$all[agent_name]" ? 'selected' : ''; ?>>
            <?= $all['agent_name']; ?>
          </option>
        <? endforeach; ?>
      </select>
      <img src="img/iconmonstr-arrow-left-circle-filled-240.png" alt="">
      <button class="btnCompare" type="button">比較する</button>
      <img src="img/iconmonstr-arrow-right-circle-filled-240 (1).png" alt="">
      <select name="agent2" id="agent2" >
        <option value="選択してください">選択してください</option>
        <?php foreach ($alls as $all) : ?>
          <option value="<?= $all['agent_name']; ?>" <?= $_GET['agent2'] == "$all[agent_name]" ? 'selected' : ''; ?>>
            <?= $all['agent_name']; ?>
          </option>
        <? endforeach; ?>
      </select>
    </form>
  </section>
  <img src="img/iconmonstr-help-3-240.png" alt="" class="help">
  <div class="modal">
    <div class="closeBtn">
      <img src="img/iconmonstr-x-mark-6-240.png" alt="">
    </div>
    <div class="modal-cart">
      <h2>カート機能について</h2>
      <div class="step">
        <div class="step-1 steps">
          <h4>Step1</h4>
          <p>カートに入れる</p>
          <img src="img/items.png" alt="">
        </div>
        <div class="step-2 steps">
          <h4>Step2</h4>
          <p>カートボタンを押す</p>
          <img src="img/cartcheck.png" alt="">
        </div>
        <div class="step-3 steps">
          <h4>Step3</h4>
          <p>申し込みページへ</p>
          <img src="img/applycheck.png" alt="">
        </div>
      </div>
    </div>
    <div class="modal-compare">
      <h2>比較機能について</h2>
      <div class="step">
        <div class="step-1 steps">
          <h4>Step1</h4>
          <p>企業を選択</p>
          <img src="img/select.png" alt="">
        </div>
        <div class="step-2 steps">
          <h4>Step2</h4>
          <p>比較ボタンを押す</p>
          <img src="img/comparecheck.png" alt="">
        </div>
        <div class="step-3 steps">
          <h4>Step3</h4>
          <p>企業を比較</p>
          <img src="img/comparedisplay.png" alt="">
        </div>
      </div>
    </div>
  </div>
  <div class="main">
    <article>
      <section class="first">
        <div class="first-logo">
          <img src="img/logo.png" alt="">
          <h1>CRAFT</h1>
        </div>
        <h4>CRAFTは学生とエージェント企業をつなげ、学生の就活をサポートするサービスです!</h4>
      </section>
      <!-- <div class="white"></div> -->
      <section class="stepBox">
        <h2>簡単申し込み3ステップ</h2>
        <div class="step">
          <div class="step-1">
            <h4>Step1</h4>
            <p>エージェント企業を探す</p>
            <img src="img/iconmonstr-magnifier-10-240.png" alt="">
          </div>
          <div class="step-2">
            <h4>Step2</h4>
            <p>カートに入れて申し込む</p>
            <img src="img/iconmonstr-shopping-cart-3-240.png" alt="">
          </div>
          <div class="step-3">
            <h4>Step3</h4>
            <p>フォームを記入して完了!</p>
            <img src="img/iconmonstr-note-31-240.png" alt="">
          </div>
        </div>
        <button class="btnUse btn"><a href="#">このサイトの使い方</a></button>
      </section>
      <div id="return"></div>
      <section class="agentlist">
        <?php
            $data = $_POST['data'];
            echo $data;
        foreach ($cnts as $cnt) :
          // var_dump($cnt);
          if ($cnt['agent_name'] == null) :
            $hidden = 'hidden';
          endif;
        ?>
          <div class="agentlist-item" <?= $hidden; ?>>
            <div class="agentlist-item_box">
            <!-- <img src="img/mynabi.jpg" alt="" class="logo"> -->
              <h2><?= $cnt['agent_name']; ?></h2>
              <p class="link">公式サイト:</p><a href="#"><?= $cnt['link']; ?></a>
            </div>
            <div class="agentlist-item_lead">
              <h3><?= $cnt['main']; ?></h3>
              <h6><?= $cnt['sub']; ?></h6>
            </div>
            <div class="agentlist-item_category">
              <ul>
                <?php
                // require(dirname(__FILE__) . "/dbconnect.php");
                $stmt = $db->prepare('SELECT * FROM agent_tag JOIN agent ON agent.id = agent_tag.agent_id RIGHT JOIN tag ON tag.id = agent_tag.tag_id where agent_name=:name');
                $stmt->bindValue('name', $cnt['agent_name'], PDO::PARAM_STR);
                $stmt->execute();
                $tags = $stmt->fetchAll(); ?>
                <?php foreach ($tags as $tag) : ?>
                  <li><?= $tag["tag_name"]; ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <div class="agentlist-item_img">
              <div class="rader">
                <canvas class="myRadarChart_<?= $cnt['agent_name']; ?> chart">
                </canvas>
              </div>
              <div class="button">
                <button class="js_cart_btn cart btn" data-name="<?= $cnt['agent_name']; ?>" data-id="<?= $cnt['id']; ?>">カートに入れる</button>
                <form action="detail.php" method="get">
                  <input type="hidden" value="<?= $cnt['agent_name']; ?>" name="detail">
                  <input class="detail btn" type="submit" value="詳細はこちら">
                </form>
              </div>
            </div>
          </div>
          <script>
            var ctx = document.querySelector(".myRadarChart_<?= $cnt['agent_name']; ?>");
            var myRadarChart = new Chart(ctx, {
              //グラフの種類
              type: "radar",
              //データの設定
              data: {
                //データ項目のラベル
                labels: ["掲載社数", "内定実績", "スピード", "登録者数", "拠点数"],
                //データセット
                datasets: [{
                  label: "エージェント五段階評価",
                  //背景色
                  backgroundColor: "rgba(45, 205, 98,.4)",
                  //枠線の色
                  borderColor: "rgba(45, 205, 98,1)",
                  //結合点の背景色
                  pointBackgroundColor: "rgba(45, 205, 98,1)",
                  //結合点の枠線の色
                  pointBorderColor: "#fff",
                  //結合点の背景色（ホバ時）
                  pointHoverBackgroundColor: "#fff",
                  //結合点の枠線の色（ホバー時）
                  pointHoverBorderColor: "rgba(200,112,126,1)",
                  //結合点より外でマウスホバーを認識する範囲（ピクセル単位）
                  hitRadius: 5,
                  //グラフのデータ
                  data: [<?php
                          ini_set('display_errors', 1);
                          $stmt_shuffle = $db->prepare('select publisher_five from agent where agent_name=:name ');
                          $stmt_shuffle->bindValue('name', $cnt["agent_name"], PDO::PARAM_STR);
                          $stmt_shuffle->execute();
                          $shuffles = $stmt_shuffle->fetchAll();
                          foreach ($shuffles as $shuffle) :
                            echo $shuffle['publisher_five'];
                          endforeach;
                          ?>, <?php $stmt_decision = $db->prepare('select decision_five from agent where agent_name=:name ');
                              $stmt_decision->bindValue('name', $cnt["agent_name"], PDO::PARAM_STR);
                              $stmt_decision->execute();
                              $decisions = $stmt_decision->fetchAll();
                              foreach ($decisions as $decision) :
                                echo $decision['decision_five'];
                              endforeach;
                              ?>, <?php $stmt_speed = $db->prepare('select speed_five from agent where agent_name=:name ');
                                  $stmt_speed->bindValue('name', $cnt["agent_name"], PDO::PARAM_STR);
                                  $stmt_speed->execute();
                                  $speeds = $stmt_speed->fetchAll();
                                  foreach ($speeds as $speed) :
                                    echo $speed['speed_five'];
                                  endforeach;
                                  ?>, <?php $stmt_regist = $db->prepare('select registstrant_five from agent where agent_name=:name ');
                                      $stmt_regist->bindValue('name', $cnt["agent_name"], PDO::PARAM_STR);
                                      $stmt_regist->execute();
                                      $regists = $stmt_regist->fetchAll();
                                      foreach ($regists as $regist) :
                                        echo $regist['registstrant_five'];
                                      endforeach;
                                      ?>, <?php $stmt_place = $db->prepare('select place_five from agent where agent_name=:name ');
                                              $stmt_place->bindValue('name', $cnt["agent_name"], PDO::PARAM_STR);
                                              $stmt_place->execute();
                                              $places = $stmt_place->fetchAll();
                                              foreach ($places as $place) :
                                                echo $place['place_five'];
                                              endforeach;
                                              ?>],
                }, ],
              },
              options: {
                legend: {
                  labels: {
                    // このフォント設定はグローバルプロパティを上書きします。
                    fontColor: "black",
                  },
                },
                // レスポンシブ指定
                responsive: true,
                scale: {
                  r: {
                    pointLabels: {
                      display: true,
                      centerPointLabels: true,
                    },
                  },
                  ticks: {
                    // 最小値の値を0指定
                    beginAtZero: true,
                    min: 0,
                    // 最大値を指定
                    max: 5,
                  },
                },
              },
            });
          </script>
        <?php
        endforeach; ?>
      </section>
    </article>
    <aside>
      <form class="category" action="top.php" method="get">
        <p class="category-title">絞り込み条件</p>
        <div class="category-box">
          <p>サービス内容</p>
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
          <!-- <label>
            <input type="checkbox" class="checkbox" value="1on1" name="narrow[]" />
            <span class="checkbox-fontas"></span>
            1on1
          </label> -->
          <label>
            <input type="checkbox" class="checkbox" value="非公開求人" name="narrow[]" />
            <span class="checkbox-fontas"></span>
            非公開求人
          </label>
          <!-- <label>
            <input type="checkbox" class="checkbox" value="スケジュール管理" name="narrow[]" />
            <span class="checkbox-fontas"></span>
            スケジュール管理
          </label> -->
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
          <!-- <p>拠点</p>
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
          </label> -->
        </div>
        <div class="shuffle">
          <p>並び変える</p>
          <div class="shuffle-box">
            <select name="shuffle" id="">
              <option value="agent_name" selected>選択してください</option>
              <option value="publisher_five">掲載社数</option>
              <option value="decision_five">内定実績</option>
              <option value="speed_five">スピード</option>
              <option value="registstrant_five">登録者数</option>
              <option value="place_five">拠点数</option>
            </select>
          </div>
        </div>
        <button type="submit" class="submit">検索</button>
      </form>
      <form action="top.php?shuffle=agent_name">
        <button type="submit" class="clear">クリア</button>
      </form>
      <!-- <div class="graph-box">
        <a href="graph.php">
          <div class="graph">ランキングで比較する</div>
        </a>
      </div> -->
    </aside>
  </div>
  <div class="cartImg">
    <div class="cart_cnt hidden">
      <span id="js_cart_cnt"></span>
    </div>
    <a href="cart.php"><img src="img/cartred.png" alt=""></a>
  </div>
  <section class="agent">
    <?php
    // $data = $_POST['data'];
    // $agent = $_GET['agent'];

    $five_uno = $unos['publisher_five']+$unos['decision_five']+$unos['speed_five']+$unos['registstrant_five']+$unos['place_five'];
    ?>
    <div class="agentBattle uno">
      <div class="agentBattle-img compare-item image">
      </div>
      <div class="agentBattle-category compare-item">
        <h4>カテゴリ</h4>
        <ul class="list" >
        </ul>
      </div>
      <div class="agentBattle-lader compare-item">
        <h4>レーダーチャート</h4>
        <div class="rader battle-rader">
          <canvas class="myRadarChart-uno ">
          </canvas>
        </div>
      </div>
      <div class="agentBattle-agent compare-item">
        <h4>契約社数</h4>
        <h1 class="company"></h1>
      </div>
      <div class="agentBattle-style compare-item one">
        <h4>面接形態</h4>
        <!-- <img  alt="" class="image"> -->
        <h1 class="styles"></h1>
      </div>
      <div class="agentBattle-success compare-item">
        <h4>内定実績</h4>
        <h1 class="decision"></h1>
      </div>
      <div class="agentBattle-speed compare-item">
        <h4>最短内定スピード</h4>
        <h1 class="speed"></h1>
      </div>
      <div class="agentBattle-register compare-item">
        <h4>登録者数</h4>
        <h1 class="regist"></h1>
      </div>
      <div class="agentBattle-place compare-item">
        <h4>拠点数</h4>
        <h1 class="place"></h1>
      </div>
      <!-- <div class="agentBattle-field compare-item ">
        <h4>得意な業界</h4>
        <h1 class="business">総合</h1>
        <img src="" alt="">
      </div> -->
      <!-- <div class="agentBattle-five">
        <h4>レーダー総合点</h4>
        <h1 class="business"></h1>
      </div> -->
      <form action="detail.php" method="get" class="agentBattle-detail detail1">
      </form>
      <div class="agentBattle-cart cart1">
        <!-- <button class="cart js_cart_btn btn" data-name="<?= $unos['agent_name']; ?>" data-id="<?= $unos['id']; ?>">カートに入れる</button> -->
      </div>
      <div class="agentBattle-link">
        <a href="#">https://dodadoda.com</a>
      </div>
    </div>
    <?php
    $agent = $_GET['agent2'];
    $stmt_dos = $db->prepare('select * from agent where agent_name=:name');
    $stmt_dos->bindValue('name', $agent, PDO::PARAM_STR);
    $stmt_dos->execute();
    $dos = $stmt_dos->fetch();
    $five_dos = $dos['publisher_five']+$dos['decision_five']+$dos['speed_five']+$dos['registstrant_five']+$dos['place_five'];
    ?>
    <div class="agentBattle dos">
    <div class="agentBattle-img compare-item image2">
      </div>
      <div class="agentBattle-category compare-item">
        <h4>カテゴリ</h4>
        <ul class="list2">
        </ul>
      </div>
      <div class="agentBattle-lader compare-item">
        <h4>レーダーチャート</h4>
        <div class="rader battle-rader">
          <canvas class="myRadarChart-dos ">
          </canvas>
        </div>
      </div>
      <div class="agentBattle-agent compare-item">
        <h4>契約社数</h4>
        <h1 class="company2 "></h1>
      </div>
      <div class="agentBattle-style compare-item two">
        <h4>面接形態</h4>
        <!-- <img  alt="" class="image"> -->
        <h1 class="styles2"></h1>
      </div>
      <div class="agentBattle-success compare-item">
        <h4>内定実績</h4>
        <h1 class="decision2"></h1>
      </div>
      <div class="agentBattle-speed compare-item">
        <h4>最短内定スピード</h4>
        <h1 class="speed2"></h1>
      </div>
      <div class="agentBattle-register compare-item">
        <h4>登録者数</h4>
        <h1 class="regist2"></h1>
      </div>
      <div class="agentBattle-place compare-item">
        <h4>拠点数</h4>
        <h1 class="place2"></h1>
      </div>
      <!-- <div class="agentBattle-field compare-item ">
        <h4>得意な業界</h4>
        <h1 class="business">総合</h1>
        <img src="" alt="">
      </div> -->
      <!-- <div class="agentBattle-five">
        <h4>レーダー総合点</h4>
        <h1 class="business"></h1>
      </div> -->
      <form action="detail.php" method="get" class="agentBattle-detail detail2">
      </form>
      <div class="agentBattle-cart cart2">
        <!-- <button class="cart js_cart_btn btn" data-name="<?= $unos['agent_name']; ?>" data-id="<?= $unos['id']; ?>">カートに入れる</button> -->
      </div>
      <div class="agentBattle-link">
        <a href="#">https://dodadoda.com</a>
      </div>
    </div>
  </section>
  <button class="return">一覧に戻る</button>
  <footer>
    <p>Anti-Pattern Inc</p>
  </footer>
  <script>
    // let five2 = document.querySelector('.five2');
    // let five3 = document.querySelector('.five3');
    // let five4 = document.querySelector('.five4');
    // let five5 = document.querySelector('.five5');



    
    <?php 
    if(isset($_GET['compare'])):?>
      compareOpen();
    <?php endif;
    ?>
  </script>
</body>

</html>