<?php

use Maantje\Charts\Annotations\PointAnnotation;
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
            minValue: 30,
            maxValue: 50,
            color: 'red',
            annotations: [
                new YAxisLineAnnotation(
                    y: 48,
                    color: 'red',
                    size: 3,
                    dash: '20,20',
                    label: 'Critical Hot',
                    textLeftMargin: 3
                ),
                new YAxisRangeAnnotation(
                    y1: 39,
                    y2: 48,
                    color: 'red',
                    label: 'Too hot',
                ),
                new YAxisRangeAnnotation(
                    y1: 36,
                    y2: 39,
                    color: 'green',
                    label: 'Ideal',
                ),
                new YAxisRangeAnnotation(
                    y1: 36,
                    y2: 32,
                    color: 'blue',
                    label: 'Too cold',
                ),
                new YAxisLineAnnotation(
                    y: 32,
                    color: 'blue',
                    size: 3,
                    dash: '20,20',
                    label: 'Critical Cold',
                    textLeftMargin: 3
                ),
            ],
        ),
        new YAxis(
            name: 'elevation',
            title: 'Elevation',
            minValue: 0,
            maxValue: 3000,
            annotations: [
                new PointAnnotation(
                    x: 1725331334 + 3600,
                    y: 2000,
                    markerSize: 10,
                    markerBackgroundColor: 'white',
                    markerBorderColor: 'red',
                    markerBorderWidth: 4,
                    label: 'Point annotation',
                ),
            ],
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
                textLeftMargin: -2
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
                        new Point(x: 1725331334, y: 37.3),
                        new Point(x: 1725331334 + 3600, y: 37.8),
                        new Point(x: 1725331334 + 3600 + 3600, y: 38),
                        new Point(x: 1725331334 + 3600 + 3600 + 3600, y: 42.2),
                    ],
                    yAxis: 'celsius',
                    color: '#FF0000',
                ),
                new Line(
                    [
                        new Point(x: 1725331334, y: 0),
                        new Point(x: 1725331334 + 3600, y: 900),
                        new Point(x: 1725331334 + 3600 + 3600, y: 1800),
                        new Point(x: 1725331334 + 3600 + 3600 + 3600, y: 2200),
                    ],
                    yAxis: 'elevation',
                ),
            ]
        ),
    ],
);

echo $chart->render();
