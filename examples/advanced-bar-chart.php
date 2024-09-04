<?php

require '../vendor/autoload.php';

use Maantje\Charts\Annotations\YAxis\YAxisLineAnnotation;
use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Chart;
use Maantje\Charts\Formatter;
use Maantje\Charts\YAxis;

$chart = new Chart(
    yAxis: new YAxis(
        minValue: 120000,
        maxValue: 230000,
        annotations: [
            new YAxisLineAnnotation(
                y: 200000,
                color: 'green',
                label: 'Target',
                textLeftMargin: -1
            ),
            new YAxisLineAnnotation(
                y: 150000,
                color: 'red',
                label: 'Loss',
                textLeftMargin: -2
            ),
        ],
        formatter: Formatter::currency('nl_NL', 'EUR')
    ),
    series: [
        new Bars(
            bars: [
                new Bar(
                    name: 'January',
                    value: 222301,
                    color: 'lightgreen'
                ),
                new Bar(
                    name: 'February',
                    value: 189242,
                    color: 'yellow',
                ),
                new Bar(
                    name: 'March',
                    value: 144922,
                    color: 'red'
                ),
                new Bar(
                    name: 'April',
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
