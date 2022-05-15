<?php
require(dirname(__FILE__) . "/dbconnect.php");
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Noto+Serif:ital,wght@1,700&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="reset.css">
  <title>Document</title>
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
  <div class="page to-cart">
  <p>
  <a href="#" onclick="history.back()">トップ</a>
  <span>></span>
  <span class="page_current">グラフ</span>
  </p>
</div>
  <section class="bargraph">
    <div class="box">掲載社数グラフ<img src="img/下向き.png" alt="" class="down under"></div>
    <div class="barchart">
      <canvas id="chart"></canvas>
    </div>
  </section>
  <section class="bargraph">
    <div class="box">内定実績グラフ<img src="img/下向き.png" alt="" class="down2 under"></div>
    <div class="barchart2">
      <canvas id="chart2"></canvas>
    </div>
  </section>
  <section class="bargraph">
    <div class="box">拠点数グラフ<img src="img/下向き.png" alt="" class="down3 under"></div>
    <div class="barchart3">
      <canvas id="chart3"></canvas>
    </div>
  </section>
  <!-- <footer>
    <p>Anti-Pattern Inc</p>
  </footer> -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
  <script>
        window.onload = function() {
      let context = document.querySelector("#chart").getContext('2d')
      new Chart(context, {
        type: "horizontalBar",
        data: {
          labels: [<?php foreach ($cnts as $cnt) : ?> '<?= $cnt['agent_name']; ?>',
            <?php endforeach; ?>
          ],
          datasets: [{
            label: "エージェント掲載社数",
            data: [<?php foreach ($cnts as $cnt) : ?>
                <?= $cnt['publisher']; ?>,
              <?php endforeach; ?>
            ],
            backgroundColor: 'rgba(45, 205, 98,.4)',
          }],
        },
        options: {
          plugins: {
            datalabels: { // 共通の設定はここ
              font: {
                size: 14
              }
            }
          },
          responsive: true,
          scales: {
            xAxes: [{
              ticks: {
                min: 0,
                max: 50000
              }
            }]
          },

        }
      })
      let context2 = document.querySelector("#chart2").getContext('2d')
      new Chart(context2, {
        type: "horizontalBar",
        data: {
          labels: [<?php foreach ($cnts as $cnt) : ?> '<?= $cnt['agent_name']; ?>',
            <?php endforeach; ?>
          ],
          datasets: [{
            label: "エージェント内定実績",
            data: [<?php foreach ($cnts as $cnt) : ?>
                <?= $cnt['decision']; ?>,
              <?php endforeach; ?>
            ],
            backgroundColor: 'rgba(45, 205, 98,.4)',
          }],
        },
        options: {
          plugins: {
            datalabels: { // 共通の設定はここ
              font: {
                size: 14
              }
            }
          },
          responsive: true,
          scales: {
            xAxes: [{
              ticks: {
                min: 0,
                max: 120000
              }
            }]
          },

        }
      })
      let context3 = document.querySelector("#chart3").getContext('2d')
      new Chart(context3, {
        type: "horizontalBar",
        data: {
          labels: [<?php foreach ($cnts as $cnt) : ?> '<?= $cnt['agent_name']; ?>',
            <?php endforeach; ?>
          ],
          datasets: [{
            label: "エージェント拠点数",
            data: [<?php foreach ($cnts as $cnt) : ?>
                <?= $cnt['place']; ?>,
              <?php endforeach; ?>
            ],
            backgroundColor: 'rgba(45, 205, 98,.4)',
          }],
        },
        options: {
          plugins: {
            datalabels: { // 共通の設定はここ
              font: {
                size: 14
              }
            }
          },
          responsive: true,
          scales: {
            xAxes: [{
              ticks: {
                min: 0,
                max: 50
              }
            }]
          },

        }
      })
    }
  </script>
  <script src="graph.js"></script>
</body>

</html>