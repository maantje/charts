<?php

use Maantje\Charts\Chart;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;

require '../vendor/autoload.php';

$chart = new Chart(
    series: [
        new Lines(
            lines: [
                new Line(
                    points: [
                        new Point(y: 0, x: 0),
                        new Point(y: 4, x: 100),
                        new Point(y: 12, x: 200),
                        new Point(y: 8, x: 300),
                    ],
                ),
                new Line(
                    points: [
                        new Point(y: 4, x: 0),
                        new Point(y: 12, x: 100),
                        new Point(y: 24, x: 200),
                        new Point(y: 7, x: 300),
                    ],
                    lineColor: 'blue'
                ),
            ]
        ),
    ],
);

echo $chart->render();
