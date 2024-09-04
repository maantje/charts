<?php

require '../vendor/autoload.php';

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Chart;

$chart = new Chart(
    series: [
        new Bars(
            bars: [
                new Bar(
                    name: 'January',
                    value: 222301,
                ),
                new Bar(
                    name: 'February',
                    value: 189242,
                ),
                new Bar(
                    name: 'March',
                    value: 144922,
                ),
            ],
        ),
    ],
);

echo $chart->render();
