<?php

use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Bar\Segment;
use Maantje\Charts\Bar\StackedBar;
use Maantje\Charts\Chart;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;

it('coordinates mixed chart with negative bars and lines', function () {
    $linePoint1 = new Point(x: 2020, y: -35000);
    $linePoint2 = new Point(x: 2021, y: -15000);
    $linePoint3 = new Point(x: 2022, y: -65000);

    $line = new Line(points: [$linePoint1, $linePoint2, $linePoint3]);

    $bar1Segment1 = new Segment(value: -30000, color: '#000000');
    $bar1Segment2 = new Segment(value: -5000, color: '#000000');
    $bar2Segment1 = new Segment(value: -10000, color: '#000000');
    $bar2Segment2 = new Segment(value: -5000, color: '#000000');

    $stackedBar1 = new StackedBar(name: '2020', segments: [$bar1Segment1, $bar1Segment2]);
    $stackedBar2 = new StackedBar(name: '2021', segments: [$bar2Segment1, $bar2Segment2]);

    $chart = new Chart(
        series: [
            new Lines(lines: [$line]),
            new Bars(bars: [$stackedBar1, $stackedBar2]),
        ],
    );

    $linePoint1Y = $chart->yForAxis($linePoint1->y);
    $linePoint2Y = $chart->yForAxis($linePoint2->y);
    $linePoint3Y = $chart->yForAxis($linePoint3->y);

    expect($chart->zeroLineY())->toBe($chart->top())
        ->and($linePoint3Y)->toBe($chart->bottom())
        ->and($linePoint2Y)->toBeGreaterThan($chart->zeroLineY())
        ->and($linePoint1Y)->toBeGreaterThan($linePoint2Y);
});

it('handles mixed positive and negative stacked bars with lines', function () {
    $negativeLinePoint = new Point(x: 2020, y: -35000);
    $positiveLinePoint = new Point(x: 2022, y: 40000);

    $line = new Line(points: [$negativeLinePoint, $positiveLinePoint]);

    $negativeBar1Segment = new Segment(value: -30000, color: '#000000');
    $negativeBar2Segment = new Segment(value: -5000, color: '#000000');
    $positiveBar1Segment = new Segment(value: 45000, color: '#000000');
    $positiveBar2Segment = new Segment(value: 5000, color: '#000000');

    $negativeStackedBar = new StackedBar(name: '2020', segments: [$negativeBar1Segment, $negativeBar2Segment]);
    $positiveStackedBar = new StackedBar(name: '2022', segments: [$positiveBar1Segment, $positiveBar2Segment]);

    $chart = new Chart(
        series: [
            new Lines(lines: [$line]),
            new Bars(bars: [$negativeStackedBar, $positiveStackedBar]),
        ],
    );

    $negativeLinePointY = $chart->yForAxis($negativeLinePoint->y);
    $positiveLinePointY = $chart->yForAxis($positiveLinePoint->y);
    $negativeStackedTotalY = $chart->yForAxis(-35000);
    $positiveStackedTotalY = $chart->yForAxis(50000);

    expect($negativeLinePointY)->toBeGreaterThan($chart->zeroLineY())
        ->and($positiveLinePointY)->toBeLessThan($chart->zeroLineY())
        ->and($negativeStackedTotalY)->toBeGreaterThan($chart->zeroLineY())
        ->and($positiveStackedTotalY)->toBeLessThan($chart->zeroLineY());
});
