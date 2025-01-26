<?php

use Maantje\Charts\Annotations\XAxis\XAxisLineAnnotation;
use Maantje\Charts\Annotations\YAxis\YAxisLineAnnotation;
use Maantje\Charts\Annotations\YAxis\YAxisRangeAnnotation;
use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\BarGroup;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Bar\Segment;
use Maantje\Charts\Bar\StackedBar;
use Maantje\Charts\Chart;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Pie\PieChart;
use Maantje\Charts\Pie\Slice;
use Maantje\Charts\XAxis;
use Maantje\Charts\YAxis;
use Mpdf\Mpdf;

require_once __DIR__.'/../../vendor/autoload.php';

$mpdf = new Mpdf([
    'format' => 'A4',
    'margin_top' => 30,
    'margin_bottom' => 20,
    'margin_left' => 15,
    'margin_right' => 15,
]);

$red = '#E74C3C';
$green = '#27AE60';
$blue = '#2980B9';
$yellow = '#F39C12';

$lineChart = new Chart(
    width: 770,
    height: 350,
    series: [
        new Lines(
            lines: [
                new Line(
                    points: [
                        [0, 15],
                        [50, 25],
                        [100, 20],
                        [150, 45],
                        [200, 35],
                        [250, 65],
                        [300, 55],
                        [350, 85],
                        [400, 75],
                        [450, 110],
                    ],
                    color: $red,
                ),
                new Line(
                    points: [
                        [0, 10],
                        [50, 30],
                        [100, 50],
                        [150, 40],
                        [200, 70],
                        [250, 60],
                        [300, 80],
                        [350, 100],
                        [400, 90],
                        [450, 120],
                    ],
                    color: $green,
                ),
                new Line(
                    points: [
                        [0, 5],
                        [50, 15],
                        [100, 10],
                        [150, 35],
                        [200, 25],
                        [250, 55],
                        [300, 45],
                        [350, 75],
                        [400, 65],
                        [450, 95],
                    ],
                    color: $blue,
                ),
                new Line(
                    points: [
                        [0, 20],
                        [50, 35],
                        [100, 30],
                        [150, 50],
                        [200, 40],
                        [250, 70],
                        [300, 60],
                        [350, 90],
                        [400, 80],
                        [450, 115],
                    ],
                    color: $yellow,
                ),
            ]
        ),
    ],
);

$curvedLineChart = new Chart(
    width: 770,
    height: 350,
    series: [
        new Lines(
            lines: [
                new Line(
                    points: [
                        [0, 12],
                        [50, 22],
                        [100, 18],
                        [150, 40],
                        [200, 32],
                        [250, 58],
                        [300, 52],
                        [350, 78],
                        [400, 68],
                        [450, 105],
                    ],
                    color: $red,
                    curve: 5,
                ),
                new Line(
                    points: [
                        [0, 8],
                        [50, 25],
                        [100, 45],
                        [150, 35],
                        [200, 62],
                        [250, 55],
                        [300, 73],
                        [350, 95],
                        [400, 85],
                        [450, 115],
                    ],
                    color: $green,
                    curve: 5,
                ),
                new Line(
                    points: [
                        [0, 6],
                        [50, 12],
                        [100, 15],
                        [150, 30],
                        [200, 20],
                        [250, 50],
                        [300, 40],
                        [350, 70],
                        [400, 60],
                        [450, 88],
                    ],
                    color: $blue,
                    curve: 5,
                ),
                new Line(
                    points: [
                        [0, 18],
                        [50, 32],
                        [100, 28],
                        [150, 48],
                        [200, 38],
                        [250, 68],
                        [300, 55],
                        [350, 85],
                        [400, 75],
                        [450, 112],
                    ],
                    color: $yellow,
                    curve: 5,
                ),
            ]
        ),
    ],
);

$stepLineChart = new Chart(
    width: 770,
    height: 350,
    series: [
        new Lines(
            lines: [
                new Line(
                    points: [
                        [0, 10],
                        [50, 10],
                        [50, 20],
                        [100, 20],
                        [100, 30],
                        [150, 30],
                        [150, 40],
                        [200, 40],
                        [200, 50],
                        [250, 50],
                    ],
                    color: $red,
                    stepLine: true,
                ),
                new Line(
                    points: [
                        [0, 15],
                        [50, 15],
                        [50, 25],
                        [100, 25],
                        [100, 35],
                        [150, 35],
                        [150, 45],
                        [200, 45],
                        [200, 55],
                        [250, 55],
                    ],
                    color: $green,
                    stepLine: true,
                ),
                new Line(
                    points: [
                        [0, 5],
                        [50, 5],
                        [50, 15],
                        [100, 15],
                        [100, 25],
                        [150, 25],
                        [150, 35],
                        [200, 35],
                        [200, 45],
                        [250, 45],
                    ],
                    color: $blue,
                    stepLine: true,
                ),
                new Line(
                    points: [
                        [0, 20],
                        [50, 20],
                        [50, 30],
                        [100, 30],
                        [100, 40],
                        [150, 40],
                        [150, 50],
                        [200, 50],
                        [200, 60],
                        [250, 60],
                    ],
                    color: $yellow,
                    stepLine: true,
                ),
            ]
        ),
    ],
);

$barChart = new Chart(
    width: 770,
    height: 350,
    series: [
        new Bars(
            bars: [
                new Bar(
                    name: 'Category A',
                    value: 120000,
                    color: $red,
                ),
                new Bar(
                    name: 'Category B',
                    value: 180000,
                    color: $green,
                ),
                new Bar(
                    name: 'Category C',
                    value: 240000,
                    color: $blue,
                ),
                new Bar(
                    name: 'Category D',
                    value: 300000,
                    color: $yellow,
                ),
            ],
        ),
    ],
);

$stackedBarChart = new Chart(
    width: 770,
    height: 350,
    series: [
        new Bars(
            bars: [
                new StackedBar(
                    name: 'January',
                    segments: [
                        new Segment(
                            value: 30,
                            color: $red,
                        ),
                        new Segment(
                            value: 20,
                            color: $green,
                        ),
                        new Segment(
                            value: 10,
                            color: $blue,
                        ),
                        new Segment(
                            value: 10,
                            color: $yellow,
                        ),
                    ],
                ),
                new StackedBar(
                    name: 'February',
                    segments: [
                        new Segment(
                            value: 35,
                            color: $red,
                        ),
                        new Segment(
                            value: 15,
                            color: $green,
                        ),
                        new Segment(
                            value: 10,
                            color: $blue,
                        ),
                        new Segment(
                            value: 10,
                            color: $yellow,
                        ),
                    ],
                ),
                new StackedBar(
                    name: 'March',
                    segments: [
                        new Segment(
                            value: 30,
                            color: $red,
                        ),
                        new Segment(
                            value: 20,
                            color: $green,
                        ),
                        new Segment(
                            value: 20,
                            color: $blue,
                        ),
                        new Segment(
                            value: 10,
                            color: $yellow,
                        ),
                    ],
                ),
                new StackedBar(
                    name: 'April',
                    segments: [
                        new Segment(
                            value: 25,
                            color: $red,
                        ),
                        new Segment(
                            value: 30,
                            color: $green,
                        ),
                        new Segment(
                            value: 15,
                            color: $blue,
                        ),
                        new Segment(
                            value: 5,
                            color: $yellow,
                        ),
                    ],
                ),
            ],
        ),
    ],
);

$groupedBarChart = new Chart(
    width: 770,
    height: 350,
    series: [
        new Bars(
            bars: [
                new BarGroup(
                    name: 'January',
                    bars: [
                        new Bar(
                            value: 101,
                            color: $red,
                            radius: 10
                        ),
                        new Bar(
                            value: 251,
                            color: $green,
                            radius: 10
                        ),
                        new Bar(
                            value: 389,
                            color: $blue,
                            radius: 10
                        ),
                        new Bar(
                            value: 457,
                            color: $yellow,
                            radius: 10
                        ),
                    ],
                ),
                new BarGroup(
                    name: 'February',
                    bars: [
                        new Bar(
                            value: 73,
                            color: $red,
                            radius: 10,
                        ),
                        new Bar(
                            value: 223,
                            color: $green,
                            radius: 10,
                        ),
                        new Bar(
                            value: 347,
                            color: $blue,
                            radius: 10,
                        ),
                        new Bar(
                            value: 509,
                            color: $yellow,
                            radius: 10,
                        ),
                    ],
                ),
                new BarGroup(
                    name: 'March',
                    bars: [
                        new Bar(
                            value: 113,
                            color: $red,
                            radius: 10,
                        ),
                        new Bar(
                            value: 281,
                            color: $green,
                            radius: 10,
                        ),
                        new Bar(
                            value: 401,
                            color: $blue,
                            radius: 10,
                        ),
                        new Bar(
                            value: 541,
                            color: $yellow,
                            radius: 10,
                        ),
                    ],
                ),
                new BarGroup(
                    name: 'April',
                    bars: [
                        new Bar(
                            value: 193,
                            color: $red,
                            radius: 10,
                        ),
                        new Bar(
                            value: 311,
                            color: $green,
                            radius: 10,
                        ),
                        new Bar(
                            value: 457,
                            color: $blue,
                            radius: 10,
                        ),
                        new Bar(
                            value: 613,
                            color: $yellow,
                            radius: 10,
                        ),
                    ],
                ),
            ],
        ),
    ],
);

$pieChart = new PieChart(
    size: 350,
    slices: [
        new Slice(
            value: 14,
            color: $red,
            label: 'Category A',
            explodeDistance: 50,
        ),
        new Slice(
            value: 43,
            color: $green,
            label: 'Category B',
        ),
        new Slice(
            value: 15,
            color: $blue,
            label: 'Category C',
        ),
        new Slice(
            value: 28,
            color: $yellow,
            label: 'Category D',
        ),
    ],
    formatter: fn (string $label, float $percentage) => "$percentage%",
);

$advancedLineChart = new Chart(
    width: 770,
    height: 350,
    yAxis: [
        new YAxis(
            title: 'Some Axis',
            annotations: [
                new YAxisLineAnnotation(
                    y: 57,
                    color: $red,
                    label: 'Halfway',
                    textLeftMargin: -2,
                    textTopMargin: -2,
                    radius: 5,
                ),
            ],
        ),
        new YAxis(
            name: 'other',
            title: 'Some Other Axis',
            maxValue: 1000,
            annotations: [
                new YAxisRangeAnnotation(
                    y1: 0,
                    y2: 150,
                    color: $blue,
                    label: 'On Different Y Axis',
                    textLeftMargin: -2,
                    radius: 5,
                ),
            ],
        ),
    ],
    xAxis: new XAxis(
        title: 'Some Axis',
        annotations: [
            new XAxisLineAnnotation(
                x: 225,
                color: $green,
                label: 'Halfway',
                textLeftMargin: -2,
                textTopMargin: -2,
                radius: 5,
            ),
        ],
    ),
    series: [
        new Lines(
            lines: [
                new Line(
                    points: [
                        [0, 12],
                        [50, 22],
                        [100, 18],
                        [150, 40],
                        [200, 32],
                        [250, 58],
                        [300, 52],
                        [350, 78],
                        [400, 68],
                        [450, 105],
                    ],
                    color: $red,
                    curve: 5,
                ),
                new Line(
                    points: [
                        [0, 8],
                        [50, 25],
                        [100, 45],
                        [150, 35],
                        [200, 62],
                        [250, 55],
                        [300, 73],
                        [350, 95],
                        [400, 85],
                        [450, 115],
                    ],
                    yAxis: 'other',
                    color: $green,
                    curve: 5,
                ),
                new Line(
                    points: [
                        [0, 6],
                        [50, 12],
                        [100, 15],
                        [150, 30],
                        [200, 20],
                        [250, 50],
                        [300, 40],
                        [350, 70],
                        [400, 60],
                        [450, 88],
                    ],
                    yAxis: 'other',
                    color: $blue,
                    curve: 5,
                ),
                new Line(
                    points: [
                        [0, 18],
                        [50, 32],
                        [100, 28],
                        [150, 48],
                        [200, 38],
                        [250, 68],
                        [300, 55],
                        [350, 85],
                        [400, 75],
                        [450, 112],
                    ],
                    color: $yellow,
                    curve: 5,
                ),
            ]
        ),
    ],
);

$mpdf->SetHTMLFooter(<<<'HTML'
<footer>
    Page {PAGENO} of {nbpg}
</footer>
HTML);

$html = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            line-height: 1.6;
        }

        header {
            position: fixed;
            top: -30px;
            left: 0;
            right: 0;
            height: 30px;
            background-color: #f4f4f4;
            text-align: center;
            line-height: 30px;
            font-weight: bold;
            font-size: 14px;
        }

        footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 20px;
            background-color: #f4f4f4;
            text-align: center;
            line-height: 20px;
            font-size: 12px;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .subtitle {
            text-align: center;
            font-size: 18px;
            margin-bottom: 15px;
            color: #555;
        }

        .section {
            margin-bottom: 30px;
        }

        .chart {
            width: 100%;
            height: 300px;
            border: 1px dashed black;
            text-align: center;
            line-height: 300px;
            font-size: 16px;
            color: #999;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .legend {
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            border-radius: 50%;
            display: inline-block;
        }

        .legend-label {
            font-size: 14px;
        }
    </style>
</head>
<body>

<header>
    Example Report Header
</header>

<div class="title">Imaginary Report</div>
<div class="subtitle">Subtitle or Tagline</div>

<div class="legend">
    <h3>Legend</h3>
    <div class="legend-item">
        <div class="legend-color" style="background-color: $red;"></div>
        <div class="legend-label">Category A</div>
    </div>
    <div class="legend-item">
        <div class="legend-color" style="background-color: $green;"></div>
        <div class="legend-label">Category B</div>
    </div>
    <div class="legend-item">
        <div class="legend-color" style="background-color: $blue;"></div>
        <div class="legend-label">Category C</div>
    </div>
    <div class="legend-item">
        <div class="legend-color" style="background-color: $yellow;"></div>
        <div class="legend-label">Category D</div>
    </div>
</div>

<div class="section">
    <h3>Simple Line Chart</h3>
    <div class="chart">{$lineChart->render()}</div>
    <p>Description: A basic line chart to display trends over time.</p>
</div>

<div class="section">
    <h3>Curved Line Chart</h3>
    <div class="chart">{$curvedLineChart->render()}</div>
    <p>Description: A smooth, curved line chart for a more polished look.</p>
</div>

<div class="section">
    <h3>Step Line Chart</h3>
    <div class="chart">{$stepLineChart->render()}</div>
    <p>Description: A step line chart for data that changes at specific intervals.</p>
</div>

<div class="section">
    <h3>Bar Chart</h3>
    <div class="chart">{$barChart->render()}</div>
    <p>Description: A bar chart to compare values across categories.</p>
</div>

<div class="section">
    <h3>Stacked Bar Chart</h3>
    <div class="chart">{$stackedBarChart->render()}</div>
    <p>Description: A stacked bar chart to show parts of a whole.</p>
</div>

<div class="section">
    <h3>Grouped Bar Chart</h3>
    <div class="chart">{$groupedBarChart->render()}</div>
    <p>Description: A grouped bar chart for side-by-side category comparison.</p>
</div>

<div class="section">
    <h3>Advanced Line Chart</h3>
    <div class="chart">{$advancedLineChart->render()}</div>
    <p>Description: An advanced line chart with multiple datasets and custom markers.</p>
</div>

<div class="section">
    <h3>Pie Chart</h3>
    <div class="chart">{$pieChart->render()}</div>
    <p>Description: A pie chart to show proportional data distribution.</p>
</div>

</body>
</html>
HTML;

$mpdf->WriteHTML($html);
echo $mpdf->Output();
