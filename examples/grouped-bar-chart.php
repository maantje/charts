<?php

require '../vendor/autoload.php';

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\BarGroup;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Chart;
use Maantje\Charts\YAxis;

$chart = new Chart(
    yAxis: new YAxis(
        minValue: 0,
        maxValue: 1000,
    ),
    series: [
        new Bars(
            bars: [
                new BarGroup(
                    name: 'January',
                    bars: [
                        new Bar(
                            value: 101,
                            color: '#1E90FF',
                        ),
                        new Bar(
                            value: 251,
                            color: '#32CD32',
                        ),
                        new Bar(
                            value: 389,
                            color: '#FFA500',
                        ),
                        new Bar(
                            value: 457,
                            color: '#FFD700',
                        ),
                        new Bar(
                            value: 601,
                            color: '#FF4500',
                        ),
                    ],
                    radius: 10,
                ),
                new BarGroup(
                    name: 'February',
                    bars: [
                        new Bar(
                            value: 73,
                            color: '#1E90FF',
                            radius: 10,
                        ),
                        new Bar(
                            value: 223,
                            color: '#32CD32',
                            radius: 10,
                        ),
                        new Bar(
                            value: 347,
                            color: '#FFA500',
                            radius: 10,
                        ),
                        new Bar(
                            value: 509,
                            color: '#FFD700',
                            radius: 10,
                        ),
                        new Bar(
                            value: 653,
                            color: '#FF4500',
                            radius: 10,
                        ),
                    ],
                ),
                new BarGroup(
                    name: 'March',
                    bars: [
                        new Bar(
                            value: 113,
                            color: '#1E90FF',
                            radius: 10,
                        ),
                        new Bar(
                            value: 281,
                            color: '#32CD32',
                            radius: 10,
                        ),
                        new Bar(
                            value: 401,
                            color: '#FFA500',
                            radius: 10,
                        ),
                        new Bar(
                            value: 541,
                            color: '#FFD700',
                            radius: 10,
                        ),
                        new Bar(
                            value: 733,
                            color: '#FF4500',
                            radius: 10,
                        ),
                    ],
                ),
                new BarGroup(
                    name: 'April',
                    bars: [
                        new Bar(
                            value: 193,
                            color: '#1E90FF',
                            radius: 10,
                        ),
                        new Bar(
                            value: 311,
                            color: '#32CD32',
                            radius: 10,
                        ),
                        new Bar(
                            value: 457,
                            color: '#FFA500',
                            radius: 10,
                        ),
                        new Bar(
                            value: 613,
                            color: '#FFD700',
                            radius: 10,
                        ),
                        new Bar(
                            value: 809,
                            color: '#FF4500',
                            radius: 10,
                        ),
                    ],
                ),
            ],
        ),
    ],
);

echo $chart->render();
