modal = document.getElementById('modal');
modal2 = document.getElementById('modal2');
black_shadow = document.getElementById('black_shadow');
calendar = document.getElementById('calendar_modal');

function modal_open(){
    modal.style.display = 'block';
    black_shadow.style.display = 'block';
}


function cancel2(){
    modal2.style.display = 'none';
    black_shadow.style.display = 'none';
}

function cancel3(){
    calendar.style.display = 'none';
    modal.style.display = 'block';
}

function cancel4(){
    let class_day = document.getElementsByClassName('day');
    modal3.style.display = 'none';
    black_shadow.style.display = 'none';
    let set_date = document.getElementById('day');
    set_date.value = "";
    for (let i = 0; i < class_day.length; i++) {
        class_day[i].classList.remove('day_checked');
    };
    let time = document.getElementById('time');
    time.value = "";
    let twitter = document.getElementById('Twitter_comment');
    twitter.value = "";
    //チェックボックスのリスト
    let checkbox_list = document.querySelectorAll(".check");
		//全て解除
		for (let i in checkbox_list) {
			if (checkbox_list.hasOwnProperty(i)) {
				checkbox_list[i].checked = false;
			}
        }

//動的なidをつける
// let check = "check"
let check_1 = document.getElementsByClassName("check_1") ;
for (let i = 0; i <= 10; i++) {
    check_1[i].classList.remove('checked_check_1')
}       
    }

function loaded(){
    modal2.style.display = 'none'
}



function form_submit(){
    let twitter = document.getElementById('Twitter_comment');
    let twitter2 = document.getElementById('Twitter');
    var s, url;
	s = twitter.value;
	url = document.location.href;
	
	if (twitter2.checked) {
		if (s.length > 140) {
			//文字数制限
			alert("テキストが140字を超えています");
		} 
        else if(s == "") {
            alert("Twitter用コメントを入力してください");
        }
        else {
			//投稿画面を開く
			url = "http://twitter.com/share?url=" + s;
			window.open(url,"_blank","width=600,height=300");
            modal2.style.display = 'block';
            setTimeout(loaded,5000);
            modal3.style.display = 'block';
            modal.style.display = 'none';
		}
	}
    else{
            modal2.style.display = 'block';
            setTimeout(loaded,5000);
            modal3.style.display = 'block';
            modal.style.display = 'none';
    }

    const formElements = document.forms.contactForm;

    console.log(`学習日：${formElements.day.value}`);

    Array.prototype.forEach.call(formElements.content, function (checkbox) {
        if(checkbox.checked === true){
        console.log('学習コンテンツ：', checkbox.value);
        }
    });
    
    Array.prototype.forEach.call(formElements.lang, function (checkbox) {
        if(checkbox.checked === true){
        console.log('学習言語：', checkbox.value);
        }
    });
    

    console.log(`学習時間：${formElements.time.value}`);
    console.log(`Twitter用コメント：${formElements.comment.value}`);
}


function decide_day(){
    calendar.style.display = 'none';
    modal.style.display = 'block';

}



function calendar_open(){
    calendar.style.display = 'block';
    modal.style.display = 'none';
}

const week = ["日", "月", "火", "水", "木", "金", "土"];
const today = new Date();
// 月末だとずれる可能性があるため、1日固定で取得
var showDate = new Date(today.getFullYear(), today.getMonth(), 1);

// 初期表示
window.onload = function () {
    showProcess(today, calendar);
};
// 前の月表示
function prev(){
    showDate.setMonth(showDate.getMonth() - 1);
    showProcess(showDate);
}

// 次の月表示
function next(){
    showDate.setMonth(showDate.getMonth() + 1);
    showProcess(showDate);
}

// カレンダー表示
function showProcess(date) {
    var year = date.getFullYear();
    var month = date.getMonth();
    document.querySelector('#year_date').innerHTML = year + "年 " + (month + 1) + "月";

    var calendar = createProcess(year, month);
    document.querySelector('#calendar').innerHTML = calendar;
}

// カレンダー作成
function createProcess(year, month) {
    // 曜日
    var calendar = "<table><tr class='dayOfWeek'>";
    for (var i = 0; i < week.length; i++) {
        calendar += "<th>" + week[i] + "</th>";
    }
    calendar += "</tr>";

    var count = 0;
    var startDayOfWeek = new Date(year, month, 1).getDay();
    var endDate = new Date(year, month + 1, 0).getDate();
    var lastMonthEndDate = new Date(year, month, 0).getDate();
    var row = Math.ceil((startDayOfWeek + endDate) / week.length);

    // 1行ずつ設定
    for (var i = 0; i < row; i++) {
        calendar += "<tr>";
        // 1colum単位で設定
        for (var j = 0; j < week.length; j++) {
            if (i == 0 && j < startDayOfWeek) {
                // 1行目で1日まで先月の日付を設定
                calendar += "<td class='disabled'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
            } else if (count >= endDate) {
                // 最終行で最終日以降、翌月の日付を設定
                count++;
                // calendar += "<td class='disabled'>" + (count - endDate) + "</td>";
            } else {
                // 当月の日付を曜日に照らし合わせて設定
                count++;
                if(year == today.getFullYear()
                && month == (today.getMonth())
                && count == today.getDate()){
                    calendar += "<td class='day'>" + count + "</td>";
                } else {
                    calendar += "<td  class='day'>" + count + "</td>";
                }
            }
        }
        calendar += "</tr>";
    }
    return calendar;
}

document.addEventListener("click", function(e) {
    const class_day = document.getElementsByClassName('day');
    const now_date = document.getElementById('year_date');
    const day_box = document.getElementById('day');
    if(e.target.classList.contains("day")) {
        for (let i = 0; i < class_day.length; i++) {
            class_day[i].classList.remove('day_checked');
        }
        day_box.value = now_date.innerHTML + e.target.innerHTML + '日';
        e.target.classList.add('day_checked');
    }
})

function cancel(){
    let class_day = document.getElementsByClassName('day');
    modal.style.display = 'none';
    black_shadow.style.display = 'none';
    let set_date = document.getElementById('day');
    set_date.value = "";
    for (let i = 0; i < class_day.length; i++) {
        class_day[i].classList.remove('day_checked');
    };
    let time = document.getElementById('time');
    time.value = "";
    let twitter = document.getElementById('Twitter_comment');
    twitter.value = "";
    //チェックボックスのリスト
    let checkbox_list = document.querySelectorAll(".check");
		//全て解除
		for (let i in checkbox_list) {
			if (checkbox_list.hasOwnProperty(i)) {
				checkbox_list[i].checked = false;
			}
		}
        
//動的なidをつける
let check_1 = document.getElementsByClassName("check_1") ;
for (let i = 0; i <= 10; i++) {
    check_1[i].classList.remove('checked_check_1')
}       
}


//動的なidをつける
let check_1 = document.getElementsByClassName("check_1") ;
let check = "check";


for (let i = 0; i <= 10; i++) {
let check_box = document.getElementById(`check${i}`);
check_box.addEventListener('change', function() {
    check_1[i].classList.toggle('checked_check_1')
})
}

