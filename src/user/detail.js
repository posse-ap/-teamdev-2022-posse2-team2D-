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
