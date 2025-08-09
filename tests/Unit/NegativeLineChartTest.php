<?php

use Maantje\Charts\Chart;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;

it('calculates correct coordinates for mixed positive/negative line points', function () {
    $positivePoint = new Point(x: 0, y: 10);
    $negativePoint = new Point(x: 100, y: -10);
    $zeroPoint = new Point(x: 200, y: 0);

    $line = new Line(points: [$positivePoint, $negativePoint, $zeroPoint]);

    $chart = new Chart(
        series: [
            new Lines(lines: [$line]),
        ],
    );

    $positivePointY = $chart->yForAxis($positivePoint->y);
    $negativePointY = $chart->yForAxis($negativePoint->y);
    $zeroPointY = $chart->yForAxis($zeroPoint->y);

    expect($positivePointY)->toBe($chart->top())
        ->and($negativePointY)->toBe($chart->bottom())
        ->and($zeroPointY)->toBe($chart->zeroLineY())
        ->and($chart->zeroLineY())->toBe($chart->top() + ($chart->bottom() - $chart->top()) / 2);
});

it('positions zero line at top for all negative line values', function () {
    $smallNegativePoint = new Point(x: 200, y: -5);
    $mediumNegativePoint = new Point(x: 0, y: -10);
    $largeNegativePoint = new Point(x: 100, y: -20);

    $line = new Line(points: [$mediumNegativePoint, $largeNegativePoint, $smallNegativePoint]);

    $chart = new Chart(
        series: [
            new Lines(lines: [$line]),
        ],
    );

    $smallNegativePointY = $chart->yForAxis($smallNegativePoint->y);
    $mediumNegativePointY = $chart->yForAxis($mediumNegativePoint->y);
    $largeNegativePointY = $chart->yForAxis($largeNegativePoint->y);

    expect($chart->zeroLineY())->toBe($chart->top())
        ->and($largeNegativePointY)->toBe($chart->bottom())
        ->and($mediumNegativePointY)->toBeGreaterThan($chart->zeroLineY())
        ->and($smallNegativePointY)->toBeLessThan($mediumNegativePointY);
});

it('coordinates multiple lines with different negative ranges', function () {
    $line1Point1 = new Point(x: 0, y: 0);
    $line1Point2 = new Point(x: 100, y: -20);
    $line2Point1 = new Point(x: 0, y: -10);
    $line2Point2 = new Point(x: 100, y: 10);

    $line1 = new Line(points: [$line1Point1, $line1Point2]);
    $line2 = new Line(points: [$line2Point1, $line2Point2]);

    $chart = new Chart(
        series: [
            new Lines(lines: [$line1, $line2]),
        ],
    );

    $zeroPointY = $chart->yForAxis($line1Point1->y);
    $largeNegativePointY = $chart->yForAxis($line1Point2->y);
    $smallNegativePointY = $chart->yForAxis($line2Point1->y);
    $positivePointY = $chart->yForAxis($line2Point2->y);

    expect($zeroPointY)->toBe($chart->zeroLineY())
        ->and($largeNegativePointY)->toBe($chart->bottom())
        ->and($positivePointY)->toBe($chart->top())
        ->and($smallNegativePointY)->toBeGreaterThan($chart->zeroLineY())
        ->and($smallNegativePointY)->toBeLessThan($chart->bottom());
});

it('handles zero-crossing line segments', function () {
    $startPoint = new Point(x: 0, y: -20);
    $crossingPoint = new Point(x: 50, y: 0);
    $endPoint = new Point(x: 100, y: 20);

    $line = new Line(points: [$startPoint, $crossingPoint, $endPoint]);

    $chart = new Chart(
        series: [
            new Lines(lines: [$line]),
        ],
    );

    $startPointY = $chart->yForAxis($startPoint->y);
    $crossingPointY = $chart->yForAxis($crossingPoint->y);
    $endPointY = $chart->yForAxis($endPoint->y);

    $startX = $chart->xFor($startPoint->x);
    $midX = $chart->xFor($crossingPoint->x);
    $endX = $chart->xFor($endPoint->x);

    expect($startPointY)->toBe($chart->bottom())
        ->and($crossingPointY)->toBe($chart->zeroLineY())
        ->and($endPointY)->toBe($chart->top())
        ->and($midX)->toBeGreaterThan($startX)
        ->and($midX)->toBeLessThan($endX);
});
