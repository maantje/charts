<?php

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Chart;
use Maantje\Charts\YAxis;

it('calculates zero line position for mixed positive/negative values', function () {
    $positiveBar = new Bar(name: 'Positive', value: 100);
    $negativeBar = new Bar(name: 'Negative', value: -100);

    $chart = new Chart(
        series: [
            new Bars(bars: [$positiveBar, $negativeBar]),
        ],
    );

    $positiveBarY = $chart->yForAxis($positiveBar->value);
    $negativeBarY = $chart->yForAxis($negativeBar->value);
    $zeroValueY = $chart->yForAxis(0);

    expect($chart->zeroLineY())->toBe($chart->top() + ($chart->bottom() - $chart->top()) / 2)
        ->and($positiveBarY)->toBe($chart->top())
        ->and($negativeBarY)->toBe($chart->bottom())
        ->and($zeroValueY)->toBe($chart->zeroLineY());
});

it('positions zero line at top when all values are negative', function () {
    $smallNegativeBar = new Bar(name: 'A', value: -100);
    $largeNegativeBar = new Bar(name: 'B', value: -200);

    $chart = new Chart(
        series: [
            new Bars(bars: [$smallNegativeBar, $largeNegativeBar]),
        ],
    );

    $smallNegativeBarY = $chart->yForAxis($smallNegativeBar->value);
    $largeNegativeBarY = $chart->yForAxis($largeNegativeBar->value);

    expect($chart->zeroLineY())->toBe($chart->top())
        ->and($largeNegativeBarY)->toBe($chart->bottom())
        ->and($smallNegativeBarY)->toBeGreaterThan($chart->zeroLineY())
        ->and($smallNegativeBarY)->toBeLessThan($chart->bottom());
});

it('positions zero line at bottom when all values are positive', function () {
    $smallPositiveBar = new Bar(name: 'A', value: 100);
    $largePositiveBar = new Bar(name: 'B', value: 200);

    $chart = new Chart(
        series: [
            new Bars(bars: [$smallPositiveBar, $largePositiveBar]),
        ],
    );

    $smallPositiveBarY = $chart->yForAxis($smallPositiveBar->value);
    $largePositiveBarY = $chart->yForAxis($largePositiveBar->value);

    expect($chart->zeroLineY())->toBe($chart->bottom())
        ->and($largePositiveBarY)->toBe($chart->top())
        ->and($smallPositiveBarY)->toBeLessThan($chart->zeroLineY())
        ->and($smallPositiveBarY)->toBeGreaterThan($chart->top());
});

it('handles explicit maxValue of 0 with negative values', function () {
    $smallNegativeBar = new Bar(name: 'A', value: -100);
    $largeNegativeBar = new Bar(name: 'B', value: -200);

    $chart = new Chart(
        yAxis: new YAxis(maxValue: 0),
        series: [
            new Bars(bars: [$smallNegativeBar, $largeNegativeBar]),
        ],
    );

    $largeNegativeBarY = $chart->yForAxis($largeNegativeBar->value);

    expect($chart->zeroLineY())->toBe($chart->top())
        ->and($largeNegativeBarY)->toBe($chart->bottom());
});

it('coordinates negative bars with zero line', function () {
    $positiveBar = new Bar(name: 'Mixed', value: 50);
    $zeroBar = new Bar(name: 'Zero', value: 0);
    $negativeBar = new Bar(name: 'Negative', value: -50);

    $chart = new Chart(
        series: [
            new Bars(bars: [$positiveBar, $zeroBar, $negativeBar]),
        ],
    );

    $positiveBarY = $chart->yForAxis($positiveBar->value);
    $zeroBarY = $chart->yForAxis($zeroBar->value);
    $negativeBarY = $chart->yForAxis($negativeBar->value);

    expect($positiveBarY)->toBeLessThan($chart->zeroLineY())
        ->and($negativeBarY)->toBeGreaterThan($chart->zeroLineY())
        ->and($zeroBarY)->toBe($chart->zeroLineY());
});
