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
  <?php
  require(dirname(__FILE__) . "/dbconnect.php");
  // $shuffle = 'agent_name';
  $cnt_stmt = $db->prepare("select * from agent where agent_name=:name");
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
    <!-- 変更箇所 -->
    <?php if (isset($_GET['compare'])) : ?>
          <form action="top.php" method="get">
            <input type="hidden" value="compare" name="compare">
            <input type="submit" value="戻る" class="back">
          </form>
    <?php else: ?>
      <a href="#" onclick="history.back()" class="back">戻る</a>
    <?php endif; ?>
    <div class="agentlist-item detail-page" id="detail">
      <div class="agentlist-item_box">
        <h2><?= $cnt['agent_name']; ?></h2>
        <a target="_blank" href="<?= $cnt['link']; ?>">公式サイトはこちら</a>
        <button class="js_cart_btn" data-name="<?= $cnt['agent_name']; ?>" data-id="<?= $cnt['id']; ?>">カートに入れる</button>
      </div>
      <div class="info">
      <h2>詳細情報</h2>
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
      <img src="img/<?= $cnt['agent_name']; ?>.png?<?= uniqid() ?>" alt="" class="site">
        <div class="rader">
          <canvas class="myRadarChart_<?= $cnt['agent_name']; ?>">
          </canvas>
        </div>
      </div>
      <div class="agentlist-item_table">
        <table border="1" class="table-inline">
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
        <table border="1" class="table-block">
          <tr>
            <th>掲載社数</th>
            <td><?= $cnt['publisher']; ?><span>社</span></td>
          </tr>
          <tr>
            <th>内定実績</th>
            <td><?= $cnt['decision']; ?><span>人</span></td>
          </tr>
          <tr>
            <th>スピード</th>
            <td><?= $cnt['speed']; ?><span>週間</span></td>
          </tr>
          <tr>
            <th>登録者数</th>
            <td><?= $cnt['registstrant']; ?><span>人</span></td>
          </tr>
          </tr>
          <tr>
            <th>拠点数</th>
            <td><?= $cnt['place']; ?><span>か所</span></td>
          </tr>
        </table>
      </div>
      <div class="agentlist-item_service">
        <h2>サービスの流れ</h2>
        <div class="service-step">
          <p><span>step1</span><?= $cnt['step1']; ?></p>
        </div>
        <div class="service-step">
          <p><span>step2</span><?= $cnt['step2']; ?></p>
        </div>
        <div class="service-step">
          <p><span>step3</span><?= $cnt['step3']; ?></p>
        </div>
      </div>
      <div class="agentlist-item_apeal">
        <h2>アピールポイント</h2>
        <h4><?= $cnt['apeal1'];?></h4>
        <p><?= $cnt['apeal1_content'];?></p>
        <h4><?= $cnt['apeal2'];?></h4>
        <p>
        <?= $cnt['apeal2_content'];?>
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
      <div class="company-info">
        <h2>企業へのお問い合わせ<img src="img/iconmonstr-phone-1-240.png" alt=""></h2>
        <h5><span>mail:</span><?= $cnt['mail']; ?></h5>
        <h5><span>tel:</span><?= $cnt['tel']; ?></h5>
      </div>
      <div class="detailpage-btn">
        <button class="js_cart_btn detail-bottom" data-name="<?= $cnt['agent_name']; ?>" data-id="<?= $cnt['id']; ?>">カートに入れる</button>
        <?php if (isset($_GET['compare'])) : ?>
          <form action="top.php" method="get">
            <input type="hidden" value="compare" name="compare">
            <input type="submit" value="比較に戻る" class="no detail-bottom">
          </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="cartImg">
    <div class="cart_cnt hidden">
      <span id="js_cart_cnt"></span>
    </div>
    <!-- <a href="cart.php"><img src="img/iconmonstr-shopping-cart-3-240.png" alt=""></a> -->
    <form action="cart.php" method="get">
      <input type="hidden" value="<?= $cnt['agent_name']; ?>詳細" name="detail">
      <input type="image" src="img/cartred.png">
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
          data: [<?php $stmt_shuffle = $db->prepare('select publisher_five from agent where agent_name=:name ');
                  $stmt_shuffle->bindValue('name', $cnt["agent_name"], PDO::PARAM_STR);
                  $stmt_shuffle->execute();
                  $shuffles = $stmt_shuffle->fetchAll();
                  foreach ($shuffles as $shuffle) :
                    echo $shuffle['publisher_five'];
                  endforeach;
                  ?>, <?php $stmt_decison = $db->prepare('select decision_five from agent where agent_name=:name ');
                      $stmt_decison->bindValue('name', $cnt["agent_name"], PDO::PARAM_STR);
                      $stmt_decison->execute();
                      $decisions = $stmt_decison->fetchAll();
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
</body>

</html>