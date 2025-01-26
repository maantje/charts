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
                        new Point(x: 0, y: 0),
                        new Point(x: 50, y: 20),
                        new Point(x: 100, y: 5),
                        new Point(x: 150, y: 25),
                        new Point(x: 200, y: 10),
                        new Point(x: 250, y: 30),
                        new Point(x: 300, y: 15),
                        new Point(x: 350, y: 25),
                        new Point(x: 400, y: 35),
                    ],
                    color: 'red',
                    curve: 8
                ),

                new Line(
                    points: [
                        new Point(x: 0, y: 2),
                        new Point(x: 50, y: 4),
                        new Point(x: 100, y: 8),
                        new Point(x: 150, y: 16),
                        new Point(x: 200, y: 32),
                        new Point(x: 250, y: 32),
                        new Point(x: 300, y: 64),
                        new Point(x: 350, y: 96),
                        new Point(x: 400, y: 128),
                    ],
                    color: 'blue',
                    curve: 6
                ),

                new Line(
                    points: [
                        new Point(x: 0, y: 10),
                        new Point(x: 50, y: 20),
                        new Point(x: 100, y: 10),
                        new Point(x: 150, y: 0),
                        new Point(x: 200, y: 10),
                        new Point(x: 250, y: 20),
                        new Point(x: 300, y: 10),
                        new Point(x: 350, y: 5),
                        new Point(x: 400, y: 0),
                    ],
                    color: 'green',
                    curve: 5
                ),

                new Line(
                    points: [
                        new Point(x: 0, y: 5),
                        new Point(x: 50, y: 15),
                        new Point(x: 100, y: 30),
                        new Point(x: 150, y: 30),
                        new Point(x: 200, y: 20),
                        new Point(x: 250, y: 40),
                        new Point(x: 300, y: 20),
                        new Point(x: 350, y: 35),
                        new Point(x: 400, y: 50),
                    ],
                    color: 'purple',
                    curve: 7
                ),
            ]
        ),
    ],
);

echo $chart->render();
