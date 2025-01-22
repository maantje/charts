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
                        new Point(y: 20, x: 50),
                        new Point(y: 5, x: 100),
                        new Point(y: 25, x: 150),
                        new Point(y: 10, x: 200),
                        new Point(y: 30, x: 250),
                        new Point(y: 15, x: 300),
                        new Point(y: 25, x: 350),
                        new Point(y: 35, x: 400),
                    ],
                    color: 'red',
                    curve: 8
                ),

                new Line(
                    points: [
                        new Point(y: 2, x: 0),
                        new Point(y: 4, x: 50),
                        new Point(y: 8, x: 100),
                        new Point(y: 16, x: 150),
                        new Point(y: 32, x: 200),
                        new Point(y: 64, x: 300),
                        new Point(y: 96, x: 350),
                        new Point(y: 128, x: 400),
                    ],
                    color: 'blue',
                    curve: 6
                ),

                new Line(
                    points: [
                        new Point(y: 10, x: 0),
                        new Point(y: 20, x: 50),
                        new Point(y: 10, x: 100),
                        new Point(y: 0, x: 150),
                        new Point(y: 10, x: 200),
                        new Point(y: 20, x: 250),
                        new Point(y: 10, x: 300),
                        new Point(y: 5, x: 350),
                        new Point(y: 0, x: 400),
                    ],
                    color: 'green',
                    curve: 5
                ),

                new Line(
                    points: [
                        new Point(y: 5, x: 0),
                        new Point(y: 15, x: 50),
                        new Point(y: 30, x: 120),
                        new Point(y: 10, x: 180),
                        new Point(y: 40, x: 250),
                        new Point(y: 20, x: 320),
                        new Point(y: 35, x: 350),
                        new Point(y: 50, x: 400),
                    ],
                    color: 'purple',
                    curve: 7
                ),
            ]
        ),
    ],
);

echo $chart->render();
