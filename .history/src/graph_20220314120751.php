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
        SUM(study_hour) 
    FROM 
        study_data 
    GROUP BY
        study_date 
    HAVING
        DATE_FORMAT(study_date, '%M/%Y') = DATE_FORMAT(now(), '%M/%Y')"
);
$bars = $bar_stmt->fetchAll() ?: 0;

//学習言語円グラフデータ
$language_stmt = $db->query(
    "SELECT 
        study_languages.study_language, SUM(study_data.study_time), study_languages.colour
    FROM 
        study_data
    JOIN 
        study_languages ON study_data.study_language_id = study_languages.id 
    GROUP BY
        study_languages.study_language, study_languages.colour"
);
$languages = $language_stmt->fetchAll() ?: 0;

//学習言語円グラフデータ、 % を計算する用
$percentage_stmt = $db->query(
    "SELECT 
        study_languages.study_language, SUM(study_data.study_hour), study_languages.colour
    FROM 
        study_data
    JOIN 
        study_languages ON study_data.study_language_id = study_languages.id
    GROUP BY
        study_languages.study_language, study_languages.colour"
);
$percentages = $percentage_stmt->fetchAll() ?: 0;



//学習コンテンツ円グラフデータ
$content_stmt = $db->query(
    "SELECT
        contents.content, SUM(records.study_time)
    FROM 
        records 
    JOIN 
        contents ON records.content_id = contents.id 
    GROUP BY 
        contents.content"
);
$contents = $content_stmt->fetchAll() ?: 0;


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

<!-- 
<script>
    // var today = new Date();
    // var month = today.getMonth();
    // // 2020年4月の日数
    // var d = new Date();
    // // Dateの第二引数は0始まり(0, 1, 2...が1月, 2月, 3月...)
    // // Dateの第三引数に0を入れると前月の最終日になる。
    // var lastDate = new Date(2020, month + 1, 0);
    // // 結果：30

    var dataset = [
        ["date", "time"]
    ]

    // for (let i = 1; i < lastDate.getDate(); i++) {
    //     dataset.push([`"` + i + `"`,
    //     <?php
            //         $data_time = $db->prepare('SELECT study_hour FROM study_data WHERE ');
            //     
            ?>
    // ]);
    // }



    for (let i = 1; i < <?php echo date('t'); ?>; i++) {
        dataset.push([`${i}`, 3]);
    }
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
</script>-->

<script>
    // 学習時間棒グラフ

    const column = document.getElementById('column').getContext('2d');

    var gradient = column.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(54, 206, 254, 1)');
    gradient.addColorStop(1, 'rgba(17,115,189, 1)');

    const myColumnChart = new Chart(column, {
        // label: 'none',

        type: 'bar',
        data: {
            labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30],
            datasets: [{
                // data: [4, 4, 5, 3, 0, 0, 4, 2, 2, 8, 8, 2, 2, 1, 7, 4, 4, 3, 3, 3, 2, 2, 6, 2, 2, 1, 1, 1, 7, 8],
                data: [
                    <?php
                    foreach ($bars as $bar) {
                        echo $bar['SUM(study_time)'] . ",";
                    }
                    ?>
                ],
                backgroundColor: gradient,
                borderRadius: 50,
                borderSkipped: false,
            }],
            // barPercentage: 0.3
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        // min: 2,
                        // maxTicksLimit: 15,
                        color: '#bdd1e1',
                        autoSkip: false,
                        min: 1,
                        max: 30,
                        padding: 0,
                        // stepSize: 2,
                        callback: function(val, index) {
                            // Hide the label of every 2nd dataset
                            return index % 2 === 1 ? this.getLabelForValue(val) : '';
                        },
                        maxRotation: 0,
                        minRotation: 0
                    },
                    // barPercentage: 0.3
                },
                y: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    max: 8,
                    min: 0,
                    ticks: {
                        stepSize: 2,
                        callback: function(value) {
                            return value + 'h';
                        },
                        color: '#bdd1e1',
                    },
                },
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        },

    });

    // STUDY LANGUAGE

    const donut1 = document.getElementById('donut_lang').getContext('2d');

    const myFirstDonutChart = new Chart(donut1, {
        type: 'doughnut',
        data: {
            labels: ['CSS', 'HTML', 'Javascript', 'Laravel', 'PHP', 'SHELL', 'SQL', 'その他'],
            datasets: [{
                // data: [30, 20, 20, 20, 10, 10, 5, 5],
                data: [
                    <?php
                    foreach ($languages as $language) {
                        echo $language['SUM(records.study_time)'] . ",";
                    }
                    ?>
                ],
                backgroundColor: [
                    "#0f70bd",
                    "#0445ec",
                    "#b29ef3",
                    "#3005c0",
                    "#4a17ef",
                    "#3ccefe",
                    "#20bdde",
                    "#6c46eb",
                ],
                // backgroundColor: [
                //   <?php
                        //   foreach ($languages as $language) {
                        //     echo "\"" . $language['languages.colour)'] . "\",";
                        //   }
                        //   
                        ?>
                // ],
                borderColor: 'transparent'
            }],
        },
        plugins: [ChartDataLabels],
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    color: '#fff',
                    // formatter: function(value) {
                    //   return value + '%';
                    // }
                    formatter: (value, ctx) => {
                        let sum = 0;
                        let dataArr = ctx.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += data;
                        });
                        let percentage = (value * 100 / sum).toFixed(0) + "%";
                        return percentage;
                    },
                }
            },
        },

    });

    const donut2 = document.getElementById('donut_content').getContext('2d');

    const mySecondDonutChart = new Chart(donut2, {
        type: 'doughnut',
        data: {
            labels: ['N予備校', '課題', 'ドットインストール'],
            datasets: [{
                // data: [40, 40, 20],
                data: [
                    <?php
                    foreach ($contents as $content) {
                        echo $content['SUM(records.study_time)'] . ",";
                    }
                    ?>
                ],
                backgroundColor: [
                    '#0445ec',
                    '#0f70bd',
                    '#20bdde',
                ],
                borderColor: 'transparent'
            }],
        },
        plugins: [ChartDataLabels],
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    color: '#fff',
                    // formatter: function(value) {
                    //   return value + '%';
                    // }
                    formatter: (value, ctx) => {
                        let sum = 0;
                        let dataArr = ctx.chart.data.datasets[0].data;
                        dataArr.map(data => {
                            sum += data;
                        });
                        let percentage = (value * 100 / sum).toFixed(0) + "%";
                        return percentage;
                    },
                }
            },
        },

    });
</script>