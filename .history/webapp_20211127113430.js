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



// formElements.addEventListener( 'click', e => {
//     e.preventDefault();
// })

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
// let check = "check"
let check_1 = document.getElementsByClassName("check_1") ;
for (let i = 0; i <= 10; i++) {
    check_1[i].classList.remove('checked_check_1')
}       
}


//動的なidをつける
// let check = "check"
let check_1 = document.getElementsByClassName("check_1") ;
let check = "check";
// let check = document.getElementsByClassName("check") ;


for (let i = 0; i <= 10; i++) {
let check_box = document.getElementById(`check${i}`);
check_box.addEventListener('change', function() {
    check_1[i].classList.toggle('checked_check_1')
})
}







    

// google.setOnLoadCallback(drawChart);



var dataset = [
["date","time"],
["1",3],
["2",4],
["3",5],
["4",3],
["5",0],
["6",0],
["7",4],
["8",2],
["9",2],
["10",8],
["11",8],
["12",2],
["13",2],
["14",1],
["15",7],
["16",4],
["17",4],
["18",3],
["19",3],
["20",3],
["21",2],
["22",2],
["23",6],
["24",2],
["25",2],
["26",1],
["27",1],
["28",1],
["29",7],
["30",8],
]

    const matchMedia3 = window.matchMedia('(max-width:600px)');
    const matchMedia = window.matchMedia('(max-width:424px)');
    const matchMedia2 = window.matchMedia('(max-width:350px)');


    if (matchMedia2.matches){
        google.charts.load("current", {packages:["corechart"]});
        google.load("visualization", "1", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['HTML', 30],
                ['CSS', 20],
                ['JavaScript', 10],
                ['PHP', 5],
                ['Laravel', 5],
                ['SQL', 20],
                ['SHELL', 20],
                ['その他', 10]
                ]);
        
                var data2 = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['N予備校', 40],
                    ['ドットインストール', 20],
                    ['POSSE課題', 40],
                ]);
        
                var options = {
                pieHole: 0.4,
                colors: ['#0345EC','#0F71BD','#20BDDE','#3CCEFE','#B29EF3','#6D46EC','#4A17EF','#3105C0'],
                chartArea:{left:10,top:0,width:'85%',height:'110%'},
                width: 120,
                height: 120,
                pieSliceBorderColor: 'none',
                legend: {position: 'none'},
                
                };
        
                var options2 = {
                    pieHole: 0.4,
                    colors: ['#0345EC','#0F71BD','#20BDDE','#3CCEFE','#B29EF3','#6D46EC','#4A17EF','#3105C0'],
                    chartArea:{left:10,top:0,width:'85%',height:'110%'},
                    width: 120,
                    height: 120,
                    pieSliceBorderColor: 'none',
                    legend: {position: 'none'}
                };
        
                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
        
                var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
                chart2.draw(data2, options2);
        
                var data3 = google.visualization.arrayToDataTable(dataset);
                var options3 = {
                hAxis: {
                    textStyle:{color: '#C0D4E3',},
                    ticks: [2,4,6,8,10,15,20],
        
                    showTextEvery:2,
                    // 目盛りを自分で設定
                    // ticks:{
                    //     callback: function(value) {return ((value % 10) == 0)? value : ''},
                    //     min: 0,
                    //     max: 30,
                    //     stepSize: 1
                    // }
        
                },
                vAxis: {
                    format: `#h`,
                    textStyle:{color: '#C0D4E3',fontSize: 6},
                    gridlines: {color:"transparent"},
                    baselineColor: 'transparent',
                    showTextEvery: 2,
                },
                bar: {groupWidth: "55%"},
                chartArea:{width:'85%',height:'73%'},
                width: 270,
                height:130,
                legend: {position: 'none'},
                
                };
                var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart3.draw(data3, options3);
            }
    }
    else if (matchMedia.matches) {
    google.charts.load("current", {packages:["corechart"]});
        google.load("visualization", "1", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['HTML', 30],
                ['CSS', 20],
                ['JavaScript', 10],
                ['PHP', 5],
                ['Laravel', 5],
                ['SQL', 20],
                ['SHELL', 20],
                ['その他', 10]
                ]);
        
                var data2 = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['N予備校', 40],
                    ['ドットインストール', 20],
                    ['POSSE課題', 40],
                ]);
        
                var options = {
                pieHole: 0.4,
                colors: ['#0345EC','#0F71BD','#20BDDE','#3CCEFE','#B29EF3','#6D46EC','#4A17EF','#3105C0'],
                chartArea:{left:10,top:0,width:'85%',height:'110%'},
                width: 145,
                height: 145,
                pieSliceBorderColor: 'none',
                legend: {position: 'none'},
                
                };
        
                var options2 = {
                    pieHole: 0.4,
                    colors: ['#0345EC','#0F71BD','#20BDDE','#3CCEFE','#B29EF3','#6D46EC','#4A17EF','#3105C0'],
                    chartArea:{left:10,top:0,width:'85%',height:'110%'},
                    width: 145,
                    height: 145,
                    pieSliceBorderColor: 'none',
                    legend: {position: 'none'}
                };
        
                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
        
                var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
                chart2.draw(data2, options2);
        
                var data3 = google.visualization.arrayToDataTable(dataset);
                var options3 = {
                hAxis: {
                    textStyle:{color: '#C0D4E3',},
                    ticks: [2,4,6,8,10,15,20],
        
                    showTextEvery:2,
                    // 目盛りを自分で設定
                    // ticks:{
                    //     callback: function(value) {return ((value % 10) == 0)? value : ''},
                    //     min: 0,
                    //     max: 30,
                    //     stepSize: 1
                    // }
        
                },
                vAxis: {
                    format: `#h`,
                    textStyle:{color: '#C0D4E3',fontSize: 6},
                    gridlines: {color:"transparent"},
                    baselineColor: 'transparent',
                    showTextEvery: 2,
                },
                bar: {groupWidth: "55%"},
                chartArea:{width:'85%',height:'73%'},
                height: 340,
                width: 320,
                height:150,
                legend: {position: 'none'},
                
                };
                var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart3.draw(data3, options3);
            }
} else if(matchMedia3.matches){
    google.charts.load("current", {packages:["corechart"]});
        google.load("visualization", "1", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['HTML', 30],
                ['CSS', 20],
                ['JavaScript', 10],
                ['PHP', 5],
                ['Laravel', 5],
                ['SQL', 20],
                ['SHELL', 20],
                ['その他', 10]
                ]);
        
                var data2 = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['N予備校', 40],
                    ['ドットインストール', 20],
                    ['POSSE課題', 40],
                ]);
        
                var options = {
                pieHole: 0.4,
                colors: ['#0345EC','#0F71BD','#20BDDE','#3CCEFE','#B29EF3','#6D46EC','#4A17EF','#3105C0'],
                chartArea:{left:10,top:0,width:'85%',height:'110%'},
                width: 170,
                height: 170,
                pieSliceBorderColor: 'none',
                legend: {position: 'none'},
                
                };
        
                var options2 = {
                    pieHole: 0.4,
                    colors: ['#0345EC','#0F71BD','#20BDDE','#3CCEFE','#B29EF3','#6D46EC','#4A17EF','#3105C0'],
                    chartArea:{left:10,top:0,width:'85%',height:'110%'},
                    width: 170,
                    height: 170,
                    pieSliceBorderColor: 'none',
                    legend: {position: 'none'}
                };
        
                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
        
                var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
                chart2.draw(data2, options2);
        
                var data3 = google.visualization.arrayToDataTable(dataset);
                var options3 = {
                hAxis: {
                    textStyle:{color: '#C0D4E3',},
                    ticks: [2,4,6,8,10,15,20],
        
                    showTextEvery:2,
                    // 目盛りを自分で設定
                    // ticks:{
                    //     callback: function(value) {return ((value % 10) == 0)? value : ''},
                    //     min: 0,
                    //     max: 30,
                    //     stepSize: 1
                    // }
        
                },
                vAxis: {
                    format: `#h`,
                    textStyle:{color: '#C0D4E3',fontSize: 13},
                    gridlines: {color:"transparent"},
                    baselineColor: 'transparent',
                    showTextEvery: 2,
                },
                bar: {groupWidth: "55%"},
                chartArea:{width:'90%',height:'80%'},
                width: 365,
                height:170,
                legend: {position: 'none'},
                
                };
                var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart3.draw(data3, options3);
            }
}
    else {
  // 651px以上で行う処理
    google.charts.load("current", {packages:["corechart"]});
        google.load("visualization", "1", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['HTML', 30],
                ['CSS', 20],
                ['JavaScript', 10],
                ['PHP', 5],
                ['Laravel', 5],
                ['SQL', 20],
                ['SHELL', 20],
                ['その他', 10]
                ]);
        
                var data2 = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['N予備校', 40],
                    ['ドットインストール', 20],
                    ['POSSE課題', 40],
                ]);
        
                var options = {
                pieHole: 0.4,
                colors: ['#0345EC','#0F71BD','#20BDDE','#3CCEFE','#B29EF3','#6D46EC','#4A17EF','#3105C0'],
                chartArea:{left:19,top:0,width:'85%',height:'110%'},
                width: 275,
                height: 250,
                pieSliceBorderColor: 'none',
                legend: {position: 'none'},
                
                };
        
                var options2 = {
                    pieHole: 0.4,
                    colors: ['#0345EC','#0F71BD','#20BDDE','#3CCEFE','#B29EF3','#6D46EC','#4A17EF','#3105C0'],
                    chartArea:{left:19,top:0,width:'85%',height:'110%'},
                    width: 275,
                    height: 250,
                    pieSliceBorderColor: 'none',
                    legend: {position: 'none'}
                };
        
                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
        
                var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
                chart2.draw(data2, options2);
        
                var data3 = google.visualization.arrayToDataTable(dataset);
                var options3 = {
                hAxis: {
                    textStyle:{color: '#C0D4E3',},
                    ticks: [2,4,6,8,10,15,20],
        
                    showTextEvery:2,
                    // 目盛りを自分で設定
                    // ticks:{
                    //     callback: function(value) {return ((value % 10) == 0)? value : ''},
                    //     min: 0,
                    //     max: 30,
                    //     stepSize: 1
                    // }
        
                },
                vAxis: {
                    format: `#h`,
                    textStyle:{color: '#C0D4E3',fontSize: 13},
                    gridlines: {color:"transparent"},
                    baselineColor: 'transparent',
                    showTextEvery: 2,
                },
                bar: {groupWidth: "55%"},
                chartArea:{width:'90%',height:'80%'},
                height: 340,
                width: 560,
                height:330,
                legend: {position: 'none'},
                
                };
                var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart3.draw(data3, options3);
            }
}



// window.onresize = function() {
//     drawChart();
// }