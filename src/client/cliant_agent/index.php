<?php
session_start();
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
        // $stmt = $db->prepare('INSERT INTO events SET title=?');
        // $stmt->execute(array(
        //     $_POST['title']
        // ));

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/top.php');
        exit();
    }
} else {
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/client/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../reset2.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <div class="header_top">
            <h1>就活の教科書 <span>クライアント画面</span></h1>
            <nav>
                <a href="../top.php">トップ</a>
                <a href="../cliant_agent/index.php" class="page_focus">掲載情報</a>
                <a href="../cliant_student/index.php">個人情報</a>
                <a href="../client_agency/index.php">担当者管理</a>
                <a href="../client_add/index.php">担当者追加</a>
                <a href="../client_application/index.php">編集申請</a>
                <a href="../cliant_inquiry/index.php">お問い合わせ</a>
            </nav>
        </div>
        <div class="header_bottom">
            <form method="get" action="">
                <img src="../img/iconmonstr-log-out-16-240 (1).png" alt="">
                <input type="submit" name="btn_logout" value="ログアウト">
            </form>
        </div>
    </header>

    <!-- <div id="page_change" class="page_change">
        <button onclick="change_top()">トップページ画面をみる</button>
        <button onclick="change_detail()">詳細ページ画面を見る</button>
        <button onclick="change_info()">契約情報</button>
    </div> -->

    <!-- <select name="example">
        <option value="サンプル1">トップページ画面</option>
        <option value="サンプル2">詳細ページ画面</option>
        <option value="サンプル3">契約情報</option>
    </select> -->

    <div class="cp_ipselect">
        <select id="choice" class="cp_sl02" onchange="inputChange()" required>
            <!-- <option value="" hidden disabled selected></option> -->
            <option value="1">トップページ画面</option>
            <option value="2">詳細ページ画面</option>
            <option value="3">契約情報</option>
        </select>
        <span class="cp_sl02_highlight"></span>
        <span class="cp_sl02_selectbar"></span>
        <label class="cp_sl02_selectlabel">閲覧するページを選ぶ</label>
    </div>

    <section id="top">
        <div class="main">
            <!-- <button onclick="page_changes()" class="pages_button"><img src="../img/iconmonstr-arrow-25-240.png" alt=""><h1>トップページ画面</h1></button> -->
            <div class="agentlist-item">
                <div class="agentlist-item_box">
                    <h2>マイナビ</h2>
                    <p>公式サイト:</p>
                    <a href="#">https;//mainabisyuukatu.com</a>
                </div>
                <div class="agentlist-item_category">
                    <ul>
                        <li>首都圏</li>
                        <li>ES添削</li>
                        <li>メーカー</li>
                        <li>オンライン</li>
                    </ul>
                </div>
                <div class="agentlist-item_lead">
                    <h3>就活は一人じゃない、ともに進む就活エージェント</h3>
                    <h6>就活情報サイトでは掲載されてない求人の紹介</h6>
                </div>
                <div class="agentlist-item_img">
                    <div class="rader">
                        <canvas id="myRadarChart"> </canvas>
                    </div>
                    <img src="../img/mynabi.png" alt="" class="site" />
                </div>
                <div class="agentlist-item_button">
                    <button class="cart">
                        カートに入れる<img src="../img/iconmonstr-shopping-cart-2-240.png" alt="" />
                    </button>
                    <a href="detail.html" target="_blank" rel="noopener noreferrer"><button class="detail">詳細はこちら</button></a>
                </div>
            </div>
        </div>
    </section>

    <section id="detail">
        <div class="main">
            <!-- <button onclick="page_changes()" class="pages_button"><img src="../img/iconmonstr-arrow-25-240.png" alt=""><h1>詳細ページ画面</h1></button> -->
            <div class="agentlist-item">
                <div class="agentlist-item_box">
                    <h2>マイナビ</h2>
                    <p>公式サイト:</p><a href="#">https;//mainabisyuukatu.com</a>
                </div>
                <div class="agentlist-item_category">
                    <ul>
                        <li>首都圏</li>
                        <li>ES添削</li>
                        <li>メーカー</li>
                        <li>オンライン</li>
                    </ul>
                </div>
                <div class="agentlist-item_img">
                    <img src="img/レーダーチャート.png" alt="">
                    <img src="img/mynabi.png" alt="" class="site">
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
                            <td>40000社</td>
                            <td>100,000人</td>
                            <td>2週間</td>
                            <td>3,000,000人</td>
                            <td>20</td>
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
                <!-- <div class="agentlist-item_cart">
                    <button>カートに入れる</button>
                </div> -->
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
                                    <p>自己分析とは言っても自身の性格や良さを把握するのは難しいものです。マイナビ新卒紹介では、経験豊富なキャリアアドバイザーが皆さまの経験や志向性などから、「自分の良さ」や「可能性」を再発見できるようなキャリアカウンセリングを実施しています。
                                    </p>
                                </div>
                            </div>
                            <div class="card__side card__side--back card__side--back-1">
                                <div class="card__cta">
                                    <div class="card__price-box">
                                        <p class="card__price-only">キャリアカウンセリング</p>
                                        <img src="../img/careerBack.jpg" class="card__price-photo" width="200px"
                                            height="200px">
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
                                        <img src="../img/zemiBack.jpg" class="card__price-photo" width="200px" height="200px">
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
                                        <img src="../img/backInfo.jpg" class="card__price-photo" width="200px" height="200px">
                                    </div>
                                    <p>マイナビ新卒紹介では、企業に対して採用コンサルティングを行っています。例えば、どのような人物像の方を採用すべきか、どのような採用基準を設けるべきか、など、採用活動そのものを企業と一緒に行っていきます。だからこそ得られるリアルな情報を学生の皆様にお伝えすることができます。
    
                                        正しいのかどうか分からない努力ではなく、内定のための確実な努力を積み重ねて、就職活動を有意義なものにできます。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
        </div>
        <div class="agentlist-item_return">
            <a href="../admin_company/index.html"><button>一覧に戻る</button></a>
        </div>
    </section>

    <section id="info">
        <div class="main">
            <!-- <button onclick="page_changes()" class="pages_button"><img src="../img/iconmonstr-arrow-25-240.png" alt=""><h1>契約情報</h1></button> -->
            <table class="contact-table">
                <tr>
                    <th class="contact-item">企業名</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">企業画像ファイル</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">公式サイトurl</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">見出し</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">アピールポイント</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">内定実績</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">掲載者数</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">内定最短</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">実績</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">グラフ</th>
                    <td class="contact-body">
                        <label class="contact-sex">
                            <span class="contact-sex-txt">掲載者数</span>
                            <input class="graph_number" type="text" name="掲載者数" />
                        </label>
                        <label class="contact-sex">
                            <span class="contact-sex-txt">内定実績</span>
                            <input class="graph_number" type="text" name="掲載者数" />
                        </label>
                        <label class="contact-sex">
                            <span class="contact-sex-txt">スピード</span>
                            <input class="graph_number" type="text" name="掲載者数" />
                        </label>
                        <label class="contact-sex">
                            <span class="contact-sex-txt">登録者数</span>
                            <input class="graph_number" type="text" name="掲載者数" />
                        </label>
                        <label class="contact-sex">
                            <span class="contact-sex-txt">拠点数</span>
                            <input class="graph_number" type="text" name="掲載者数" />
                        </label>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">タグ</th>
                    <td id="input_pluralBox">
                        <div class="agentlist-item_category">
                            <ul>
                                <li>首都圏</li>
                                <li>ES添削</li>
                                <li>メーカー</li>
                                <li>オンライン</li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">サービスの手順1</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">サービスの手順2</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">サービスの手順3</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
                <tr>
                    <th class="contact-item">掲載期限</th>
                    <td class="contact-body">
                        <h3>マイナビ</h3>
                    </td>
                </tr>
            </table>
        </div>
        <div class="agentlist-item_return">
            <a href="../admin_company/index.html"><button>一覧に戻る</button></a>
        </div>
        </form>
    </section>

    <button class="edit"><a href="">編集申請</a></button>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
<script src="script.js"></script>

</html>