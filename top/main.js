const btnUse = document.querySelector(".btnUse");
const modal = document.querySelector(".modal");
const black = document.querySelector(".black");
btnUse.addEventListener("click", modalUse);

function disableScroll(event) {
  event.preventDefault();
}
function modalUse() {
  modal.style.display = "block";
  black.classList.add("blacky");
  document.addEventListener("mousewheel", disableScroll, { passive: false });
  document.addEventListener("touchmove", disableScroll, { passive: false });
  document.body.style.overflow = "hidden";
  //   else{
  //   document.removeEventListener("mousewheel",disableScroll,{passive:false })
  //   document.removeEventListener("touchmove",disableScroll,{ passive: false})
  //   document.body.style.overflow = "visible";
  // }
}

const btnClose = document.querySelector(".closeBtn");
btnClose.addEventListener("click", modalClose);

function modalClose() {
  modal.style.display = "none";
  black.classList.remove("blacky");
  document.removeEventListener("mousewheel", disableScroll, { passive: false });
  document.removeEventListener("touchmove", disableScroll, { passive: false });
  document.body.style.overflow = "visible";
}

const btnCompare = document.querySelector(".btnCompare");
const white = document.querySelector(".white");
const uno = document.querySelector(".uno");
const dos = document.querySelector(".dos");
const main = document.querySelector(".main");
btnCompare.addEventListener("click", compareOpen);

function compareOpen() {
  let agent = document.querySelector("#agent");
  let agent2 = document.querySelector("#agent2");
  if (agent.value == "選択してください") {
    agent.classList.add("red");
  }
  if (agent2.value == "選択してください") {
    agent2.classList.add("red");
  }
  // if(agent.value === agent2.value){

  // }
  if (
    agent.value !== "選択してください" &&
    agent2.value !== "選択してください"
  ) {
    uno.classList.add("trans");
    dos.classList.add("trans");
    main.style.display = "none";
    returned.style.display = "block";
    agent.classList.remove("red");
    agent2.classList.remove("red");
  }
}

const returned = document.querySelector(".return");
returned.addEventListener("click", compareClose);

function compareClose() {
  uno.classList.remove("trans");
  dos.classList.remove("trans");
  main.style.display = "block";
  returned.style.display = "none";
}

const cartImg = document.querySelector(".cartImg");
const cartBox = document.querySelector(".cartBox");
cartImg.addEventListener("click", cartOpen);

function cartOpen() {
  cartBox.classList.toggle("block");
}


$(function () {
  $(".btnCompare").click(function () {
    // クリックした時にトップにスクロール
    $("html,body").animate({ scrollTop: 0 }, "500");
  });
});

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
