var ctx = document.getElementById("myRadarChart");
var myRadarChart = new Chart(ctx, {
    //グラフの種類
    type: "radar",
    //データの設定
    data: {
        //データ項目のラベル
        labels: ["掲載社数", "内定実績", "スピード", "登録者数", "拠点数"],
        //データセット
        datasets: [
            {
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
                data: [3, 4, 3, 5, 5],
            },
        ],
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

function change_top(){
    const top = document.getElementById('top');
    const detail = document.getElementById('detail');
    const info = document.getElementById('info');
    top.style.display = 'block';
    detail.style.display = 'none';
    info.style.display = 'none';
}

function change_detail(){
    const top = document.getElementById('top');
    const detail = document.getElementById('detail');
    const info = document.getElementById('info');
    top.style.display = 'none';
    detail.style.display = 'block';
    info.style.display = 'none';
}

function change_info(){
    const top = document.getElementById('top');
    const detail = document.getElementById('detail');
    const info = document.getElementById('info');
    top.style.display = 'none';
    detail.style.display = 'none';
    info.style.display = 'block';
}

function page_changes(){
    const page_change= document.getElementById('page_change');
    page_change.classList.toggle('visual_set');
}



function inputChange(){
    var choice = document.getElementById("choice");
    console.log(choice.value);
    if(choice == 1){

    }else if(choice == 2){

    }
    
}
