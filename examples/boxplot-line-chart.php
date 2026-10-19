<?php

require '../vendor/autoload.php';

use Maantje\Charts\Boxplot\Boxplot;
use Maantje\Charts\Boxplot\Boxplots;
use Maantje\Charts\Chart;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;
use Maantje\Charts\XAxis;

$chart = new Chart(
    xAxis: new XAxis(
        minValue: 0,
        maxValue: 3,
        formatter: fn () => '',
    ),
    series: [
        new Boxplots(
            boxplots: [
                new Boxplot(
                    name: 'January',
                    values: [12, 30, 45, 60, 88],
                ),
                new Boxplot(
                    name: 'February',
                    values: [20, 35, 50, 70, 95, 130, 4],
                ),
                new Boxplot(
                    name: 'March',
                    values: [8, 22, 38, 55, 76, 110],
                ),
            ],
        ),
        new Lines(
            lines: [
                new Line(
                    points: [
                        new Point(x: 0.5, y: 48, color: '#e74c3c', size: 5),
                        new Point(x: 1.5, y: 56, color: '#e74c3c', size: 5),
                        new Point(x: 2.5, y: 41, color: '#e74c3c', size: 5),
                    ],
                    size: 2,
                    color: '#e74c3c',
                ),
            ],
        ),
    ],
);

echo $chart->render();
