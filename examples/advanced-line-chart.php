<?php

use Maantje\Charts\Annotations\XAxis\XAxisLineAnnotation;
use Maantje\Charts\Annotations\XAxis\XAxisRangeAnnotation;
use Maantje\Charts\Annotations\YAxis\YAxisLineAnnotation;
use Maantje\Charts\Annotations\YAxis\YAxisRangeAnnotation;
use Maantje\Charts\Chart;
use Maantje\Charts\Formatter;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;
use Maantje\Charts\XAxis;
use Maantje\Charts\YAxis;

require '../vendor/autoload.php';

$chart = new Chart(
    yAxis: [
        new YAxis(
            name: 'celsius',
            title: 'Temperature',
            color: 'red',
            minValue: 30,
            maxValue: 50,
            annotations: [
                new YAxisLineAnnotation(
                    y: 48,
                    color: 'red',
                    yAxis: 'celsius',
                    size: 3,
                    dash: '20,20',
                    label: 'Critical Hot',
                ),
                new YAxisRangeAnnotation(
                    y1: 39,
                    y2: 48,
                    yAxis: 'celsius',
                    color: 'red',
                    label: 'Too hot',
                ),
                new YAxisRangeAnnotation(
                    y1: 36,
                    y2: 39,
                    yAxis: 'celsius',
                    color: 'green',
                    label: 'Ideal',
                    labelColor: 'green',
                ),
                new YAxisRangeAnnotation(
                    y1: 36,
                    y2: 32,
                    yAxis: 'celsius',
                    color: 'blue',
                    label: 'Too cold',
                ),
                new YAxisLineAnnotation(
                    y: 32,
                    color: 'blue',
                    yAxis: 'celsius',
                    size: 3,
                    dash: '20,20',
                    label: 'Critical Cold',
                ),
            ],
        ),
        new YAxis(
            name: 'elevation',
            title: 'Elevation',
            minValue: 0,
            maxValue: 3000,
            labelMargin: 10,
            formatter: Formatter::template(':value m')
        ),
    ],
    xAxis: new XAxis(
        title: 'Time',
        annotations: [
            new XAxisLineAnnotation(
                x: 1725331334 + 3600 + 1800,
                color: 'green',
                label: 'Halfway',
            ),
            new XAxisRangeAnnotation(
                x1: 1725331334 + 3600 + 3600,
                x2: 1725331334 + 3600 + 3600 + 3600,
                color: 'blue',
                label: 'Last hour',
            ),
        ],
        formatter: Formatter::timestamp(),
    ),
    series: [
        new Lines(
            lines: [
                new Line(
                    [
                        new Point(y: 37.3, x: 1725331334),
                        new Point(y: 37.8, x: 1725331334 + 3600),
                        new Point(y: 38, x: 1725331334 + 3600 + 3600),
                        new Point(y: 42.2, x: 1725331334 + 3600 + 3600 + 3600),
                    ],
                    yAxis: 'celsius',
                    lineColor: '#FF0000',
                ),
                new Line(
                    [
                        new Point(y: 0, x:  1725331334),
                        new Point(y: 900, x:  1725331334 + 3600),
                        new Point(y: 1800, x:  1725331334 + 3600 + 3600),
                        new Point(y: 2200, x:  1725331334 + 3600 + 3600 + 3600),
                    ],
                    yAxis: 'elevation',
                ),
            ]
        ),
    ],
);

echo $chart->render();
