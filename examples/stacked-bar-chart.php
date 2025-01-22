<?php

require '../vendor/autoload.php';

use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Bar\Segment;
use Maantje\Charts\Bar\StackedBar;
use Maantje\Charts\Chart;

$chart = new Chart(
    series: [
        new Bars(
            bars: [
                new StackedBar(
                    name: 'January',
                    segments: [
                        new Segment(
                            value: 40,
                            color: 'green',
                            labelColor: 'white',
                        ),
                        new Segment(
                            value: 30,
                            color: 'red',
                            labelColor: 'white',
                        ),
                    ],
                ),
                new StackedBar(
                    name: 'February',
                    segments: [
                        new Segment(
                            value: 40,
                            color: 'green',
                            labelColor: 'white',
                        ),
                        new Segment(
                            value: 30,
                            color: 'red',
                            labelColor: 'white',
                        ),
                    ],
                    percentage: true,
                ),
            ],
        ),
    ],
);

echo $chart->render();
