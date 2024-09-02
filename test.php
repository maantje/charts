<?php

require 'vendor/autoload.php';

use Maantje\Phpviz\Annotations\YAxis\YAxisLineAnnotation;
use Maantje\Phpviz\Annotations\YAxis\YAxisRangeAnnotation;
use Maantje\Phpviz\Bar\Alignment;
use Maantje\Phpviz\Bar\Bar;
use Maantje\Phpviz\Bar\Bars;
use Maantje\Phpviz\Chart;
use Maantje\Phpviz\Line\Line;
use Maantje\Phpviz\Line\Lines;
use Maantje\Phpviz\Line\Point;
use Maantje\Phpviz\Pie\PieChart;
use Maantje\Phpviz\Pie\PieOptions;
use Maantje\Phpviz\Pie\Slice;
use Maantje\Phpviz\XAxis;
use Maantje\Phpviz\YAxis;

$chart = new PieChart(
    options: new PieOptions(
        size: 1000,
    ),
    data: [
        new Slice(
            value: 2000,
            color: 'blue',
            label: 'Kaas',
            labelColor: 'white',
            explodeDistance: 50
        ),
        new Slice(
            value: 2000,
            color: 'yellow',
            label: 'Baas',
        ),
        new Slice(
            value: 2000,
            color: 'green',
            label: 'Naas'
        ),
        new Slice(
            value: 2000,
            color: 'red',
            label: 'Laas',
        ),
    ]
);
//echo $chart->render();
$chart = new Chart(
    yAxis: [
        new YAxis(
            name: 'celsius',
            title: 'Celsius',
            minValue: 30,
            maxValue: 50,
            annotations: [
                new YAxisLineAnnotation(
                    y: 48,
                    yAxis: 'celsius',
                    size: 3,
                    color: 'red',
                    label: 'Critical Hot',
                ),
                new YAxisRangeAnnotation(
                    y1: 39,
                    y2: 48,
                    yAxis: 'celsius',
                    color: 'red',
                    label: 'Hot',
                ),
                new YAxisRangeAnnotation(
                    y1: 36,
                    y2: 39,
                    yAxis: 'celsius',
                    color: 'green',
                    label: 'Good',
                    labelColor: 'green',
                ),
                new YAxisRangeAnnotation(
                    y1: 36,
                    y2: 32,
                    yAxis: 'celsius',
                    color: 'blue',
                    label: 'Cold',
                ),
                new YAxisLineAnnotation(
                    y: 32,
                    yAxis: 'celsius',
                    size: 3,
                    color: 'blue',
                    label: 'Critical Cold',
                ),
            ],
        ),
        new YAxis(
            name: 'elevation',
            title: 'Meters',
            minValue: 0,
            maxValue: 3000,
        ),
    ],
    xAxis: new XAxis(
        data: [
            0,
            1000,
            2000,
            3000,
        ]
    ),
    elements: [
                new Bars(
                    bars: [
                        new Bar(
                            name: 'moneys',
                            value: 20,
                            yAxis: 'celsius',
                            color: 'pink'
                        ),
                        new Bar(
                            name: 'more moneys',
                            value: 50,
                            yAxis: 'celsius',
                            color: 'blue'
                        ),
                    ],
                    alignment: Alignment::JUSTIFY_AROUND
                ),
        new Lines(
            lines: [
                new Line(
                    [
                        new Point(y: 37.3, x: 0, color: '#FF0000', size: 5),
                        new Point(y: 37.8, x: 1000, color: '#FF0000', size: 5),
                        new Point(y: 38, x: 2000, color: '#FF0000', size: 5),
                        new Point(y: 42.2, x: 3000, color: '#FF0000', size: 5),
                    ],
                    yAxis: 'celsius',
                    lineColor: '#FF0000',
                ),
                new Line(
                    [
                        new Point(y: 0, x: 0, color: '#0000FF'),
                        new Point(y: 900, x: 1000, color: '#0000FF'),
                        new Point(y: 1800, x: 2000, color: '#0000FF'),
                        new Point(y: 2200, x: 3000, color: '#0000FF'),
                    ],
                    yAxis: 'elevation',
                    lineColor: '#0000FF',
                ),
            ]
        ),
    ],
);

echo $chart->render();
