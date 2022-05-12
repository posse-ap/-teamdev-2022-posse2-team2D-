window.onload = function () {
  var items = JSON.parse(localStorage.getItem("items")),//ローカルストレージの商品データの配列
  ele = document.getElementById('carts_list'),//カートの商品を追加する要素
  fragment = document.createDocumentFragment();//DOMの追加処理用のフラグメント

  if (items) {
    // カート商品の数分、要素を作成
    for (var i = 0; i < items.length; i++) {
      var li = document.createElement('li'),
      h2 = document.createElement('h2');
      
      h2.appendChild(document.createTextNode(items[i].name));
      li.appendChild(h2);
      fragment.appendChild(li);

      // 合計金額を加算
    }
  }else{
    
  }

  // 作成した要素の追加
  ele.appendChild(fragment);
  // 合計金額の表示
let cart_count = document.querySelector('.count')
let list_cnt = document.getElementById('carts_list').childElementCount;
cart_count.innerHTML = list_cnt;
// console.log(list_cnt);
};




