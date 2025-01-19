<?php

use Maantje\Charts\Pie\PieChart;
use Maantje\Charts\Pie\Slice;

require '../vendor/autoload.php';

$chart = new PieChart(
    size: 500,
    slices: [
        new Slice(
            value: 14,
            color: '#5B9BD5',
            label: 'Toys',
            explodeDistance: 50,
        ),
        new Slice(
            value: 43,
            color: '#ED7D31',
            label: 'Furniture',
        ),
        new Slice(
            value: 15,
            color: '#A5A5A5',
            label: 'Home',
        ),
        new Slice(
            value: 28,
            color: '#FFC001',
            label: 'Electronics',
        ),
    ],
);

echo $chart->render();
