<?php

require '../vendor/autoload.php';

use Maantje\Phpviz\Bar\Bar;
use Maantje\Phpviz\Bar\Bars;
use Maantje\Phpviz\Chart;

$chart = new Chart(
    series: [
        new Bars(
            bars: [
                new Bar(
                    name: 'Jan',
                    value: 222301,
                ),
                new Bar(
                    name: 'Feb',
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
