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
                        new Point(y: 20, x: 0),
                        new Point(y: 35, x: 100),
                        new Point(y: 50, x: 200),
                        new Point(y: 30, x: 300),
                        new Point(y: 50, x: 400),
                        new Point(y: 45, x: 500),
                        new Point(y: 30, x: 600),
                    ],
                    color: 'rgb(75, 192, 192)',
                    areaColor: 'rgba(75, 192, 192, 0.3)',
                    curve: 8
                ),

                new Line(
                    points: [
                        new Point(y: 10, x: 0),
                        new Point(y: 20, x: 100),
                        new Point(y: 15, x: 200),
                        new Point(y: 25, x: 300),
                        new Point(y: 20, x: 400),
                        new Point(y: 35, x: 500),
                        new Point(y: 35, x: 600),
                    ],
                    color: 'rgb(255, 99, 132)',
                    areaColor: 'rgba(255, 99, 132, 0.3)',
                    stepLine: true
                ),

                new Line(
                    points: [
                        new Point(y: 10, x: 0),
                        new Point(y: 40, x: 100),
                        new Point(y: 20, x: 200),
                        new Point(y: 50, x: 300),
                        new Point(y: 30, x: 400),
                        new Point(y: 60, x: 500),
                        new Point(y: 40, x: 600),
                    ],
                    color: 'rgb(54, 162, 235)',
                    areaColor: 'rgba(54, 162, 235, 0.3)',
                ),
            ]
        ),
    ]
);

echo $chart->render();
