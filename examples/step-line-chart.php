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
                        new Point(y: 15, x: 0),
                        new Point(y: 25, x: 50),
                        new Point(y: 20, x: 100),
                        new Point(y: 45, x: 150),
                        new Point(y: 35, x: 200),
                        new Point(y: 65, x: 250),
                        new Point(y: 55, x: 300),
                        new Point(y: 85, x: 350),
                        new Point(y: 75, x: 400),
                        new Point(y: 110, x: 450),
                    ],
                    size: 4,
                    color: 'purple',
                    stepLine: true
                ),
            ]
        ),
    ],
);

echo $chart->render();
