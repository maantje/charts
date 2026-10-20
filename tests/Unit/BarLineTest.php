<?php

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\BarGroup;
use Maantje\Charts\Bar\BarLine;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Bar\Segment;
use Maantje\Charts\Bar\StackedBar;
use Maantje\Charts\Boxplot\Boxplot;
use Maantje\Charts\Boxplot\Boxplots;
use Maantje\Charts\Chart;
use Maantje\Charts\YAxis;

function barLineBars(): Bars
{
    return new Bars(bars: [
        new Bar(name: 'A', value: 40),
        new Bar(name: 'B', value: 70),
        new Bar(name: 'C', value: 55),
        new Bar(name: 'D', value: 90),
    ]);
}

/**
 * The x of each bar label, rounded so float noise does not matter.
 *
 * @return string[]
 */
function labelXs(string $svg): array
{
    preg_match_all('/<text x="([\d.]+)" y="580"/', $svg, $matches);

    return array_map(fn (string $x) => number_format((float) $x, 6), $matches[1]);
}

/**
 * @return string[]
 */
function circleXs(string $svg): array
{
    preg_match_all('/<circle cx="([\d.]+)"/', $svg, $matches);

    return array_map(fn (string $x) => number_format((float) $x, 6), $matches[1]);
}

it('places a point on the centre of each bar kind', function (Bars $bars) {
    $svg = (new Chart(series: [$bars, new BarLine(bars: $bars, values: [40, 60], pointColor: 'red')]))->render();

    expect(circleXs($svg))->toBe(labelXs($svg));
})->with([
    'bars' => fn () => new Bars(bars: [new Bar(name: 'A', value: 40), new Bar(name: 'B', value: 70)]),
    'stacked bars' => fn () => new Bars(bars: [
        new StackedBar(name: 'A', segments: [new Segment(value: 20, color: 'red'), new Segment(value: 30, color: 'blue')]),
        new StackedBar(name: 'B', segments: [new Segment(value: 40, color: 'red'), new Segment(value: 10, color: 'blue')]),
    ]),
    'bar groups' => fn () => new Bars(bars: [
        new BarGroup(name: 'A', bars: [new Bar(value: 40), new Bar(value: 55)]),
        new BarGroup(name: 'B', bars: [new Bar(value: 60), new Bar(value: 45)]),
    ]),
    'boxplots' => fn () => new Boxplots(boxplots: [
        new Boxplot(name: 'A', values: [10, 30, 45, 60, 90]),
        new Boxplot(name: 'B', values: [20, 35, 50, 70, 95]),
    ]),
]);

it('uses the value of each bar by default', function () {
    $bars = new Boxplots(boxplots: [
        new Boxplot(name: 'A', values: [10, 30, 45, 60, 90]),
        new Boxplot(name: 'B', values: [20, 35, 50, 70, 95]),
    ]);

    expect((new BarLine(bars: $bars))->values())->toBe([45.0, 50.0]);
});

it('leaves a gap for null values', function () {
    $bars = barLineBars();
    $svg = (new Chart(series: [$bars, new BarLine(bars: $bars, values: [40, 70, null, 90], color: 'red', pointColor: 'red')]))->render();

    $centers = labelXs($svg);

    expect(circleXs($svg))->toBe([$centers[0], $centers[1], $centers[3]])
        ->and(substr_count($svg, 'stroke="red"'))->toBe(1);
});

it('covers only some of the bars', function () {
    $bars = barLineBars();
    $svg = (new Chart(series: [$bars, new BarLine(bars: $bars, values: [null, 70, 55], pointColor: 'red')]))->render();

    $centers = labelXs($svg);

    expect(circleXs($svg))->toBe([$centers[1], $centers[2]]);
});

it('ignores values beyond the last bar', function () {
    expect((new BarLine(bars: barLineBars(), values: [1, 2, 3, 4, 5, 6]))->values())->toBe([1, 2, 3, 4]);
});

it('takes part in the y axis range', function () {
    $bars = barLineBars();
    $line = new BarLine(bars: $bars, values: [-20, 150]);

    $chart = new Chart(series: [$bars, $line]);

    expect($line->minValue())->toBe(-20.0)
        ->and($line->maxValue())->toBe(150.0)
        ->and($chart->minValue())->toBe(-20.0)
        ->and($chart->maxValue())->toBe(150.0);
});

it('uses the y axis of its bars unless given one', function () {
    $bars = new Bars(bars: [new Bar(name: 'A', value: 40, yAxis: 'right')], yAxis: 'right');

    expect((new BarLine(bars: $bars))->yAxis)->toBe('right')
        ->and((new BarLine(bars: $bars, yAxis: 'other'))->yAxis)->toBe('other');
});

it('renders on its own y axis', function () {
    $bars = barLineBars();
    $chart = new Chart(
        yAxis: [new YAxis, new YAxis(name: 'right', minValue: 0, maxValue: 1000)],
        series: [$bars, new BarLine(bars: $bars, values: [500], yAxis: 'right', pointColor: 'red')],
    );

    // two Y axes: halfway up the right axis is halfway up the chart
    expect($chart->render())->toContain('cy="287.5"');
});

it('applies line options', function () {
    $bars = barLineBars();
    $svg = (new Chart(series: [$bars, new BarLine(
        bars: $bars,
        values: [40, 70, 55, 90],
        size: 3,
        color: 'red',
        areaColor: 'pink',
        stepLine: true,
    )]))->render();

    expect($svg)->toContain('fill="pink"')
        ->toContain('stroke="red" stroke-width="3"')
        ->toMatch('/<path d="M [\d.]+,[\d.]+ H [\d.]+ V/');
});

it('renders nothing for empty bars', function () {
    $bars = new Bars;

    expect((new BarLine(bars: $bars, values: [1, 2]))->render(new Chart(series: [$bars])))->toBe('');
});
