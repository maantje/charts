<?php

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Chart;
use Maantje\Charts\YAxis;

it('renders empty chart', function () {
    $chart = new Chart;

    expect(pretty($chart->render()))->toBe(<<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
  <rect x="0" y="0" width="800" height="600" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0"/>
  <text x="40" y="555" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="40" y="450" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="40" y="345" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="40" y="240" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="40" y="135" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="40" y="30" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <line x1="50" y1="550" x2="770" y2="550" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="1.000000"/>
  <line x1="50" y1="445" x2="770" y2="445" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
  <line x1="50" y1="340" x2="770" y2="340" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
  <line x1="50" y1="235" x2="770" y2="235" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
  <line x1="50" y1="130" x2="770" y2="130" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
  <line x1="50" y1="25" x2="770" y2="25" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
</svg>
SVG
    );
});

it('calculates zeroLineY for negative scenarios', function () {
    $positiveChart = new Chart(
        series: [
            new Bars(
                bars: [
                    new Bar(name: 'A', value: 100),
                    new Bar(name: 'B', value: 200),
                ],
            ),
        ],
    );

    $positiveZeroY = $positiveChart->zeroLineY();
    expect($positiveZeroY)->toBe($positiveChart->bottom());

    $negativeChart = new Chart(
        series: [
            new Bars(
                bars: [
                    new Bar(name: 'A', value: -100),
                    new Bar(name: 'B', value: -200),
                ],
            ),
        ],
    );

    $negativeZeroY = $negativeChart->zeroLineY();
    expect($negativeZeroY)->toBe($negativeChart->top());

    $mixedChart = new Chart(
        series: [
            new Bars(
                bars: [
                    new Bar(name: 'A', value: 100),
                    new Bar(name: 'B', value: -100),
                ],
            ),
        ],
    );

    $mixedZeroY = $mixedChart->zeroLineY();
    expect($mixedZeroY)->toBeLessThan($positiveZeroY)
        ->and($mixedZeroY)->toBeGreaterThan($negativeZeroY);
});

it('calculates yForAxis for negatives', function () {
    $chart = new Chart(
        series: [
            new Bars(
                bars: [
                    new Bar(name: 'A', value: 100),
                    new Bar(name: 'B', value: -100),
                ],
            ),
        ],
    );

    $zeroY = $chart->zeroLineY();
    $positiveY = $chart->yForAxis(100);
    $negativeY = $chart->yForAxis(-100);

    expect($positiveY)->toBeLessThan($zeroY)
        ->and($negativeY)->toBeGreaterThan($zeroY);
});

it('handles zero in negative context', function () {
    $chart = new Chart(
        series: [
            new Bars(
                bars: [
                    new Bar(name: 'Zero', value: 0),
                    new Bar(name: 'Negative', value: -100),
                ],
            ),
        ],
    );

    $zeroY = $chart->zeroLineY();
    $zeroValueY = $chart->yForAxis(0);
    $negativeY = $chart->yForAxis(-100);

    expect($zeroValueY)->toBe($zeroY)
        ->and($negativeY)->toBeGreaterThan($zeroY);
});

it('renders negatives with maxValue 0', function () {
    $chart = new Chart(
        yAxis: new YAxis(maxValue: 0),
        series: [
            new Bars(
                bars: [
                    new Bar(name: 'A', value: -50),
                    new Bar(name: 'B', value: -100),
                ],
            ),
        ],
    );

    $svg = $chart->render();
    $zeroY = $chart->zeroLineY();

    expect($zeroY)->toBe($chart->top());
});
