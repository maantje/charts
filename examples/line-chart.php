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
                        [0, 0],
                        [100, 4],
                        [200, 12],
                        [300, 8],
                    ]
                ),
                new Line(
                    points: [
                        new Point(x: 0, y: 4, color: 'red', size: 5),
                        new Point(x: 100, y: 12, color: 'red', size: 5),
                        new Point(x: 200, y: 24, color: 'red', size: 5),
                        new Point(x: 300, y: 7, color: 'red', size: 5),
                    ],
                    color: 'blue'
                ),
            ]
        ),
    ],
);

echo $chart->render();
