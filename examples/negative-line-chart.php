<?php

require_once '../vendor/autoload.php';

use Maantje\Charts\Chart;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;

$chart = new Chart(
    series: [
        new Lines(
            lines: [
                new Line(
                    points: [
                        new Point(x: 0, y: 50),
                        new Point(x: 50, y: -20),
                        new Point(x: 100, y: -45),
                        new Point(x: 150, y: 15),
                        new Point(x: 200, y: 30),
                        new Point(x: 250, y: -10),
                        new Point(x: 300, y: 40),
                    ],
                    size: 3,
                    color: '#3498db',
                ),
                new Line(
                    points: [
                        new Point(x: 0, y: -30),
                        new Point(x: 50, y: -15),
                        new Point(x: 100, y: 25),
                        new Point(x: 150, y: 35),
                        new Point(x: 200, y: -25),
                        new Point(x: 250, y: -40),
                        new Point(x: 300, y: 10),
                    ],
                    size: 3,
                    color: '#e74c3c',
                ),
            ],
        ),
    ],
);

echo $chart->render();
