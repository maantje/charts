<?php

use Maantje\Phpviz\Chart;
use Maantje\Phpviz\Line\Line;
use Maantje\Phpviz\Line\Lines;
use Maantje\Phpviz\Line\Point;

require '../vendor/autoload.php';

$chart = new Chart(
    series: [
        new Lines(
            lines: [
                new Line(
                    [
                        new Point(y: 0, x: 0),
                        new Point(y: 4, x: 100),
                        new Point(y: 12, x: 200),
                        new Point(y: 8, x: 300),
                    ],
                ),
            ]
        ),
    ],
);

echo $chart->render();
