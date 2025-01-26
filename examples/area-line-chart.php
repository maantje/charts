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
                        new Point(x: 0, y: 20),
                        new Point(x: 100, y: 35),
                        new Point(x: 200, y: 50),
                        new Point(x: 300, y: 30),
                        new Point(x: 400, y: 50),
                        new Point(x: 500, y: 45),
                        new Point(x: 600, y: 30),
                    ],
                    color: 'rgb(75, 192, 192)',
                    areaColor: 'rgba(75, 192, 192, 0.3)',
                    curve: 8
                ),

                new Line(
                    points: [
                        new Point(x: 0, y: 10),
                        new Point(x: 100, y: 20),
                        new Point(x: 200, y: 15),
                        new Point(x: 300, y: 25),
                        new Point(x: 400, y: 20),
                        new Point(x: 500, y: 35),
                        new Point(x: 600, y: 35),
                    ],
                    color: 'rgb(255, 99, 132)',
                    areaColor: 'rgba(255, 99, 132, 0.3)',
                    stepLine: true
                ),

                new Line(
                    points: [
                        new Point(x: 0, y: 10),
                        new Point(x: 100, y: 40),
                        new Point(x: 200, y: 20),
                        new Point(x: 300, y: 50),
                        new Point(x: 400, y: 30),
                        new Point(x: 500, y: 60),
                        new Point(x: 600, y: 40),
                    ],
                    color: 'rgb(54, 162, 235)',
                    areaColor: 'rgba(54, 162, 235, 0.3)',
                ),
            ]
        ),
    ]
);

echo $chart->render();
