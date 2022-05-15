const btnUse = document.querySelector(".btnUse");
const help = document.querySelector('.help')
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
  if (agent.value == agent2.value){
    agent.classList.add("red");
    agent2.classList.add("red");
  }
  // }
  if (
    agent.value !== "選択してください" &&
    agent2.value !== "選択してください" && agent.value !== agent2.value
  ) {
    uno.classList.add("trans");
    dos.classList.add("trans");
    // main.style.display = "none";
    main.classList.add('inviews');
    setTimeout(function(){
      main.style.display = 'none';
    },800)
    returned.style.display = "block";
    agent.classList.remove("red");
    agent2.classList.remove("red");
    var cart_btns = document.querySelectorAll('.js_cart_btn'),//カートボタン
    cart_cnt_icon = document.getElementById('js_cart_cnt'),//カートの個数アイコン
    cart_cnt = 0,//カートのアイテム数
    clicked = [],//クリックされたカートアイコンのインデックス
    save_items = [];//ローカルストレージ保存用の配列
    items = JSON.parse(localStorage.getItem("items"));//ローカルストレージの商品データ配列
    function activate_btn(name) {
      // cart_btns[index].classList.add('cart_active');
      let companyDatas = document.querySelectorAll('[data-name="'+name+'"]')
      companyDatas.forEach(function(companyData,index){
        companyData.classList.add('cart_active')
        if( cart_cnt >= 1 ){
          cart_cnt_icon.parentNode.classList.remove('hidden');
        }
    })
    cart_cnt++
      cart_cnt_icon.innerHTML = cart_cnt;
      console.log('active')
    }
    if (items) {
      var name;
      var id;
      for (var i = 0; i < items.length; i++) {
        name = items[i].name;
        id = items[i].id
        save_items.push(items[i]);
        clicked.push(id);
        activate_btn(name);
      }
      if(items.length != 0){
        cart_cnt_icon.parentNode.classList.remove('hidden');
        cart_cnt_icon.innerHTML = cart_cnt;
      }
    }
  }
}

const returned = document.querySelector(".return");
returned.addEventListener("click", compareClose);

function compareClose() {
  uno.classList.remove("trans");
  dos.classList.remove("trans");
  setTimeout(function(){
    main.classList.remove('inviews')
  },2000)
  setTimeout(function(){
    main.style.display = "block";
  },1500)
  returned.style.display = "none";
}

// const cartImg = document.querySelector(".cartImg");
// const cartBox = document.querySelector(".cartBox");
// cartImg.addEventListener("click", cartOpen);

// function cartOpen() {
//   cartBox.classList.toggle("block");
// }

$(function () {
  $(".btnCompare").click(function () {
    // クリックした時にトップにスクロール
    $("html,body").animate({ scrollTop: 0 }, "500");
  });
});



// var cart_btns = document.querySelectorAll(".js_cart_btn"), //カートボタン
//   cart_cnt_icon = document.getElementById("js_cart_cnt"), //カートの個数アイコン
//   cart_cnt = 0; //カートのアイテム数
// var clicked = [];
// var cart_count = document.querySelector(".count");
// var save_items = [];//ローカルストレージ保存用の配列
// // カートボタンを押した際の処理
// cart_btns.forEach(function (cart_btn, index) {
//   cart_btn.addEventListener("click", function () {
//     //ボタンが押されたらカウントを増やす

//     if (clicked.indexOf(index) >= 0) {
//       //ボタンのindexが配列に含まれていたら、配列から削除
//       for (var i = 0; i < clicked.length; i++) {
//         if (clicked[i] == index) {
//           clicked.splice(i, 1);
//           //カートアイコンの数を減らす
//           cart_cnt--;
//           //0の時はカートアイコンのカウントを表示させない
//           //データ保管ようの配列から対象の商品データを削除
//           save_items.splice(i, 1);
//           if (cart_cnt == 0) {
//             cart_cnt_icon.parentNode.classList.add("hidden");
//           }
//           cart_cnt_icon.innerHTML = cart_cnt;
//           cart_count.innerHTML = cart_cnt;
//           //カートボタンを非アクティブにする
//           cart_btn.classList.remove("cart_active");
//         }
//       }
//     } else if (clicked.indexOf(index) == -1) {
//       //ボタンのindexが配列に含まれていなかったら、配列に追加
//       clicked.push(index);
//       cart_cnt++;
//       //カウントが1以上なら、カウントアイコンからclass「hidden」を外す
//       if (cart_cnt >= 1) {
//         cart_cnt_icon.parentNode.classList.remove("hidden");
//       }
//       //カウントアイコンにカウントを出力
//       cart_cnt_icon.innerHTML = cart_cnt;
//       cart_count.innerHTML = cart_cnt;
//       cart_btn.classList.add("cart_active");
//       //カスタムデータ属性から商品名と価格を取得
//       var name = cart_btn.dataset.name; //商品の名前を取得
//       save_items.push({
//         id: index,
//         name: name,
//       });
//     }
//     localStorage.setItem("items", JSON.stringify(save_items));
//   });
// });

// var items = JSON.parse(localStorage.getItem("items")), //ローカルストレージの商品データの配列
//   ele = document.querySelector(".cart_list"), //カートの商品を追加する要素
//   fragment = document.createDocumentFragment(); //DOMの追加処理用のフラグメント

// if (items) {
//   // カート商品の数分、要素を生成
//   for (var i = 0; i < items.length; i++) {
//     var li = document.createElement("li"),
//       h2 = document.createElement("h2");

//     //要素に商品データを追加
//     h2.appendChild(document.createTextNode(items[i].name));

//     //商品名と価格の要素をliに追加
//     li.appendChild(h2);
//     fragment.appendChild(li);
//   }
// }

// // 作成した要素の追加
// ele.appendChild(fragment);



window.onload = function () {
  var cart_btns = document.querySelectorAll('.js_cart_btn'),//カートボタン
  cart_cnt_icon = document.getElementById('js_cart_cnt'),//カートの個数アイコン
  cart_cnt = 0,//カートのアイテム数
  clicked = [],//クリックされたカートアイコンのインデックス
  save_items = [];//ローカルストレージ保存用の配列
  items = JSON.parse(localStorage.getItem("items"));//ローカルストレージの商品データ配列
  // すでにカートに商品が入っている場合、カートアイコンのカウント表示とカートボタンをアクティブにする
  if (items) {
    console.log(items)
    var name;
    var id;
    for (var i = 0; i < items.length; i++) {
      name = items[i].name;
      id = items[i].id;
      save_items.push(items[i]);
      clicked.push(id);
      activate_btn(name);
    }
    if(items.length != 0){
      cart_cnt_icon.parentNode.classList.remove('hidden');
      cart_cnt_icon.innerHTML = cart_cnt;
    }
  }

  // カートボタンを押した際の処理
  cart_btns.forEach(function (cart_btn) {
    cart_btn.addEventListener('click',function () {
      var name = cart_btn.dataset.name;//商品の名前を取得
      var id = cart_btn.dataset.id
      // カートボタンがすでに押されているかの判定
      if (clicked.indexOf(id) >= 0) {
        console.log('やったね')
        for (var i = 0; i < clicked.length; i++) {
          if(clicked[i] == id){
            clicked.splice(i, 1);
            console.log(save_items[i]);
            save_items.splice(i, 1);
          }
        }
        // inactivate_btn(name);
        let companyDatas = document.querySelectorAll('[data-name="'+name+'"]')
        companyDatas.forEach(function(companyData){
        if(companyData.classList.contains('cart_active')){
          inactivate_btn(name)
        }
        })
      }else{
        console.log('残念')
        clicked.push(id);
        save_items.push({
          id: id,
          name: name
        });
        // activate_btn(name);
        let companyDatas = document.querySelectorAll('[data-name="'+name+'"]')
        companyDatas.forEach(function(companyData){
          if(!companyData.classList.contains('cart_active')){
            activate_btn(name)
          }
          })
      }
      // ローカルストレージに商品データを保管
      localStorage.setItem("items",JSON.stringify(save_items));
    });
  });

  function activate_btn(name) {
    // cart_btns[index].classList.add('cart_active');
    let companyDatas = document.querySelectorAll('[data-name="'+name+'"]')
    companyDatas.forEach(function(companyData,index){
      companyData.classList.add('cart_active');
      companyData.innerHTML = 'カートから外す'
      if( cart_cnt >= 1 ){
        cart_cnt_icon.parentNode.classList.remove('hidden');
      }
  })
  cart_cnt++
    cart_cnt_icon.innerHTML = cart_cnt;
  }
  function inactivate_btn(name) {
    // cart_btns[index].classList.remove('cart_active');
    let companyDatas = document.querySelectorAll('[data-name="'+name+'"]')
    companyDatas.forEach(function(companyData){
      companyData.classList.remove('cart_active')
      companyData.innerHTML = 'カートに入れる'
      if(cart_cnt == 0){
        cart_cnt_icon.parentNode.classList.remove('hidden');
      }
  })
  cart_cnt--;
    cart_cnt_icon.innerHTML = cart_cnt;
  }
};


function slider(){
  const btn =document.querySelector('.menu-content');
  const rotated =document.querySelector('.mobile-menu-icon');
  // const changeBg =document.querySelector('.back');
  btn.classList.toggle('inview');
  rotated.classList.toggle('menu-open');
  // changeBg.classList.toggle('blacky');
}

// window.localStorage.clear();

// if(clicked.indexOf(index) == -1)

const numbers = document.querySelectorAll('.number');
numbers.forEach(function(value){
    let string = value.textContent;
    let number = Number(string);
    let three_number = number.toLocaleString();
    value.innerHTML = three_number;
})

const close = document.querySelector('.close');
const open = document.querySelector('.open');
const compareBar = document.querySelector('.compareBar');
close.addEventListener('click',function(){
    compareBar.classList.add('notinview');
    close.style.display = 'none';
    open.style.display = 'block';
})

open.addEventListener('click',function(){
  compareBar.classList.remove('notinview');
  close.style.display= 'block';
  open.style.display = 'none';
})