'use strict;'
// 選択肢の配列と選択肢群
let No1Selection = ['たかなわ','たかわ','こうわ']
let No2Selection = ['かめいど','かめど','かめと']
let No3Selection = ['こうじまち','かゆまち','おかとまち']
let No4Selection = ['おなりもん','おかどもん','ごせいもん']
let No5Selection = ['とどりき','たたら','たたりき']
let No6Selection = ['しゃくじい','せきこうい','いじい']
let No7Selection = ['ぞうしき','ざっしき','ざっしょく']
let No8Selection = ['おかちまち','みとちょう','ごしろちょう']
let No9Selection = ['ししぼね','ろっこつ','しこね']
let No10Selection= ['こぐれ','こばく','こしゃく']
let Selections   = [No1Selection,No2Selection,No3Selection,No4Selection,No5Selection,
                    No6Selection,No7Selection,No8Selection,No9Selection,No10Selection]
// 画像の配列
let Pictures =['<img src="https://d1khcm40x1j0f.cloudfront.net/quiz/34d20397a2a506fe2c1ee636dc011a07.png" alt="高輪">',
                '<img src="https://d1khcm40x1j0f.cloudfront.net/quiz/512b8146e7661821c45dbb8fefedf731.png" alt="亀戸">',
                '<img src="https://d1khcm40x1j0f.cloudfront.net/quiz/ad4f8badd896f1a9b527c530ebf8ac7f.png" alt="麹町">',
                '<img src="https://d1khcm40x1j0f.cloudfront.net/quiz/ee645c9f43be1ab3992d121ee9e780fb.png" alt="御成門">',
                '<img src="https://d1khcm40x1j0f.cloudfront.net/quiz/6a235aaa10f0bd3ca57871f76907797b.png" alt="等々力">',
                '<img src="https://d1khcm40x1j0f.cloudfront.net/quiz/0b6789cf496fb75191edf1e3a6e05039.png" alt="石神井">',
                '<img src="https://d1khcm40x1j0f.cloudfront.net/quiz/23e698eec548ff20a4f7969ca8823c53.png" alt="雑色">',
                '<img src="https://d1khcm40x1j0f.cloudfront.net/quiz/50a753d151d35f8602d2c3e2790ea6e4.png" alt="御徒町">',
                '<img src="https://d1khcm40x1j0f.cloudfront.net/words/8cad76c39c43e2b651041c6d812ea26e.png" alt="鹿骨">',
                '<img src="https://d1khcm40x1j0f.cloudfront.net/words/34508ddb0789ee73471b9f17977e7c9c.png" alt="小榑">',]
//ボタンシャッフルのための配列
let button = ['0','1','2']

// 本文
for(let count = 0; count < 10; count++){
    for(i = button.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var tmp = button[i];
        button[i] = button[j];
        button[j] = tmp;
    }
    let content=
        '<div class="content">' +
        '<div class="question"><p>' +(count+1)+'. この地名はなんて読む？</p></div>'+
        Pictures[count] + '<br>'+
        '<button onclick="Judgment('+count+','+button[0]+')" class= "before" id="No' + (count+1) +'Answer'+button[0]+'"><div id="No'+(count+1)+button[0]+'"></div></button><br>' +
        '<button onclick="Judgment('+count+','+button[1]+')" class= "before" id="No' + (count+1) +'Answer'+button[1]+'"><div id="No'+(count+1)+button[1]+'"></div></button><br>' +
        '<button onclick="Judgment('+count+','+button[2]+')" class= "before" id="No' + (count+1) +'Answer'+button[2]+'"><div id="No'+(count+1)+button[2]+'"></div></button><br>' +
        '<div class="nothing" id="No' +(count+1)+'CommentBlue">' + 
            '<span class="blue-line">正解！</span><br>' +
            '<div id="No' +(count+1)+'CommentTrue"></div>' +
        '</div>' +
        '<div class="nothing" id="No' +(count+1)+'CommentRed">' +
            '<span class="red-line">不正解！</span><br>' +
            '<div id="No' +(count+1)+'CommentFalse"></div>' +
        '</div><br>' +
        '</div>';
        document.write(content);
}
    // 選択肢の名称
for(let n = 0; n < 10; n++){
    for(let i=0; i<No1Selection.length; i++){
        target = document.getElementById('No'+(n+1)+i)
        target.innerHTML = Selections[n][i]
    }}
    // 正解、不正解のコメント
for(let e = 0; e < 10; e++){
    comment1 =document.getElementById('No' + (e+1) + 'CommentTrue')
    comment1.innerHTML ="正解は「"+Selections[e][0]+"」です！"
    comment2= document.getElementById('No' + (e+1) + 'CommentFalse')
    comment2.innerHTML ="正解は「"+Selections[e][0]+"」です！"
    }
    
    function Judgment(Number,clicked){
        document.getElementById('No'+(Number+1)+'Answer'+clicked).className = 'incorrect';
        document.getElementById('No'+(Number+1)+'Answer0').className = 'correct';
        document.getElementById('No'+(Number+1)+'Answer0').classList.add('after');
        document.getElementById('No'+(Number+1)+'Answer1').classList.add('after');
        document.getElementById('No'+(Number+1)+'Answer2').classList.add('after');
        if(Selections[Number][0] === document.getElementById('No'+(Number+1)+'Answer'+clicked).textContent){
        document.getElementById('No'+(Number+1)+'CommentBlue').className = 'comment';
        }
        else{
        document.getElementById('No'+(Number+1)+'CommentRed').className = 'comment';
    }
    }


    document.getElementById("id_1")