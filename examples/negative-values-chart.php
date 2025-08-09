<?php

require_once '../vendor/autoload.php';

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Chart;
use Maantje\Charts\Grid;

$chart = new Chart(
    grid: new Grid(
        lines: 6,
    ),
    series: [
        new Bars(
            bars: [
                new Bar(name: 'Q1 Profit', value: 150000, color: '#2ecc71'),
                new Bar(name: 'Q2 Loss', value: -150000, color: '#e74c3c'),
                new Bar(name: 'Q3 Profit', value: 75000, color: '#2ecc71'),
                new Bar(name: 'Q4 Loss', value: -45000, color: '#e74c3c'),
            ],
        ),
    ],
);

echo $chart->render();
