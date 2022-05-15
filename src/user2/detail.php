<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="reset.css">
  <link rel="stylesheet" href="style.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet" />
</head>
<body>
<header>
  <h1><img src="img/就活の教科書.webp" alt=""></h1>
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
          <input type="text" placeholder="検索">
          <button class="search-box_icon" type="submit">
          </button>
        </div>
      </div>
      <div class="category">
        <p class="category-title">絞り込み条件<button>絞り込む</button></p>
        <div class="category-box">
          <p>サービス内容</p>
          <label>
            <input type="checkbox" class="checkbox" value="面接対策" />
            <span class="checkbox-fontas"></span>
            面接対策
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="ES添削" />
            <span class="checkbox-fontas"></span>
            ES添削
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="1on1" />
            <span class="checkbox-fontas"></span>
            1on1
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="スケジュール管理" />
            <span class="checkbox-fontas"></span>
            スケジュール管理
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="オンライン" />
            <span class="checkbox-fontas"></span>
            オンライン
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="対面" />
            <span class="checkbox-fontas"></span>
            対面
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="非公開求人" />
            <span class="checkbox-fontas"></span>
            非公開求人
          </label>
          <p>得意分野</p>
          <label>
            <input type="checkbox" class="checkbox" value="IT" />
            <span class="checkbox-fontas"></span>
            IT
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="マスコミ" />
            <span class="checkbox-fontas"></span>
            マスコミ
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="商社" />
            <span class="checkbox-fontas"></span>
            商社
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="金融" />
            <span class="checkbox-fontas"></span>
            金融
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="外資" />
            <span class="checkbox-fontas"></span>
            外資
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="総合" />
            <span class="checkbox-fontas"></span>
            総合
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="スタートアップ" />
            <span class="checkbox-fontas"></span>
            スタートアップ
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="ベンチャー" />
            <span class="checkbox-fontas"></span>
            ベンチャー
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="大手" />
            <span class="checkbox-fontas"></span>
            大手
          </label>
          <p>拠点</p>
          <label>
            <input type="checkbox" class="checkbox" value="首都圏" />
            <span class="checkbox-fontas"></span>
            首都圏
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="関西" />
            <span class="checkbox-fontas"></span>
            関西
          </label>
          <label>
            <input type="checkbox" class="checkbox" value="地方" />
            <span class="checkbox-fontas"></span>
            地方
          </label>
        </div>
      </div>
      <div class="shuffle">
        <p>並び変える</p>
        <div class="shuffle-box">
          <select name="shuffle" id="">
            <option value="選択してください" selected>選択してください</option>
            <option value="掲載社数">掲載社数</option>
            <option value="内定実績">内定実績</option>
            <option value="スピード">スピード</option>
            <option value="登録者数">登録者数</option>
            <option value="拠点数">拠点数</option>
          </select>
        </div>
      </div>
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
<?php
  require(dirname(__FILE__) . "/dbconnect.php");
  // $shuffle = 'agent_name';
  $cnt_stmt = $pdo->prepare("select * from agent where agent_name=:name");
  $cnt_stmt->bindValue('name', $_GET['detail'], PDO::PARAM_STR);
  $cnt_stmt->execute();
  $cnt = $cnt_stmt->fetch();
  ?>
<div class="main">
<div class="page">
  <p>
  <a href="#" onclick="history.back()">トップ</a>
  <span>></span>
  <span class="page_current"><?= $cnt['agent_name']; ?>詳細</span>
  </p>
</div>
  <div class="agentlist-item detail-page">
    <div class="agentlist-item_box">
      <h2><?= $cnt['agent_name']; ?></h2>
      <p>公式サイト:</p><a href="#"><?= $cnt['link']; ?></a>
        <button class="js_cart_btn detail-cart" data-name="<?= $cnt['agent_name']; ?>" data-id="<?= $cnt['id']; ?>">カートに入れる</button>
    </div>
    <div class="agentlist-item_category">
      <ul>
        <?php
        // require(dirname(__FILE__) . "/dbconnect.php");
        $stmt = $pdo->prepare('SELECT * FROM agent_tag JOIN agent ON agent.id = agent_tag.agent_id RIGHT JOIN tag ON tag.id = agent_tag.tag_id where agent_name=:name');
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
        <canvas class="myRadarChart_<?= $cnt['agent_name']; ?>">
        </canvas>
      </div>
      <img src="img/<?= $cnt['agent_name'];?>.png" alt="" class="site">
    </div>
    <div class="agentlist-item_table">
      <table border="1">
        <tr>
          <th>掲載社数</th>
          <th>内定実績</th>
          <th>スピード</th>
          <th>登録者数</th>
          <th>拠点数</th>
        </tr>
        <tr>
          <td><?= $cnt['publisher']; ?><span>社</span></td>
          <td><?= $cnt['decision']; ?><span>人</span></td>
          <td><?= $cnt['speed']; ?><span>週間</span></td>
          <td><?= $cnt['registstrant']; ?><span>人</span></td>
          <td><?= $cnt['place']; ?><span>か所</span></td>
        </tr>
      </table>
    </div>
    <div class="agentlist-item_service">
      <h2>サービスの流れ</h2>
      <div class="service-step">
        <p><span>step1</span>マイナビ新卒紹介へのお申込み</p>
      </div>
      <div class="service-step">
        <p><span>step2</span>面接(キャリアカウンセリング)</p>
      </div>
      <div class="service-step">
        <p><span>step3</span>企業求人、インターンシップ紹介・応募</p>
      </div>
      <div class="service-step">
        <p><span>step4</span>選考・面接</p>
      </div>
      <div class="service-step">
        <p><span>step5</span>内定・入社</p>
      </div>
      <img src="img/service.png" alt="">
    </div>
    <div class="agentlist-item_apeal">
      <h2>アピールポイント</h2>
      <h4>キャリアアドバイザーと二人三脚で就活に勝つ</h4>
      <p>
        膨大な情報量の中から、自分に必要な情報だけを
        ピックアップするのは難しいもの。
        それぞれ専門知識のあるキャリアアドバイザーが、
        効率的な就活を皆さまに合わせたサポートをさせて
        いただきます。
      </p>
      <h4>マイナビにしかできない非公開求人量</h4>
      <p>
        マイナビ新卒紹介では、マイナビなど就職情報
        サイトには公開されていない、非公開求人を中心に
        ご紹介します。
        マイナビ新卒紹介からしか受けられない求人も
        多数ありますので、積極的に活用してください。
      </p>
    </div>
    <!-- <div class="row scroll">
        <div class="col-1-of-3">
          <div class="card-1 card ">
            <div class="card__side card__side--front">
              <div class="card__picture card__picture--1">
                &nbsp;
              </div>
              <h4 class="card__heading">
                <span class="card__heading-span card__heading-span--1">キャリアカウンセリング</span>
              </h4>
              <div class="card__details">
                <p>
                  自己分析とは言っても自身の性格や良さを把握するのは難しいものです。マイナビ新卒紹介では、経験豊富なキャリアアドバイザーが皆さまの経験や志向性などから、「自分の良さ」や「可能性」を再発見できるようなキャリアカウンセリングを実施しています。
                </p>
              </div>
            </div>
            <div class="card__side card__side--back card__side--back-1">
              <div class="card__cta">
                <div class="card__price-box">
                  <p class="card__price-only">キャリアカウンセリング</p>
                  <img src="img/careerBack.jpg" class="card__price-photo" width="200px" height="200px">
                </div>
                <p>「自分のよさ」や「可能性」を再発見できる
                  自己分析とは言っても自身の性格や良さを把握するのは難しいものです。マイナビ新卒紹介では、経験豊富なキャリアアドバイザーが皆さまの経験や志向性などから、
                  や「可能性」を再発見できるようなキャリアカウンセリングを実施しています。「自分の良さ」や「可能性」を再発見できるようなキャリアカウンセリングを実施しています。</p>
              </div>
            </div>
          </div>
        </div>


        <div class="col-1-of-3">
          <div class="card-2 card">
            <div class="card__side card__side--front">
              <div class="card__picture card__picture--2">
                &nbsp;
              </div>
              <h4 class="card__heading">
                <span class="card__heading-span card__heading-span--2">セミナーや研修の受講
                </span>
              </h4>
              <div class="card__details">
                <p>マイナビ新卒紹介では若手育成研修も実施しています。そのため時期に合わせたセミナーや研修、書類・面接対策を受講できます。
                  ※時期により実施内容・頻度は異なります。</p>
              </div>

            </div>
            <div class="card__side card__side--back card__side--back-2">
              <div class="card__cta">
                <div class="card__price-box">
                  <p class="card__price-only">「マイナビ新卒紹介」だからこそ提供できるサービス</p>
                  <img src="img/zemiBack.jpg" class="card__price-photo" width="200px" height="200px">
                </div>
                <p>面接対策<br>
                  特に面接は、何を答えたら正解なのか、そもそも何を聞きたいのかが分からずに悩むことが多いかと思います。マイナビ新卒紹介では、就職活動を熟知したプロのキャリアアドバイザーが面接のポイントやコツを一からお伝えします。
                  一人ひとりに合わせた実践形式での対策を行います。<br>

                  研修<br>
                  経済産業省が推奨する「社会人基礎力」を鍛えるための研修など就職活動だけでなく社会人でも生かせる力を養成する研修を提供しています。</p>
              </div>
            </div>
          </div>
        </div>


        <div class="col-1-of-3">
          <div class="card-3 card">
            <div class="card__side card__side--front">
              <div class="card__picture card__picture--3">
                &nbsp;
              </div>
              <h4 class="card__heading">
                <span class="card__heading-span card__heading-span--3">リアルな採用情報の提供
                </span>
              </h4>
              <div class="card__details">
                <p>
                  マイナビ新卒紹介なら、「過去にどのような人物が就職しているのか」といった採用基準や、「あなたのどのような点が評価されているのか」といった面接のフィードバックなどをお伝えできることもあります。
                  選考や就職先選定の参考にしてください。</p>
              </div>

            </div>
            <div class="card__side card__side--back card__side--back-3">
              <div class="card__cta">
                <div class="card__price-box">
                  <p class="card__price-only">なぜ、リアルな採用情報を持っているのか</p>
                  <img src="img/backInfo.jpg" class="card__price-photo" width="200px" height="200px">
                </div>
                <p>
                  マイナビ新卒紹介では、企業に対して採用コンサルティングを行っています。例えば、どのような人物像の方を採用すべきか、どのような採用基準を設けるべきか、など、採用活動そのものを企業と一緒に行っていきます。だからこそ得られるリアルな情報を学生の皆様にお伝えすることができます。

                  正しいのかどうか分からない努力ではなく、内定のための確実な努力を積み重ねて、就職活動を有意義なものにできます。</p>
              </div>
            </div>
          </div>
        </div>
      </div> -->
    <input type="submit" value="一覧に戻る" class="no" onclick="history.back()">
  </div>
</div>
<div class="cartImg">
  <div class="cart_cnt hidden">
    <span id="js_cart_cnt"></span>
  </div>
  <!-- <a href="cart.php"><img src="img/iconmonstr-shopping-cart-3-240.png" alt=""></a> -->
  <form action="cart.php" method="get">
  <input type="hidden" value="<?= $cnt['agent_name'];?>詳細" name="detail">
    <input type="image" src="img/iconmonstr-shopping-cart-3-240.png">
  </form>
</div>
<footer>
  <p>Anti-Pattern Inc</p>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script src="detail.js"></script>
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
        data: [<?php $stmt_shuffle = $pdo->prepare('select publisher_five from agent where agent_name=:name ');
                $stmt_shuffle->bindValue('name', $cnt["agent_name"], PDO::PARAM_STR);
                $stmt_shuffle->execute();
                $shuffles = $stmt_shuffle->fetchAll();
                foreach ($shuffles as $shuffle) :
                  echo $shuffle['publisher_five'];
                endforeach;
                ?>, <?php $stmt_decison = $pdo->prepare('select decision_five from agent where agent_name=:name ');
                                $stmt_decison->bindValue('name', $cnt["agent_name"], PDO::PARAM_STR);
                                $stmt_decison->execute();
                                $decisions = $stmt_decison->fetchAll();
                                foreach ($decisions as $decision) :
                                  echo $decision['decision_five'];
                                endforeach;
                                ?>, <?php $stmt_speed = $pdo->prepare('select speed_five from agent where agent_name=:name ');
        $stmt_speed->bindValue('name', $cnt["agent_name"], PDO::PARAM_STR);
        $stmt_speed->execute();
        $speeds = $stmt_speed->fetchAll();
        foreach ($speeds as $speed) :
          echo $speed['speed_five'];
        endforeach;
        ?>, <?php $stmt_regist = $pdo->prepare('select registstrant_five from agent where agent_name=:name ');
        $stmt_regist->bindValue('name', $cnt["agent_name"], PDO::PARAM_STR);
        $stmt_regist->execute();
        $regists = $stmt_regist->fetchAll();
        foreach ($regists as $regist) :
          echo $regist['registstrant_five'];
        endforeach;
        ?>, <?php $stmt_place = $pdo->prepare('select place_five from agent where agent_name=:name ');
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
</body>

</html>