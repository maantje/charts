<?php

require 'vendor/autoload.php';

use Maantje\Phpviz\Annotations\YAxis;
use Maantje\Phpviz\Annotations\YAxisRange;
use Maantje\Phpviz\Bar\Alignment;
use Maantje\Phpviz\Bar\Bar;
use Maantje\Phpviz\Bar\Bars;
use Maantje\Phpviz\Chart;
use Maantje\Phpviz\Line\Line;
use Maantje\Phpviz\Line\Lines;
use Maantje\Phpviz\Line\Point;
use Maantje\Phpviz\Pie\PieChart;
use Maantje\Phpviz\Pie\PieOptions;
use Maantje\Phpviz\Pie\Slice;

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
$chart = new Chart(
    width: 1000,
    height: 500,
    elements: [
        new Bars(
            bars: [
                new Bar(
                    name: 'moneys',
                    value: 20,
                    color: 'pink'
                ),
                new Bar(
                    name: 'more moneys',
                    value: 50,
                    color: 'blue'
                ),
            ],
            alignment: Alignment::JUSTIFY_AROUND
        ),
        new Lines(
            lines: [
                new Line(
                    [
                        new Point(value: 10, color: '#FF0000', size: 5),
                        new Point(value: 20, color: '#FF0000', size: 5),
                        new Point(value: 15, color: '#FF0000', size: 5),
                        new Point(value: 25, color: '#FF0000', size: 5),
                    ],
                    lineColor: '#FF0000',
                    fillColor: 'rgba(255, 0, 0, 0.4)'
                ),
                new Line(
                    [
                        new Point(5, '#0000FF'),
                        new Point(15, '#0000FF'),
                        new Point(10, '#0000FF'),
                        new Point(20, '#0000FF'),
                    ],
                    lineColor: '#0000FF',
                    fillColor: 'rgba(0, 0, 255, 0.4)'
                ),
            ]
        ),
    ],
    annotations: [
        new YAxis(
            y: 20,
            size: 3,
            color: 'green',
            label: 'Break even',
        ),
        new YAxisRange(
            y1: 20,
            y2: 30,
            label: 'Medium',
            labelColor: 'black',
        ),
        new YAxisRange(
            y1: 30,
            y2: 40,
            color: 'green',
            label: 'Good',
        ),
    ],
);

echo $chart->render();
