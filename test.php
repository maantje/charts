<?php

require 'vendor/autoload.php';

use Maantje\Charts\Annotations\YAxis\YAxisLineAnnotation;
use Maantje\Charts\Annotations\YAxis\YAxisRangeAnnotation;
use Maantje\Charts\Chart;
use Maantje\Charts\Formatter;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;
use Maantje\Charts\Pie\PieChart;
use Maantje\Charts\Pie\PieOptions;
use Maantje\Charts\Pie\Slice;
use Maantje\Charts\XAxis;
use Maantje\Charts\YAxis;

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
                    color: 'red',
                    yAxis: 'celsius',
                    size: 3,
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
                    color: 'blue',
                    yAxis: 'celsius',
                    size: 3,
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
            (new DateTime('now +2 hours'))->getTimestamp(),
            (new DateTime('now +4 hours'))->getTimestamp(),
            (new DateTime('now +6 hours'))->getTimestamp(),
            (new DateTime('now +8 hours'))->getTimestamp(),
        ],
        formatter: Formatter::timestamp()
    ),
    series: [
        new Lines(
            lines: [
                new Line(
                    [
                        new Point(y: 37.3, x: (new DateTime('now +2 hours'))->getTimestamp()),
                        new Point(y: 37.8, x: (new DateTime('now +4 hours'))->getTimestamp()),
                        new Point(y: 38, x: (new DateTime('now +6 hours'))->getTimestamp()),
                        new Point(y: 42.2, x: (new DateTime('now +8 hours'))->getTimestamp()),
                    ],
                    yAxis: 'celsius',
                    lineColor: '#FF0000',
                ),
                new Line(
                    [
                        new Point(y: 0, x: (new DateTime('now +2 hours'))->getTimestamp()),
                        new Point(y: 900, x: (new DateTime('now +4 hours'))->getTimestamp()),
                        new Point(y: 1800, x: (new DateTime('now +6 hours'))->getTimestamp()),
                        new Point(y: 2200, x: (new DateTime('now +8 hours'))->getTimestamp()),
                    ],
                    yAxis: 'elevation',
                    lineColor: '#0000FF',
                ),
            ]
        ),
    ],
);
