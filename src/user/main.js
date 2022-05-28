const btnUse = document.querySelector(".btnUse");
const help = document.querySelector(".help");
const modal = document.querySelector(".modal");
const black = document.querySelector(".black");
btnUse.addEventListener("click", modalUse);
help.addEventListener("click", modalUse);

function disableScroll(event) {
  event.preventDefault();
}
function modalUse() {
  modal.style.display = "block";
  black.classList.add("blacky");
  // document.addEventListener("mousewheel", disableScroll, { passive: false });
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
  if (agent.value == agent2.value) {
    agent.classList.add("red");
    agent2.classList.add("red");
  }
  // }
  if (
    agent.value !== "選択してください" &&
    agent2.value !== "選択してください" &&
    agent.value !== agent2.value
  ) {
    uno.classList.add("trans");
    dos.classList.add("trans");
    // main.style.display = "none";
    main.classList.add("inviews");
    setTimeout(function () {
      main.style.display = "none";
    }, 800);
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
  setTimeout(function () {
    main.classList.remove("inviews");
  }, 2000);
  setTimeout(function () {
    main.style.display = "block";
  }, 1500);
  returned.style.display = "none";
}



$(function () {
  $(".btnCompare").click(function () {
    // クリックした時にトップにスクロール
    $("html,body").animate({ scrollTop: 0 }, "500");
  });
});


function slider() {
  const btn = document.querySelector(".menu-content");
  const rotated = document.querySelector(".mobile-menu-icon");
  // const changeBg =document.querySelector('.back');
  btn.classList.toggle("inview");
  rotated.classList.toggle("menu-open");
  // changeBg.classList.toggle('blacky');
}

// if(clicked.indexOf(index) == -1)

const numbers = document.querySelectorAll(".number");
numbers.forEach(function (value) {
  let string = value.textContent;
  let number = Number(string);
  let three_number = number.toLocaleString();
  value.innerHTML = three_number;
});


  window.onload = function () {
    var cart_btns = document.querySelectorAll(".js_cart_btn"), //カートボタン
      cart_cnt_icon = document.getElementById("js_cart_cnt"), //カートの個数アイコン
      cart_cnt = 0, //カートのアイテム数
      clicked = [], //クリックされたカートアイコンのインデックス
      save_items = []; //ローカルストレージ保存用の配列
    items = JSON.parse(localStorage.getItem("items")); //ローカルストレージの商品データ配列
    cart_cnt_icon.innerHTML = cart_cnt;
    // すでにカートに商品が入っている場合、カートアイコンのカウント表示とカートボタンをアクティブにする
    if (items) {
      var name;
      var id;
      for (var i = 0; i < items.length; i++) {
        name = items[i].name;
        id = items[i].id;
        save_items.push(items[i]);
        clicked.push(id);
        activate_btn(name);
      }
      if (items.length != 0) {
        cart_cnt_icon.parentNode.classList.remove("hidden");
        cart_cnt_icon.innerHTML = cart_cnt;
      }
    }
  
    // カートボタンを押した際の処理
    cart_btns.forEach(function (cart_btn) {
      cart_btn.addEventListener("click", function () {
        var name = cart_btn.dataset.name; //商品の名前を取得
        var id = cart_btn.dataset.id;
        // カートボタンがすでに押されているかの判定
        if (clicked.indexOf(id) >= 0) {
          for (var i = 0; i < clicked.length; i++) {
            if (clicked[i] == id) {
              clicked.splice(i, 1);
              console.log(save_items[i]);
              save_items.splice(i, 1);
            }
          }
          // inactivate_btn(name);
          let agentDatas = document.querySelectorAll(
            '[data-name="' + name + '"]'
          );
          agentDatas.forEach(function (agentData) {
            if (agentData.classList.contains("cart_active")) {
              inactivate_btn(name);
            }
          });
        } else {
          clicked.push(id);
          save_items.push({
            id: id,
            name: name,
          });
          // activate_btn(name);
          let agentDatas = document.querySelectorAll(
            '[data-name="' + name + '"]'
          );
          agentDatas.forEach(function (agentData) {
            if (!agentData.classList.contains("cart_active")) {
              activate_btn(name);
            }
          });
        }
        // ローカルストレージに商品データを保管
        localStorage.setItem("items", JSON.stringify(save_items));
      });
    });
  
    function activate_btn(name) {
      // cart_btns[index].classList.add('cart_active');
      let agentDatas = document.querySelectorAll('[data-name="' + name + '"]');
      agentDatas.forEach(function (agentData, index) {
        agentData.classList.add("cart_active");
        agentData.innerHTML = "カートから外す";
        // if (cart_cnt >= 1) {
        //   cart_cnt_icon.parentNode.classList.remove("hidden");
        // }
      });
      cart_cnt++;
      cart_cnt_icon.innerHTML = cart_cnt;
    }
    function inactivate_btn(name) {
      // cart_btns[index].classList.remove('cart_active');
      let agentDatas = document.querySelectorAll('[data-name="' + name + '"]');
      agentDatas.forEach(function (agentData) {
        agentData.classList.remove("cart_active");
        agentData.innerHTML = "カートに入れる";
        // if (cart_cnt == 0) {
        //   cart_cnt_icon.parentNode.classList.remove("hidden");
        // }
      });
      cart_cnt--;
      cart_cnt_icon.innerHTML = cart_cnt;
    }

  // const close = document.querySelector(".close");
  // const open = document.querySelector(".open");
  // const compareBar = document.querySelector(".compareBar");
  // close.addEventListener("click", function () {
  //   compareBar.classList.add("notinview");
  //   close.style.display = "none";
  //   open.style.display = "block";
  // });

  // open.addEventListener("click", function () {
  //   compareBar.classList.remove("notinview");
  //   close.style.display = "block";
  //   open.style.display = "none";
  // });

  // const image = document.createElement('img');
  // const image2 = document.createElement('img');
  // const business = document.querySelector('.business');
  // const industry = document.querySelector('.industry');

  // if(business.innerHTML === '総合'){
  //   image2.setAttribute('src','img/iconmonstr-circle-4-240 (1).png')
  // }

  // if(industry.innerHTML === 'IT'){
  //   image.setAttribute('src','img/iconmonstr-laptop-4-240.png')
  // }

  // const field = document.querySelector('.two');
  // field.appendChild(image);

  // const fields= document.querySelector('.one');
  // fields.appendChild(image2);
  $(function () {
    $("#agent").on("change", function (event) {
      let agent = $("#agent").val();
      $.ajax({
        type: "POST",
        url: "getData2.php",
        data: { agent: agent },
        dataType: "json",
      })
        .done(function (data) {
          $(".ponta").remove();
          data.forEach(function (value, index) {
            $(".list").append('<li class="ponta tag_uno">' + data[index].tag + "</li>");
          });
        })
        .fail(function (XMLHttpRequest, status, e) {
          alert(e);
        });
    });
  });

  $(function () {
    $("#agent").on("change", function (event) {
      let agent = $("#agent").val();
      $.ajax({
        type: "POST",
        url: "getData.php",
        data: { agent: agent },
        dataType: "json",
      })
        .done(function (data) {
          $(".compare-cart").remove();
          $(".hidden-value").remove();
          $(".compare-detail").remove();
          $(".company").html('<p><span class="number">' + data[0].company + "</span>社</p>");
          $(".decision").html('<p><span class="number">' + data[0].decision + "</span>人</p>");
          $(".speed").html('<p><span class="number">' + data[0].speed + "</span>週間</p>");
          $(".regist").html('<p><span class="number">' + data[0].regist + "</span>人</p>");
          $(".place").html('<p><span class="number">' + data[0].place + "</span>箇所</p>");
          $(".image").html('<img src="img/' + data[0].names + '.png"></img>');
          $(".detail1").append(
            '<input type="hidden" value="' +
              data[0].names +
              '" name="detail" class="hidden-value">'
          );
          $(".detail1").append(
            '<input type="submit" value="詳細はこちら" class="detail btn compare-detail">'
          );
          $(".cart1").append(
            '<button class="cart js_cart_btn btn compare-cart" data-name="' +
              data[0].names +
              '" data-id="' +
              data[0].id +
              '">カートに入れる</button>'
          );
          const numbers = document.querySelectorAll(".number");
          numbers.forEach(function (value) {
            let string = value.textContent;
            let number = Number(string);
            let three_number = number.toLocaleString();
            value.innerHTML = three_number;
          });

          const styles = document.querySelector(".styles");
          const lists = document.querySelectorAll(".tag_uno");
          const images = document.createElement("img");
          images.setAttribute('class','styleImg')
          lists.forEach(function (list) {
            if (list.innerHTML == "対面") {
              styles.innerHTML = "対面";
              console.log('こんにちは')
            } else if (list.innerHTML == "オンライン") {
              styles.innerHTML = "オンライン";
              console.log('おはようございます')
            }
          });
          if (styles.innerHTML == "対面") {
            images.setAttribute("src", "img/iconmonstr-generation-11-240.png");
          } else if (styles.innerHTML == "オンライン") {
            images.setAttribute("src", "img/iconmonstr-video-camera-5-240.png");
          }
          $(".styleImg").remove();
          $(".one").append(images);
          var ctx = document.querySelector(".myRadarChart-uno");
          var myRadarChart = new Chart(ctx, {
            //グラフの種類
            type: "radar",
            //データの設定
            data: {
              //データ項目のラベル
              labels: [
                "掲載社数",
                "内定実績",
                "スピード",
                "登録者数",
                "拠点数",
              ],
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
                  // data: [five1,five2,five3,five4,five5],
                  data: [
                    data[0].company_five,
                    data[0].decision_five,
                    data[0].speed_five,
                    data[0].regist_five,
                    data[0].place_five,
                  ],
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
          var cart_btns = document.querySelectorAll(".js_cart_btn"), //カートボタン
            cart_cnt_icon = document.getElementById("js_cart_cnt"), //カートの個数アイコン
            // cart_cnt = 0, //カートのアイテム数
            clicked = [], //クリックされたカートアイコンのインデックス
            save_items = []; //ローカルストレージ保存用の配列
          items = JSON.parse(localStorage.getItem("items")); //ローカルストレージの商品データ配列
          // すでにカートに商品が入っている場合、カートアイコンのカウント表示とカートボタンをアクティブにする
          if (items) {
            var name;
            var id;
            for (var i = 0; i < items.length; i++) {
              name = items[i].name;
              id = items[i].id;
              save_items.push(items[i]);
              clicked.push(id);
              activate_btn(name);
              cart_cnt--
              // long.forEach(function (value) {

              // });
            }
            if (items.length != 0) {
              cart_cnt_icon.parentNode.classList.remove("hidden");
              cart_cnt_icon.innerHTML = cart_cnt;
            }
          }

          // カートボタンを押した際の処理
          cart_btns.forEach(function (cart_btn) {
            cart_btn.addEventListener("click", function () {
              var name = cart_btn.dataset.name; //商品の名前を取得
              var id = cart_btn.dataset.id;
              // カートボタンがすでに押されているかの判定
              if (clicked.indexOf(id) >= 0) {
                for (var i = 0; i < clicked.length; i++) {
                  if (clicked[i] == id) {
                    clicked.splice(i, 1);
                    save_items.splice(i, 1);
                  }
                }
                // inactivate_btn(name);
                let agentDatas = document.querySelectorAll(
                  '[data-name="' + name + '"]'
                );
                agentDatas.forEach(function (agentData) {
                  if (agentData.classList.contains("cart_active")) {
                    inactivate_btn(name);
                  }
                });
              } else {
                clicked.push(id);
                save_items.push({
                  id: id,
                  name: name,
                });
                // activate_btn(name);
                let agentDatas = document.querySelectorAll(
                  '[data-name="' + name + '"]'
                );
                agentDatas.forEach(function (agentData) {
                  if (!agentData.classList.contains("cart_active")) {
                    activate_btn(name);
                  }
                });
              }

              // ローカルストレージに商品データを保管
              localStorage.setItem("items", JSON.stringify(save_items));
            });
          });
          function activate_btn(name) {
            // cart_btns[index].classList.add('cart_active');
            let agentDatas = document.querySelectorAll(
              '[data-name="' + name + '"]'
            );
            agentDatas.forEach(function (agentData, index) {
              agentData.classList.add("cart_active");
              agentData.innerHTML = "カートから外す";
              // if (cart_cnt >= 1) {
              //   cart_cnt_icon.parentNode.classList.remove("hidden");
              // }
            });
            cart_cnt++;
            cart_cnt_icon.innerHTML = cart_cnt;
          }
          function inactivate_btn(name) {
            // cart_btns[index].classList.remove('cart_active');
            let agentDatas = document.querySelectorAll(
              '[data-name="' + name + '"]'
            );
            agentDatas.forEach(function (agentData) {
              agentData.classList.remove("cart_active");
              agentData.innerHTML = "カートに入れる";
              // if (cart_cnt == 0) {
              //   cart_cnt_icon.parentNode.classList.remove("hidden");
              // }
            });
            cart_cnt--;
            cart_cnt_icon.innerHTML = cart_cnt;
          }
        })
        .fail(function (XMLHttpRequest, status, e) {
          alert(e);
        });
    });
  });

  $(function () {
    $("#agent2").on("change", function (event) {
      let agent2 = $("#agent2").val();
      $.ajax({
        type: "POST",
        url: "getData4.php",
        data: { agent2: agent2 },
        dataType: "json",
      })
        .done(function (data) {
          $(".ponta2").remove();
          data.forEach(function (value, index) {
            $(".list2").append(
              '<li class="ponta2 tag_dos">' + data[index].tag + "</li>"
            );
          });
        })
        .fail(function (XMLHttpRequest, status, e) {
          alert(e);
        });
    });
  });

  $(function () {
    $("#agent2").on("change", function (event) {
      let agent2 = $("#agent2").val();
      $.ajax({
        type: "POST",
        url: "getData3.php",
        data: { agent2: agent2 },
        dataType: "json",
      })
        .done(function (data) {
          const lists2 = document.querySelectorAll(".tag_dos");
          const styles2 = document.querySelector(".styles2");
          const images2 = document.createElement("img");
          images2.setAttribute('class','styleImg2')
          lists2.forEach(function (list) {
            if (list.innerHTML == "対面") {
              styles2.innerHTML = "対面";
            } else if (list.innerHTML == "オンライン") {
              styles2.innerHTML = "オンライン";
            }
          });

          if (styles2.innerHTML == "対面") {
            images2.setAttribute("src", "img/iconmonstr-generation-11-240.png");
          } else if (styles2.innerHTML == "オンライン") {
            images2.setAttribute("src", "img/iconmonstr-video-camera-5-240.png");
          }
          $(".styleImg2").remove();
          $(".two").append(images2)
          $(".compare-cart2").remove();
          $(".hidden-value2").remove();
          $(".compare-detail2").remove();
          $(".company2").html('<p><span class="number2">' + data[0].company + "</span>社</p>");
          $(".decision2").html('<p><span class="number2">' + data[0].decision + "</span>人</p>");
          $(".speed2").html('<p><span class="number2">' + data[0].speed + "</span>週間</p>");
          $(".regist2").html('<p><span class="number2">' + data[0].regist + "</span>人</p>");
          $(".place2").html('<p><span class="number2">' + data[0].place + "</span>箇所</p>");
          $(".image2").html('<img src="img/' + data[0].names + '.png"></img>');
          $(".detail2").append(
            '<input type="hidden" value="' +
              data[0].names +
              '" name="detail" class="hidden-value2">'
          );
          $(".detail2").append(
            '<input type="submit" value="詳細はこちら" class="detail btn compare-detail2">'
          );
          $(".cart2").append(
            '<button class="cart js_cart_btn btn compare-cart2" data-name="' +
              data[0].names +
              '" data-id="' +
              data[0].id +
              '">カートに入れる</button>'
          );
          const numbers2 = document.querySelectorAll(".number2");
          numbers2.forEach(function (value) {
            let string2 = value.textContent;
            let number2 = Number(string2);
            let three_number2 = number2.toLocaleString();
            value.innerHTML = three_number2;
          });

          var ctx = document.querySelector(".myRadarChart-dos");
          var myRadarChart = new Chart(ctx, {
            //グラフの種類
            type: "radar",
            //データの設定
            data: {
              //データ項目のラベル
              labels: [
                "掲載社数",
                "内定実績",
                "スピード",
                "登録者数",
                "拠点数",
              ],
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
                  // data: [five1,five2,five3,five4,five5],
                  data: [
                    data[0].company_five,
                    data[0].decision_five,
                    data[0].speed_five,
                    data[0].regist_five,
                    data[0].place_five,
                  ],
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
          var cart_btns = document.querySelectorAll(".js_cart_btn"), //カートボタン
            // cart_cnt_icon = document.getElementById("js_cart_cnt"), //カートの個数アイコン
            // cart_cnt = 0, //カートのアイテム数
            clicked = [], //クリックされたカートアイコンのインデックス
            save_items = []; //ローカルストレージ保存用の配列
          items = JSON.parse(localStorage.getItem("items")); //ローカルストレージの商品データ配列
          // すでにカートに商品が入っている場合、カートアイコンのカウント表示とカートボタンをアクティブにする
          if (items) {
            var name;
            var id;
            for (var i = 0; i < items.length; i++) {
              name = items[i].name;
              id = items[i].id;
              save_items.push(items[i]);
              clicked.push(id);
              activate_btn(name);
              cart_cnt--
            }
            if (items.length != 0) {
              cart_cnt_icon.parentNode.classList.remove("hidden");
              cart_cnt_icon.innerHTML = cart_cnt;
            }
          }

          // カートボタンを押した際の処理
          cart_btns.forEach(function (cart_btn) {
            cart_btn.addEventListener("click", function () {
              var name = cart_btn.dataset.name; //商品の名前を取得
              var id = cart_btn.dataset.id;
              // カートボタンがすでに押されているかの判定
              if (clicked.indexOf(id) >= 0) {
                for (var i = 0; i < clicked.length; i++) {
                  if (clicked[i] == id) {
                    clicked.splice(i, 1);
                    save_items.splice(i, 1);
                  }
                }
                // inactivate_btn(name);
                let agentDatas = document.querySelectorAll(
                  '[data-name="' + name + '"]'
                );
                agentDatas.forEach(function (agentData) {
                  if (agentData.classList.contains("cart_active")) {
                    inactivate_btn(name);
                  }
                });
              } else {
                clicked.push(id);
                save_items.push({
                  id: id,
                  name: name,
                });
                // activate_btn(name);
                let agentDatas = document.querySelectorAll(
                  '[data-name="' + name + '"]'
                );
                agentDatas.forEach(function (agentData) {
                  if (!agentData.classList.contains("cart_active")) {
                    activate_btn(name);
                  }
                });
              }
              // ローカルストレージに商品データを保管
              localStorage.setItem("items", JSON.stringify(save_items));
            });
          });
          function activate_btn(name) {
            console.log("hello");
            console.log(name);
            // cart_btns[index].classList.add('cart_active');
            let agentDatas = document.querySelectorAll(
              '[data-name="' + name + '"]'
            );
            agentDatas.forEach(function (agentData, index) {
              agentData.classList.add("cart_active");
              agentData.innerHTML = "カートから外す";
              // if (cart_cnt >= 1) {
              //   cart_cnt_icon.parentNode.classList.remove("hidden");
              // }
            });
            cart_cnt++;
            cart_cnt_icon.innerHTML = cart_cnt;
          }
          function inactivate_btn(name) {
            // cart_btns[index].classList.remove('cart_active');
    
            let agentDatas = document.querySelectorAll(
              '[data-name="' + name + '"]'
            );
            agentDatas.forEach(function (agentData) {
              agentData.classList.remove("cart_active");
              agentData.innerHTML = "カートに入れる";
              // if (cart_cnt == 0) {
              //   cart_cnt_icon.parentNode.classList.remove("hidden");
              // }
            });
            cart_cnt--;
            cart_cnt_icon.innerHTML = cart_cnt;
          }

        })
        .fail(function (XMLHttpRequest, status, e) {
          alert(e);
        });
    });
  });
};

// window.localStorage.clear();

// window.addEventListener('pageshow',()=>{
// 	if(window.performance.navigation.type==2) location.reload();
// });