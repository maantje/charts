<?php

require '../vendor/autoload.php';

use Maantje\Charts\Annotations\PointAnnotation;
use Maantje\Charts\Annotations\XAxis\XAxisRangeAnnotation;
use Maantje\Charts\Annotations\YAxis\YAxisLineAnnotation;
use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Bar\Segment;
use Maantje\Charts\Bar\StackedBar;
use Maantje\Charts\Chart;
use Maantje\Charts\Formatter;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;
use Maantje\Charts\XAxis;
use Maantje\Charts\YAxis;

$chart = new Chart(
    yAxis: new YAxis(
        annotations: [
            new PointAnnotation(
                x: 200,
                y: 12000,
                markerSize: 10,
                markerBackgroundColor: 'white',
                markerBorderColor: 'red',
                markerBorderWidth: 4,
                label: 'Point annotation',
            ),
            new YAxisLineAnnotation(
                y: 8400,
                color: 'blue',
                size: 3,
                label: 'Y Axis annotation',
                labelColor: 'white',
            ),
        ],
        formatter: Formatter::number('nl_NL', 2)
    ),
    xAxis: new XAxis(
        annotations: [
            new XAxisRangeAnnotation(
                x1: 100,
                x2: 200,
                color: 'pink',
                label: 'X Axis range annotation'
            ),
        ],
    ),
    series: [
        new Lines(
            lines: [
                new Line(
                    points: [
                        new Point(y: 0, x: 0),
                        new Point(y: 4000, x: 100),
                        new Point(y: 12000, x: 200),
                        new Point(y: 8000, x: 300),
                    ],
                ),
                new Line(
                    points: [
                        new Point(y: 0, x: 0),
                        new Point(y: 12000, x: 100),
                        new Point(y: 14000, x: 200),
                        new Point(y: 7000, x: 300),
                    ],
                    color: 'blue'
                ),
            ]
        ),
        new Bars(
            bars: [
                new StackedBar(
                    name: 'January',
                    segments: [
                        new Segment(
                            value: 4000,
                            color: 'green',
                            labelColor: 'white',
                        ),
                        new Segment(
                            value: 3000,
                            color: 'red',
                            labelColor: 'white',
                        ),
                    ],
                    formatter: Formatter::number('nl_NL', 2),
                ),
                new Bar(
                    name: 'February',
                    value: 10000,
                    color: 'green'
                ),
                new StackedBar(
                    name: 'March',
                    segments: [
                        new Segment(
                            value: 4000,
                            color: 'green',
                            labelColor: 'white',
                        ),
                        new Segment(
                            value: 3000,
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
