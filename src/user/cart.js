window.onload = function () {
  var items = JSON.parse(localStorage.getItem("items")),//ローカルストレージの商品データの配列
  ele = document.getElementById('carts_list'),//カートの商品を追加する要素
  fragment = document.createDocumentFragment();//DOMの追加処理用のフラグメント

  if (items) {
    // カート商品の数分、要素を作成
    const form = document.querySelector('.form')
    const button = document.createElement('button')
    button.innerHTML='申し込みフォームへ'
    form.appendChild(button)
    for (var i = 0; i < items.length; i++) {
      var li = document.createElement('li'),
      h2 = document.createElement('h2');
      // const item = Array.from(new Set(items))
      // console.log(item)
      let result = items.filter(function (value, index, array) {
        return array.findIndex(function (element) {
          return element.name === value.name && element.age === value.age;
        }) === index
      });
      // console.log(result[i].id);
      if(result[i]){
        h2.appendChild(document.createTextNode(result[i].name));
        li.appendChild(h2);
        fragment.appendChild(li);
        const input = document.createElement('input')
        form.appendChild(input);
        input.setAttribute('type','hidden')
        input.setAttribute('name','apply[]')
        input.setAttribute('value',result[i].name)
        // const img = document.createElement('img')
        // li.appendChild(img);
        // img.setAttribute('src','img/iconmonstr-trash-can-1-240.png');
        // img.setAttribute('class','trash-can');
        // img.addEventListener('click',function(){
        //   ele.removeChild(li);
        //   form.removeChild(input);
        //   window.location.reload;
        //   console.log('こんにちは')
        // })
      }
  }
  // 作成した要素の追加
  ele.appendChild(fragment);
  // 合計金額の表示
let cart_count = document.querySelector('.count')
let list_cnt = document.getElementById('carts_list').childElementCount;
cart_count.innerHTML = list_cnt;
if(list_cnt === 0){
  let none = document.querySelector('.none');
  none.style.display = "block";
  form.removeChild(button);
}
// console.log(list_cnt);
};

}


