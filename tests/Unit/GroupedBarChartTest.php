<?php

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\BarGroup;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Chart;
use Maantje\Charts\YAxis;

it('calculates correct coordinates for grouped bars', function () {
    $bar1 = new Bar(value: 100, color: '#1E90FF');
    $bar2 = new Bar(value: 200, color: '#32CD32');
    $bar3 = new Bar(value: 300, color: '#FFA500');

    $group = new BarGroup(name: 'Test Group', bars: [$bar1, $bar2, $bar3]);

    $chart = new Chart(
        yAxis: new YAxis(minValue: 0, maxValue: 400),
        series: [new Bars(bars: [$group])],
    );

    $bar1Y = $chart->yForAxis($bar1->value);
    $bar2Y = $chart->yForAxis($bar2->value);
    $bar3Y = $chart->yForAxis($bar3->value);
    $zeroY = $chart->yForAxis(0);

    expect($bar1Y)->toBeLessThan($zeroY)
        ->and($bar2Y)->toBeLessThan($bar1Y)
        ->and($bar3Y)->toBeLessThan($bar2Y)
        ->and($zeroY)->toBe($chart->bottom());
});

it('positions zero line at top for all negative grouped bars', function () {
    $smallNegativeBar = new Bar(value: -50);
    $mediumNegativeBar = new Bar(value: -100);
    $largeNegativeBar = new Bar(value: -200);

    $group = new BarGroup(
        name: 'Negative Group',
        bars: [$smallNegativeBar, $mediumNegativeBar, $largeNegativeBar],
    );

    $chart = new Chart(
        series: [new Bars(bars: [$group])],
    );

    $smallNegativeBarY = $chart->yForAxis($smallNegativeBar->value);
    $mediumNegativeBarY = $chart->yForAxis($mediumNegativeBar->value);
    $largeNegativeBarY = $chart->yForAxis($largeNegativeBar->value);

    expect($chart->zeroLineY())->toBe($chart->top())
        ->and($largeNegativeBarY)->toBe($chart->bottom())
        ->and($mediumNegativeBarY)->toBeGreaterThan($chart->zeroLineY())
        ->and($smallNegativeBarY)->toBeLessThan($mediumNegativeBarY);
});

it('coordinates multiple grouped bars with different value ranges', function () {
    $smallBar = new Bar(value: 50);
    $mediumBar = new Bar(value: 100);
    $largeBar = new Bar(value: 150);
    $extraLargeBar = new Bar(value: 200);

    $group1 = new BarGroup(name: 'Group 1', bars: [$smallBar, $mediumBar]);
    $group2 = new BarGroup(name: 'Group 2', bars: [$largeBar, $extraLargeBar]);

    $chart = new Chart(
        series: [new Bars(bars: [$group1, $group2])],
    );

    $smallBarY = $chart->yForAxis($smallBar->value);
    $mediumBarY = $chart->yForAxis($mediumBar->value);
    $largeBarY = $chart->yForAxis($largeBar->value);
    $extraLargeBarY = $chart->yForAxis($extraLargeBar->value);
    $zeroY = $chart->zeroLineY();

    expect($extraLargeBarY)->toBe($chart->top())
        ->and($zeroY)->toBe($chart->bottom())
        ->and($smallBarY)->toBeLessThan($zeroY)
        ->and($mediumBarY)->toBeLessThan($smallBarY)
        ->and($largeBarY)->toBeLessThan($mediumBarY)
        ->and($extraLargeBarY)->toBeLessThan($largeBarY);
});

it('handles empty grouped bar groups', function () {
    $emptyGroup = new BarGroup(name: 'Empty Group', bars: []);

    $chart = new Chart(
        yAxis: new YAxis(minValue: 0, maxValue: 1000),
        series: [new Bars(bars: [$emptyGroup])],
    );

    $svg = $chart->render();

    expect($svg)->toContain('Empty Group')
        ->and($svg)->toContain('xmlns="http://www.w3.org/2000/svg"');
});

it('handles zero-crossing grouped bar values', function () {
    $positiveBar = new Bar(value: 100, color: '#27ae60');
    $negativeBar = new Bar(value: -50, color: '#e74c3c');
    $zeroBar = new Bar(value: 0, color: '#3498db');

    $group = new BarGroup(
        name: 'Mixed Group',
        bars: [$positiveBar, $negativeBar, $zeroBar],
    );

    $chart = new Chart(
        series: [new Bars(bars: [$group])],
    );

    $positiveBarY = $chart->yForAxis($positiveBar->value);
    $negativeBarY = $chart->yForAxis($negativeBar->value);
    $zeroBarY = $chart->yForAxis($zeroBar->value);

    expect($positiveBarY)->toBe($chart->top())
        ->and($negativeBarY)->toBe($chart->bottom())
        ->and($zeroBarY)->toBe($chart->zeroLineY())
        ->and($chart->zeroLineY())->toBeGreaterThan($chart->top())
        ->and($chart->zeroLineY())->toBeLessThan($chart->bottom());
});

it('calculates correct positioning for multiple negative grouped bars', function () {
    $smallNegativeBar = new Bar(value: -100);
    $largeNegativeBar = new Bar(value: -200);

    $group = new BarGroup(
        name: 'Test',
        bars: [$smallNegativeBar, $largeNegativeBar],
    );

    $chart = new Chart(
        series: [new Bars(bars: [$group])],
    );

    $zeroY = $chart->zeroLineY();
    $neg100Y = $chart->yForAxis(-100);
    $neg200Y = $chart->yForAxis(-200);

    expect($neg100Y)->toBeGreaterThan($zeroY)
        ->and($neg200Y)->toBeGreaterThan($neg100Y)
        ->and($zeroY)->toBe($chart->top());
});
