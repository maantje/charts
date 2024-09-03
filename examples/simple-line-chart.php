<?php

use Maantje\Charts\Annotations\XAxis\XAxisLineAnnotation;
use Maantje\Charts\Annotations\XAxis\XAxisRangeAnnotation;
use Maantje\Charts\Chart;
use Maantje\Charts\Formatter;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;
use Maantje\Charts\XAxis;

require '../vendor/autoload.php';

$chart = new Chart(
    xAxis: new XAxis(
        title: 'Time',
        annotations: [
            new XAxisLineAnnotation(
                x: 100,
                color: 'green',
                label: 'Target',
            ),
            new XAxisRangeAnnotation(
                x1: 100,
                x2: 200,
                color: 'blue',
                label: 'Range',
            ),
        ],
    ),
    series: [
        new Lines(
            lines: [
                new Line(
                    [
                        new Point(y: 0, x: 0),
                        new Point(y: 4, x: 100),
                        new Point(y: 12, x: 200),
                        new Point(y: 8, x: 300),
                    ],
                ),
            ]
        ),
    ],
);

echo $chart->render();
