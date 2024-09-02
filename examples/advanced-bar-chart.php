<?php

require '../vendor/autoload.php';

use Maantje\Phpviz\Annotations\YAxis\YAxisLineAnnotation;
use Maantje\Phpviz\Bar\Bar;
use Maantje\Phpviz\Bar\Bars;
use Maantje\Phpviz\Chart;
use Maantje\Phpviz\Formatter;
use Maantje\Phpviz\YAxis;

$chart = new Chart(
    yAxis: new YAxis(
        minValue: 120000,
        maxValue: 220000,
        annotations: [
            new YAxisLineAnnotation(
                y: 200000,
                color: 'green',
                label: 'Target',
            ),
            new YAxisLineAnnotation(
                y: 150000,
                color: 'red',
                label: 'Loss',
            )
        ],
        formatter: Formatter::currency('nl_NL', 'EUR')
    ),
    series: [
        new Bars(
            bars: [
                new Bar(
                    name: 'Jan',
                    value: 222301,
                    color: 'lightgreen'
                ),
                new Bar(
                    name: 'Feb',
                    value: 189242,
                    color: 'yellow',
                ),
                new Bar(
                    name: 'March',
                    value: 144922,
                    color: 'red'
                ),
                new Bar(
                    name: 'Apr',
                    value: 222301,
                    color: 'lightgreen'
                ),
                new Bar(
                    name: 'May',
                    value: 222301,
                    color: 'lightgreen'
                ),
            ],
        ),
    ],
);

echo $chart->render();
