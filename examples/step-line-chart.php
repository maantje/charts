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
                        new Point(x: 0, y: 15),
                        new Point(x: 50, y: 25),
                        new Point(x: 100, y: 20),
                        new Point(x: 150, y: 45),
                        new Point(x: 200, y: 35),
                        new Point(x: 250, y: 65),
                        new Point(x: 300, y: 55),
                        new Point(x: 350, y: 85),
                        new Point(x: 400, y: 75),
                        new Point(x: 450, y: 110),
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
