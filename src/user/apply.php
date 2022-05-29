<?php
$applies = $_GET['apply'];
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
          <li>CRAFT</li>
        </div>
      </div>
    </div>
  </header>
  <div class="container">
    <div class="page to-cart">
      <?php if (!$_GET['detail'] == '') : ?>
        <p>
          <a href="#" onclick="history.go(-3)">トップ</a>
          <span>></span>
          <a href="#" onclick="history.go(-2)"><?= $_GET['detail']; ?></a>
          <span>></span>
          <a href="#" onclick="history.back()">カート</a>
          <span>></span>
          <span class="page_current">申し込み</span>
        </p>
      <?php else : ?>
        <p>
          <a href="#" onclick="history.go(-2)">トップ</a>
          <span>></span>
          <a href="#" onclick="history.back()">カート</a>
          <span>></span>
          <span class="page_current">申し込み</span>
        </p>
      <?php endif; ?>
    </div>
    <!-- <div class="title">
      <img src="img/iconmonstr-handshake-7-240.png" alt="" />
      <h1>申し込み</h1>
    </div> -->

    <section class="step">
      <img src="img/flow.png" alt="">
    </section>
    <section>
      <div class="agent-data">
        <h3>お申込みエージェント</h3>
        <ul>
          <?php foreach ($applies as $apply) : ?>
            <li><?= $apply; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <form action="check.php" method="post" class="form">
        <table class="contact-table">
          <tr>
            <th class="contact-item">お名前<span>*</span></th>
            <td class="contact-body">
              <p class="name error">※入力してください</p>
              <input placeholder="漢字フルネーム(スペースなし)" type="text" name="name" class="form-text" />
            </td>
          </tr>
          <tr>
            <th class="contact-item">カナ<span>*</span></th>
            <td class="contact-body">
              <p class="kana error">※入力してください</p>
              <input placeholder="カナ（スペースなし）" type="text" name="katakana" class="form-text" />
            </td>
          </tr>
          <tr>
            <th class="contact-item">Tel<span>*</span></th>
            <td class="contact-body">
              <p class="tel error">※入力してください</p>
              <input placeholder="×××-××××-××××(半角)" type="tel" name="Tel" class="form-text" />
            </td>
          </tr>
          <tr>
            <th class="contact-item">mail<span>*</span></th>
            <td class="contact-body">
              <p class="mail error">※入力してください</p>
              <input placeholder="sample@sample(半角)" type="mail" name="mail" class="form-text" />
            </td>
          </tr>
          <tr>
            <th class="contact-item">大学名<span>*</span></th>
            <td class="contact-body">
              <p class="university error">※入力してください</p>
              <input placeholder="○○大学" type="text" name="university" class="form-text" />
            </td>
          </tr>
          <tr>
            <th class="contact-item">学部・学科<span>*</span></th>
            <td class="contact-body">
              <p class="faculty error">※入力してください</p>
              <input placeholder="○○学部・○○学科" type="text" name="faculty" class="form-text" />
            </td>
          </tr>
          <tr>
            <th class="contact-item">卒業年<span>*</span></th>
            <td class="contact-body">
              <p class="graduate error">※入力してください</p>
              <input placeholder="○○卒(数字半角)" type="text" name="graduate" class="form-text" />
            </td>
          </tr>
          <tr>
            <th class="contact-item">住所<span>*</span></th>
            <td class="contact-body">
              <p class="home error">※入力してください</p>
              <input placeholder="○○県○○市○○町" type="text" name="home" class="form-text" />
            </td>
          </tr>
          <tr>
            <th class="contact-item">自由記入欄</th>
            <td class="contact-body">
              <input type="text" name="free" class="form-text" />
            </td>
          </tr>
        </table>

        <section class="privacy-policy-box">
        <h1>利用規約</h1>
        <div class="privacy-policy">
          <div class="privacy-policy__item">
            <p class="privacy-policy__item__title">第1条（個人情報）</p>
            <p class="privacy-policy__item__desc">「個人情報」とは，個人情報保護法にいう「個人情報」を指すものとし，生存する個人に関する情報であって，当該情報に含まれる氏名，生年月日，住所，電話番号，連絡先その他の記述等により特定の個人を識別できる情報及び容貌，指紋，声紋にかかるデータ，及び健康保険証の保険者番号などの当該情報単体から特定の個人を識別できる情報（個人識別情報）を指します。</p>
          </div>
          <div class="privacy-policy__item">
            <p class="privacy-policy__item__title">第2条（個人情報の収集方法）</p>
            <p class="privacy-policy__item__desc">当社は，ユーザーが利用登録をする際に氏名，生年月日，住所，電話番号，メールアドレス，銀行口座番号，クレジットカード番号，運転免許証番号などの個人情報をお尋ねすることがあります。また，ユーザーと提携先などとの間でなされたユーザーの個人情報を含む取引記録や決済に関する情報を,当社の提携先（情報提供元，広告主，広告配信先などを含みます。以下，｢提携先｣といいます。）などから収集することがあります。</p>
          </div>
          <div class="privacy-policy__item">
            <p class="privacy-policy__item__title">第3条（個人情報を収集・利用する目的）</p>
            <p class="privacy-policy__item__desc">当社が個人情報を収集・利用する目的は，以下のとおりです。
<br> 1.当社サービスの提供・運営のため
<br> 2.ユーザーからのお問い合わせに回答するため（本人確認を行うことを含む）
<br> 3.ユーザーが利用中のサービスの新機能，更新情報，キャンペーン等及び当社が提供する他のサービスの案内のメールを送付するため
<br> 4.メンテナンス，重要なお知らせなど必要に応じたご連絡のため
<br> 5.利用規約に違反したユーザーや，不正・不当な目的でサービスを利用しようとするユーザーの特定をし，ご利用をお断りするため
<br> 6.ユーザーにご自身の登録情報の閲覧や変更，削除，ご利用状況の閲覧を行っていただくため
<br> 7.有料サービスにおいて，ユーザーに利用料金を請求するため
<br> 8.上記の利用目的に付随する目的</p>
          </div>
          <div class="privacy-policy__item">
            <p class="privacy-policy__item__title">第4条（個人情報の提供等）</p>
            <p class="privacy-policy__item__desc">当社は、法令で定める場合を除き、本人の同意に基づき取得した個人情報を、本人の事前の同意なく第三者に提供することはありません。なお、本人の求めによる個人情報の開示、訂正、追加若しくは削除又は利用目的の通知については、法令に従いこれを行うとともに、ご意見、ご相談に関して適切に対応します。</p>
          </div>
          <div class="privacy-policy__item">
            <p class="privacy-policy__item__title">第5条（苦情や相談の担当窓口）</p>
            <p class="privacy-policy__item__desc">当社は、個人情報の取扱いに関する担当窓口及び責任者を以下の通り設けます。

<br>【株式会社boozer】

<br>〒 ○○○-○○○○

<br>東京都新宿区1-2-3　○○ビル10階

<br>Tel：○○-○○○○-○○○○

<br>個人情報苦情・相談窓口責任者　アシロ 太郎</p>
          </div>
        </div>
        </section>

        <button class="contact-submit" type="button">利用規約に同意して<br>内容を確認する</button>
        <!-- <input class="contact-submit" type="submit" value="内容を確認する" /> -->
        <?php foreach ($applies as $apply) : ?>
          <input type="hidden" name="check[]" value="<?= $apply; ?>">
        <?php endforeach; ?>
        <input type="hidden" name="detail" value="<?= $_GET['detail']; ?>">
      </form>

    </section>
  </div>
  <script src="apply.js"></script>
</body>

</html>