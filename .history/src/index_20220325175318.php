<?php
require("./dbconnect.php");
require("./graph.php");

$error = [];

$day = $_POST['day'];
$content = $_POST['content'];
$lang = $_POST['lang'];
$time = $_POST['time'];
$comment = $_POST['comment'];

if ($day === '' || $content = '' || $lang = '' || $time = ''){
    $error['login'] = 'blank';
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSSEアプリ</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header class="header">
        <div class="header_left">
            <img src="https://posse-ap.com/img/posseLogo.png" alt="" class="posse_logo">
            <p class="week">4th week</p>
        </div>
        <div class="header_right">
            <button id="modal_open" class="submit" onclick="modal_open()">記録・投稿</button>
        </div>
    </header>

    <p>学習日: <?= h($day); ?></p>
    <p>学習コンテンツ: <?= h($content); ?></p>
    <p>学習言語: <?= h($lang); ?></p>
    <p>学習時間: <?= h($time); ?></p>
    <p>Twitter用コメント: <?= h($comment); ?></p>

    <div class="content">
        <section class="content_left">
            <section class="cards">
                <div class="card">
                    <h2 class="card_title">Today</h2>
                    <p class="card_content"><?php echo $sum_day_sum[0] === NULL ?  0 :  $sum_day_sum[0]?></p>
                    <p class="card_unit">hour</p>
                </div>
                <div class="card">
                    <h2 class="card_title">Month</h2>
                    <p class="card_content"><?php echo $sum_month_sum[0] === NULL ?  0 :  $sum_month_sum[0]?></p>
                    <p class="card_unit">hour</p>
                </div>
                <div class="card">
                    <h2 class="card_title">Total</h2>
                    <p class="card_content"><?php echo $hour_sum[0] === NULL ?  0 :  $hour_sum[0]?></p>
                    <p class="card_unit">hour</p>
                </div>
            </section>
        
            <section class="bar_graph">
                <div id ='chart_div' class="graph_bar"></div>
            </section>
        
        </section>
        
        <section class="content_right">
            <div class="right_content">
                <h2 class="right_title">学習言語</h2>
                <div id="donutchart" class="donutchart"></div>
                <div class="lang_kinds">
                <p class="lang1">Javascript</p>
                <p class="lang2">CSS</p>
                <p class="lang3">PHP</p>
                <p class="lang4">HTML</p>
                <p class="lang5">Laravel</p>
                <p class="lang6">SQL</p>
                <p class="lang7">SHELL</p>
                <p class="lang8">情報システム基礎知識（その他）</p>
                </div>
            </div>
            <div class="right_content">
                <h2 class="right_title">学習コンテンツ</h2>
                <div id="donutchart2" class="donutchart"></div>
                <div class="contents_kinds">
                <p class="one_content1">ドットインストール</p>
                <p class="one_content2">N予備校</p>
                <p class="one_content3">POSSE課題</p>
                </div>
            </div>
        </section>
    </div>

    <section class="page_change">
        <button class="page_back"></button>
        <p><?php echo date('Y'); ?>年 <?php echo date('n'); ?>月</p>
        <button class="page_front"></button>
    </section>

    <div class="submit__form__footer">
        <button class="smart_button" onclick="modal_open()">記録・投稿</button>
    </div>
    
    <div id="black_shadow" class="black_shadow"></div>

    <form action="/" method="post" name="contactForm" id="modal" class="modal">
        <button id="cancel_btn" class="cancel" type="button" onclick="cancel()">×</button>

        <div class="modal_content">
            <section class="modal_left">
                <div class="submit__form__item">
                    <dt><label for="day" class="modal_title">学習日</label></dt>
                    <dd><textarea id="day"  name="day" class="small_textarea" onclick="calendar_open()"></textarea></dd>
                    if
                    <script>alert('文字を入力してください')</script>
                </div>
            <div class="submit__form__item">
                <dt class="modal_title">学習コンテンツ（複数選択可）</dt>
                <dd class="check_flex">
                    <input type="checkbox" name="content" value="N予備校" id="check0" class="check">
                    <label for="check0" class="check_2"></label>
                    <label for="check0" class="check_1">N予備校</label>
                    <input type="checkbox" name="content" value="ドットインストール" id="check1" class="check">
                    <label for="check1" class="check_2"></label>
                    <label for="check1" class="check_1">ドットインストール</label><br>
                    <input type="checkbox" name="content" value="POSSE課題" id="check2" class="check">
                    <label for="check2" class="check_2"></label>
                    <label for="check2" class="check_1">POSSE課題</label>
                </dd>
            </div>
            <div class="submit__form__item">
                <dt class="modal_title">学習言語（複数選択可）</dt>
                <dd class="check_flex">
                    <input type="checkbox" name="lang" value="HTML" id="check3" class="check">
                    <label for="check3" class="check_2"></label>
                    <label for="check3" class="check_1">HTML</label>
                    <input type="checkbox" name="lang" value="CSS" class="check" id="check4">
                    <label for="check4" class="check_2"></label>
                    <label for="check4" class="check_1">CSS</label>
                    <input type="checkbox" name="lang" value="Javascript" class="check" id="check5">
                    <label for="check5" class="check_2"></label>
                    <label for="check5" class="check_1">Javascript</label><br>
                    <input type="checkbox" name="lang" value="PHP" class="check" id="check6">
                    <label for="check6" class="check_2"></label>
                    <label for="check6" class="check_1">PHP</label>
                    <input type="checkbox" name="lang" value="Laravel" class="check" id="check7">
                    <label for="check7" class="check_2"></label>
                    <label for="check7" class="check_1">Laravel</label>
                    <input type="checkbox" name="lang" value="SQL" class="check" id="check8">
                    <label for="check8" class="check_2"></label>
                    <label for="check8" class="check_1">SQL</label>
                    <input type="checkbox" name="lang" value="SHELL" class="check" id="check9">
                    <label for="check9" class="check_2"></label>
                    <label for="check9" class="check_1">SHELL</label><br>
                    <input type="checkbox" name="lang" value="情報システム基礎知識（その他）" class="check" id="check10">
                    <label for="check10" class="check_2"></label>
                    <label for="check10" class="check_1">情報システム基礎知識(その他)</label>
                </dd>
            </div>
            </section>
            <section class="modal_right">
                <div class="submit__form__item">
                    <dt><label for="time" class="modal_title">学習時間</label></dt>
                    <dd><textarea id="time" type="number" name="time" class="small_textarea"></textarea></dd>
                </div>
                <div class="submit__form__item">
                    <dt><label for="Twitter_comment" class="modal_title">Twitter用コメント</label></dt>
                    <dd><textarea id="Twitter_comment" type="text" name="comment" class="big_textarea"></textarea></dd>
                </div>
                <input type="checkbox" name="Twitter" value="Twitterに自動投稿する" id="Twitter" class="check">
                <label for="Twitter" class="label_parent"></label>
                <label for="Twitter" class="label">Twitterに自動投稿する</label>
            </section>
        </div>
        
        <div class="submit__form__footer">
            <button class="submit__form__button" type="submit" onclick="form_submit()">記録・投稿</button>
        </div>

    </form>

    <div id="modal2" class="modal2">
        <!-- <button id="cancel_btn2" class="cancel" onclick="cancel2()">×</button> -->
        <div id="loading">
            <div class="loader003"></div>
        </div>
    </div>
    

    <div id="modal3" class="modal3">
        <button id="cancel_btn3" class="cancel" onclick="cancel4()">×</button>
        <h3 class="modal3_title">AWESOME!</h3>
        <div class="big_check"></div>
        <div class="modal3_content">
            記録・投稿<br>
            完了しました
        </div>
    </div>

    <div id="error" class="error">
    <h3 class="error_title">ERROR</h3>
    <div class="exclamation"></div>
    <div class="error_content">
        一時的にご利用できない状態です。<br>
        しばらく経ってから<br>
        再度アクセスしてください
    </div>
    </div>

    <div id="calendar_modal" class="calendar_modal">
        <button id="cancel_btn4" class="arrow_left day_cancel" onclick="cancel3()"></button>
        <div class="calendar-container">
            <section class="day_change">
                <button id="prev" class="day_back" onclick="prev()"></button>
                <h1 id="year_date"><?php echo date('Y'); ?>年 <?php echo date('n'); ?>月</h1>
                <button id="next" class="day_front" onclick="next()"></button>
            </section>
            <table id="calendar" class="calendar">
            </table>
        </div>
        <button id="day_select" class="submit2" onclick="decide_day()">決定</button>
    </div>
    

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src = "https://www.google.com/jsapi"></script>
    <script src="./js/main.js"></script>
</body>
</html>