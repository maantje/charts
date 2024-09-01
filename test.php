<?php

require 'vendor/autoload.php';

use Maantje\Phpviz\Bar\Bar;
use Maantje\Phpviz\Bar\BarChart;
use Maantje\Phpviz\Bar\BarOptions;
use Maantje\Phpviz\Line\Line;
use Maantje\Phpviz\Line\LineChart;
use Maantje\Phpviz\Line\LineOptions;
use Maantje\Phpviz\Line\Point;
use Maantje\Phpviz\Pie\PieChart;
use Maantje\Phpviz\Pie\PieOptions;
use Maantje\Phpviz\Pie\Slice;

$chart = new BarChart(
    new BarOptions(
        width: 600,
        height: 400,
    ),
    [
        new Bar(
            name: 'moneys',
            value: 500000,
            color: 'pink'
        ),
        new Bar(
            name: 'more moneys',
            value: 200000,
            color: 'blue'
        ),
    ],

);
//echo $chart->render();

$chart = new PieChart(
    options: new PieOptions(
        size: 1000,
    ),
    data: [
        new Slice(
            value: 2000,
            color: 'blue',
            label: 'Kaas',
            labelColor: 'white',
            explodeDistance: 50
        ),
        new Slice(
            value: 2000,
            color: 'yellow',
            label: 'Baas',
        ),
        new Slice(
            value: 2000,
            color: 'green',
            label: 'Naas'
        ),
        new Slice(
            value: 2000,
            color: 'red',
            label: 'Laas',
        ),
    ]
);
//echo $chart->render();

$line1 = new Line(
    [
        new Point(10, '#FF0000'),
        new Point(20, '#FF0000'),
        new Point(15, '#FF0000'),
        new Point(25, '#FF0000'),
        new Point(30, '#FF0000'),
    ],
    lineColor: '#FF0000'
);

$line2 = new Line(
    [
        new Point(5, '#0000FF'),
        new Point(15, '#0000FF'),
        new Point(10, '#0000FF'),
        new Point(20, '#0000FF'),
        new Point(25, '#0000FF'),
    ],
    lineColor: '#0000FF'
);

$chart = new LineChart(
    options: new LineOptions(
        width: 600,
        height: 400,
    ),
    lines: [$line1, $line2],
);
echo $chart->render();
