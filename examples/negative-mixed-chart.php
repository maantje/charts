<?php

require '../vendor/autoload.php';

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\BarGroup;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Bar\Segment;
use Maantje\Charts\Bar\StackedBar;
use Maantje\Charts\Chart;
use Maantje\Charts\Formatter;
use Maantje\Charts\Grid;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\XAxis;

$red = '#E74C3C';
$green = '#27AE60';
$blue = '#2980B9';
$yellow = '#F39C12';

$chart = new Chart(
    width: 770,
    height: 350,
    grid: new Grid(
        lines: 6,
    ),

    xAxis: new XAxis(
        formatter: Formatter::hidden(),
    ),
    series: [
        new Lines(
            lines: [
                new Line(
                    points: [
                        [0, 200],
                        [50, -150],
                        [100, -350],
                        [150, 100],
                        [200, 250],
                        [250, -200],
                        [300, 350],
                        [350, -100],
                        [400, 400],
                        [450, -250],
                    ],
                    size: 3,
                    color: $red,
                ),
                new Line(
                    points: [
                        [0, -250],
                        [50, -100],
                        [100, 200],
                        [150, 300],
                        [200, -200],
                        [250, -350],
                        [300, 150],
                        [350, -50],
                        [400, 350],
                        [450, -150],
                    ],
                    size: 3,
                    color: $blue,
                ),
            ],
        ),
        new Bars(
            bars: [
                new StackedBar(
                    name: 'Jan',
                    segments: [
                        new Segment(
                            value: -100,
                            color: $red,
                        ),
                        new Segment(
                            value: -40,
                            color: $green,
                        ),
                        new Segment(
                            value: -50,
                            color: $blue,
                        ),
                        new Segment(
                            value: -100,
                            color: $yellow,
                        ),
                    ],
                ),
                new Bar(name: 'Feb', value: -100, color: $green),
                new Bar(name: 'Mar', value: 200, color: $yellow),
                new BarGroup(
                    name: 'May',
                    bars: [
                        new Bar(
                            value: -101,
                            color: $red,
                        ),
                        new Bar(
                            value: 251,
                            color: $green,
                        ),
                        new Bar(
                            value: -400,
                            color: $blue,
                        ),
                        new Bar(
                            value: 400,
                            color: $yellow,
                        ),
                    ],
                ),
            ],
        ),
    ],
);

echo $chart->render();
