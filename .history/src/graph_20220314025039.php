<?php
require("./dbconnect.php");

$sum = $db->prepare('SELECT sum(study_hour) FROM study_data');
$sum->execute();
$hour_sum = $sum->fetch();

$sum1 = $db->prepare("SELECT sum(study_hour) FROM study_data WHERE DATE_FORMAT(study_date, '%Y%m')=DATE_FORMAT(NOW(), '%Y%m')");
$sum1->execute();
$sum_month_sum = $sum1->fetch();

$sum2 = $db->prepare("SELECT sum(study_hour) FROM study_data WHERE DATE_FORMAT(study_date, '%Y%m%D')=DATE_FORMAT(NOW(), '%Y%m%D')");
$sum2->execute();
$sum_day_sum = $sum2->fetch();

$data_time = $db->prepare('SELECT study_hour FROM study_data');
$data_time->execute();
$data_time_list = $data_time->fetchAll();

// $bar_stmt = $db->query(
//     "SELECT 
//         SUM(study_time) 
//     FROM 
//         records 
//     GROUP BY
//         study_date 
//     HAVING
//         DATE_FORMAT(study_date, '%M/%Y') = DATE_FORMAT(now(), '%M/%Y')"
// );
// $bars = $bar_stmt->fetchAll() ?: 0;

?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://www.google.com/jsapi"></script>

<script>
    var today = new Date();
    var month = today.getMonth();
    // 2020年4月の日数
    var d = new Date();
    // Dateの第二引数は0始まり(0, 1, 2...が1月, 2月, 3月...)
    // Dateの第三引数に0を入れると前月の最終日になる。
    var lastDate = new Date(2020, month + 1, 0);
    // 結果：30


    var dataset = [
        ["date", "time"]
    ]

    for (let i = 1; i < lastDate.getDate(); i++) {
        dataset.push([`"` + i + `"`,]);
    }

    // for(let i=1;i<lastDate;i++){
    //     dataset.push([`${i}`,3]);
    // }
    // ["1",3],
    // ["2",4],
    // ["3",5],
    // ["4",3],
    // ["5",0],
    // ["6",0],
    // ["7",4],
    // ["8",2],
    // ["9",2],
    // ["10",8],
    // ["11",8],
    // ["12",2],
    // ["13",2],
    // ["14",1],
    // ["15",7],
    // ["16",4],
    // ["17",4],
    // ["18",3],
    // ["19",3],
    // ["20",3],
    // ["21",2],
    // ["22",2],
    // ["23",6],
    // ["24",2],
    // ["25",2],
    // ["26",1],
    // ["27",1],
    // ["28",1],
    // ["29",7],
    // ["30",8],


    const matchMedia3 = window.matchMedia('(max-width:600px)');
    const matchMedia = window.matchMedia('(max-width:424px)');
    const matchMedia2 = window.matchMedia('(max-width:350px)');


    if (matchMedia2.matches) {
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.load("visualization", "1", {
            packages: ["corechart"]
        });
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
                colors: ['#0345EC', '#0F71BD', '#20BDDE', '#3CCEFE', '#B29EF3', '#6D46EC', '#4A17EF', '#3105C0'],
                chartArea: {
                    left: 10,
                    top: 0,
                    width: '85%',
                    height: '110%'
                },
                width: 120,
                height: 120,
                pieSliceBorderColor: 'none',
                legend: {
                    position: 'none'
                },

            };

            var options2 = {
                pieHole: 0.4,
                colors: ['#0345EC', '#0F71BD', '#20BDDE', '#3CCEFE', '#B29EF3', '#6D46EC', '#4A17EF', '#3105C0'],
                chartArea: {
                    left: 10,
                    top: 0,
                    width: '85%',
                    height: '110%'
                },
                width: 120,
                height: 120,
                pieSliceBorderColor: 'none',
                legend: {
                    position: 'none'
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);

            var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
            chart2.draw(data2, options2);

            var data3 = google.visualization.arrayToDataTable(dataset);
            var options3 = {
                hAxis: {
                    textStyle: {
                        color: '#C0D4E3',
                    },
                    ticks: [2, 4, 6, 8, 10, 15, 20],

                    showTextEvery: 2,
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
                    textStyle: {
                        color: '#C0D4E3',
                        fontSize: 6
                    },
                    gridlines: {
                        color: "transparent"
                    },
                    baselineColor: 'transparent',
                    showTextEvery: 2,
                },
                bar: {
                    groupWidth: "55%"
                },
                chartArea: {
                    width: '85%',
                    height: '73%'
                },
                width: 270,
                height: 130,
                legend: {
                    position: 'none'
                },

            };
            var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart3.draw(data3, options3);
        }
    } else if (matchMedia.matches) {
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.load("visualization", "1", {
            packages: ["corechart"]
        });
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
                colors: ['#0345EC', '#0F71BD', '#20BDDE', '#3CCEFE', '#B29EF3', '#6D46EC', '#4A17EF', '#3105C0'],
                chartArea: {
                    left: 10,
                    top: 0,
                    width: '85%',
                    height: '110%'
                },
                width: 145,
                height: 145,
                pieSliceBorderColor: 'none',
                legend: {
                    position: 'none'
                },

            };

            var options2 = {
                pieHole: 0.4,
                colors: ['#0345EC', '#0F71BD', '#20BDDE', '#3CCEFE', '#B29EF3', '#6D46EC', '#4A17EF', '#3105C0'],
                chartArea: {
                    left: 10,
                    top: 0,
                    width: '85%',
                    height: '110%'
                },
                width: 145,
                height: 145,
                pieSliceBorderColor: 'none',
                legend: {
                    position: 'none'
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);

            var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
            chart2.draw(data2, options2);

            var data3 = google.visualization.arrayToDataTable(dataset);
            var options3 = {
                hAxis: {
                    textStyle: {
                        color: '#C0D4E3',
                    },
                    ticks: [2, 4, 6, 8, 10, 15, 20],

                    showTextEvery: 2,
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
                    textStyle: {
                        color: '#C0D4E3',
                        fontSize: 6
                    },
                    gridlines: {
                        color: "transparent"
                    },
                    baselineColor: 'transparent',
                    showTextEvery: 2,
                },
                bar: {
                    groupWidth: "55%"
                },
                chartArea: {
                    width: '85%',
                    height: '73%'
                },
                height: 340,
                width: 320,
                height: 150,
                legend: {
                    position: 'none'
                },

            };
            var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart3.draw(data3, options3);
        }
    } else if (matchMedia3.matches) {
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.load("visualization", "1", {
            packages: ["corechart"]
        });
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
                colors: ['#0345EC', '#0F71BD', '#20BDDE', '#3CCEFE', '#B29EF3', '#6D46EC', '#4A17EF', '#3105C0'],
                chartArea: {
                    left: 10,
                    top: 0,
                    width: '85%',
                    height: '110%'
                },
                width: 170,
                height: 170,
                pieSliceBorderColor: 'none',
                legend: {
                    position: 'none'
                },

            };

            var options2 = {
                pieHole: 0.4,
                colors: ['#0345EC', '#0F71BD', '#20BDDE', '#3CCEFE', '#B29EF3', '#6D46EC', '#4A17EF', '#3105C0'],
                chartArea: {
                    left: 10,
                    top: 0,
                    width: '85%',
                    height: '110%'
                },
                width: 170,
                height: 170,
                pieSliceBorderColor: 'none',
                legend: {
                    position: 'none'
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);

            var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
            chart2.draw(data2, options2);

            var data3 = google.visualization.arrayToDataTable(dataset);
            var options3 = {
                hAxis: {
                    textStyle: {
                        color: '#C0D4E3',
                    },
                    ticks: [2, 4, 6, 8, 10, 15, 20],

                    showTextEvery: 2,
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
                    textStyle: {
                        color: '#C0D4E3',
                        fontSize: 13
                    },
                    gridlines: {
                        color: "transparent"
                    },
                    baselineColor: 'transparent',
                    showTextEvery: 2,
                },
                bar: {
                    groupWidth: "55%"
                },
                chartArea: {
                    width: '90%',
                    height: '80%'
                },
                width: 365,
                height: 170,
                legend: {
                    position: 'none'
                },

            };
            var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart3.draw(data3, options3);
        }
    } else {
        // 651px以上で行う処理
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.load("visualization", "1", {
            packages: ["corechart"]
        });
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
                colors: ['#0345EC', '#0F71BD', '#20BDDE', '#3CCEFE', '#B29EF3', '#6D46EC', '#4A17EF', '#3105C0'],
                chartArea: {
                    left: 19,
                    top: 0,
                    width: '85%',
                    height: '110%'
                },
                width: 275,
                height: 250,
                pieSliceBorderColor: 'none',
                legend: {
                    position: 'none'
                },

            };

            var options2 = {
                pieHole: 0.4,
                colors: ['#0345EC', '#0F71BD', '#20BDDE', '#3CCEFE', '#B29EF3', '#6D46EC', '#4A17EF', '#3105C0'],
                chartArea: {
                    left: 19,
                    top: 0,
                    width: '85%',
                    height: '110%'
                },
                width: 275,
                height: 250,
                pieSliceBorderColor: 'none',
                legend: {
                    position: 'none'
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);

            var chart2 = new google.visualization.PieChart(document.getElementById('donutchart2'));
            chart2.draw(data2, options2);

            var data3 = google.visualization.arrayToDataTable(dataset);
            var options3 = {
                hAxis: {
                    textStyle: {
                        color: '#C0D4E3',
                    },
                    ticks: [2, 4, 6, 8, 10, 15, 20],

                    showTextEvery: 2,
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
                    textStyle: {
                        color: '#C0D4E3',
                        fontSize: 13
                    },
                    gridlines: {
                        color: "transparent"
                    },
                    baselineColor: 'transparent',
                    showTextEvery: 2,
                },
                bar: {
                    groupWidth: "55%"
                },
                chartArea: {
                    width: '90%',
                    height: '80%'
                },
                height: 340,
                width: 560,
                height: 330,
                legend: {
                    position: 'none'
                },

            };
            var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart3.draw(data3, options3);
        }
    }
</script>