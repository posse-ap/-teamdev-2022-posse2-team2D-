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

//棒グラフデータ
$bar_stmt = $db->query(
    "SELECT
        study_date,
        SUM(study_hour) as sum_study_time
    FROM 
        study_data 
    GROUP BY
        study_date 
    HAVING
        DATE_FORMAT(study_date, '%M/%Y') = DATE_FORMAT(now(), '%M/%Y')"
);
$bars = $bar_stmt->fetchAll() ?: 0;

// 学習言語円グラフデータ
$language_stmt = $db->query(
    "SELECT 
        study_date, study_languages.study_language, SUM(study_data.study_hour) as sum_study_time, study_languages.color
    FROM 
        study_data
    JOIN 
        study_languages ON study_data.study_language_id = study_languages.id 
    GROUP BY
        study_languages.study_language"
    HAVING
        DATE_FORMAT(study_date, '%M/%Y') = DATE_FORMAT(now(), '%M/%Y')
);
$languages = $language_stmt->fetchAll() ?: 0;

//学習言語円グラフデータ、 % を計算する用
// $percentage_stmt = $db->query(
//     "SELECT 
//         languages.language, SUM(records.study_time), languages.colour
//     FROM 
//         records
//     JOIN 
//         languages ON records.language_id = languages.id
//     GROUP BY
//         languages.language, languages.colour"
// );
// $percentages = $percentage_stmt->fetchAll() ?: 0;



//学習コンテンツ円グラフデータ
// $content_stmt = $db->query(
//     "SELECT
//       contents.content, SUM(records.study_time)
//     FROM 
//       records 
//     JOIN 
//       contents ON records.content_id = contents.id 
//     GROUP BY 
//       contents.content"
// );
// $contents = $content_stmt->fetchAll() ?: 0;


?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://www.google.com/jsapi"></script>


<script>

    var dataset = [
        ["date", "time"],
        <?php
        foreach ($bars as $bar) {
        ?>['<?= substr($bar["study_date"], 8, 2) ?>', <?= $bar["sum_study_time"] ?>],
        <?php
        }
        ?>
    ]

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
                    ticks: {
                        autoSkip: true,
                        maxTicksLimit: 20 //値の最大表示数
                    }
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