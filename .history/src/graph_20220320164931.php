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
        study_languages.study_language, SUM(study_data.study_hour) as sum_study_time, study_languages.color
    FROM 
        study_data
    JOIN 
        study_languages ON study_data.study_language_id = study_languages.id
    WHERE
        DATE_FORMAT(study_date, '%M/%Y') = DATE_FORMAT(now(), '%M/%Y')
    GROUP BY
        study_languages.study_language, study_languages.color"
);
$languages = $language_stmt->fetchAll() ?: 0;

// 学習コンテンツ円グラフデータ
$content_stmt = $db->query(
    "SELECT
        study_contents.study_content, SUM(study_data.study_hour) as sum_study_time, study_contents.color
    FROM 
        study_data
    JOIN 
        study_contents ON study_data.study_content_id = study_contents.id
    WHERE
        DATE_FORMAT(study_date, '%M/%Y') = DATE_FORMAT(now(), '%M/%Y')
    GROUP BY 
        study_contents.study_content, study_contents.color"
);
$contents = $content_stmt->fetchAll() ?: 0;


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

    if (window.matchMedia( "(min-width: 440px)" ).matches) {
  /* ビューポートの幅が 400 ピクセル以上の場合のコードをここに */
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
                <?php
                foreach ($languages as $language) {
                ?>['<?= $language["study_language"] ?>', <?= $language["sum_study_time"] ?>],
                <?php
                }
                ?>
            ]);

            var data2 = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                <?php
                foreach ($contents as $content) {
                ?>['<?= $content["study_content"] ?>', <?= $content["sum_study_time"] ?>],
                <?php
                }
                ?>
            ]);

            var options = {
                responsive: true,
                maintainAspectRatio: false,
                pieHole: 0.4,
                colors: [
                    <?php
                    foreach ($languages as $language) {
                    ?> '<?= $language["color"] ?>',
                    <?php
                    }
                    ?>
                ],
                chartArea: {
                    left: 3,
                    right: 3,
                    top: 0,
                    width: '90%',
                    height: '90%'
                },
                pieSliceBorderColor: 'none',
                legend: {
                    position: 'none'
                },
            };
            var options2 = {
                responsive: true,
                maintainAspectRatio: false,
                pieHole: 0.4,
                colors: [
                    <?php
                    foreach ($contents as $content) {
                    ?> '<?= $content["color"] ?>',
                    <?php
                    }
                    ?>
                ],
                chartArea: {
                    left: 3,
                    right: 3,
                    top: 0,
                    width: '90%',
                    height: '90%'
                },
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
                responsive: true,
                maintainAspectRatio: false,
                hAxis: {
                    textStyle: {
                        color: '#C0D4E3',
                    },
                    ticks: [2, 4, 6, 8, 10, 15, 20],
                    showTextEvery: 2,
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
                    height: '90%'
                },
                legend: {
                    position: 'none'
                },
            };
            var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart3.draw(data3, options3);
    }
} else {
  /* ビューポートの幅は 400 ピクセル未満の場合のコードをここに */
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
                ['css',10]
                ['js',]
                <?php
                foreach ($languages as $language) {
                ?>['<?= $language["study_language"] ?>', <?= $language["sum_study_time"] ?>],
                <?php
                }
                ?>
            ]);

            var data2 = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                <?php
                foreach ($contents as $content) {
                ?>['<?= $content["study_content"] ?>', <?= $content["sum_study_time"] ?>],
                <?php
                }
                ?>
            ]);

            var options = {
                responsive: true,
                maintainAspectRatio: false,
                pieHole: 0.4,
                colors: [
                    <?php
                    foreach ($languages as $language) {
                    ?> '<?= $language["color"] ?>',
                    <?php
                    }
                    ?>
                ],
                chartArea: {
                    left: 3,
                    right: 3,
                    top: 0,
                    width: '90%',
                    height: '90%'
                },
                pieSliceBorderColor: 'none',
                legend: {
                    position: 'none'
                },
            };
            var options2 = {
                responsive: true,
                maintainAspectRatio: false,
                pieHole: 0.4,
                colors: [
                    <?php
                    foreach ($contents as $content) {
                    ?> '<?= $content["color"] ?>',
                    <?php
                    }
                    ?>
                ],
                chartArea: {
                    left: 3,
                    right: 3,
                    top: 0,
                    width: '90%',
                    height: '90%'
                },
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
                responsive: true,
                maintainAspectRatio: false,
                hAxis: {
                    textStyle: {
                        color: '#C0D4E3',
                    },
                    ticks: [2, 4, 6, 8, 10, 15, 20],
                    showTextEvery: 2,
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
                    height: '90%'
                },
                legend: {
                    position: 'none'
                },
                height: 150,
            };
            var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart3.draw(data3, options3);
    }
}
</script>