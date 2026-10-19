<?php

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\BarGroup;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Boxplot\Boxplot;
use Maantje\Charts\Boxplot\Boxplots;
use Maantje\Charts\Chart;
use Maantje\Charts\YAxis;

function boxplotChart(Boxplot ...$boxplots): string
{
    return (new Chart(series: [new Boxplots(boxplots: $boxplots)]))->render();
}

it('exposes min and max including outliers', function () {
    $boxplot = new Boxplot(name: 'Jan', values: [20, 40, 50, 60, 80, 100, 10]);

    expect($boxplot->minValue())->toBe(10.0)
        ->and($boxplot->maxValue())->toBe(100.0);
});

it('reads values by position whatever the array keys', function () {
    $boxplot = new Boxplot(name: 'Jan', values: [3 => 20, 7 => 40, 'm' => 50, 9 => 60, 10 => 100]);

    expect($boxplot->values)->toBe([20, 40, 50, 60, 100]);
});

it('accepts equal values', function () {
    $boxplot = new Boxplot(name: 'Jan', values: [5, 5, 5, 5, 5]);

    expect($boxplot->minValue())->toBe(5.0)
        ->and($boxplot->maxValue())->toBe(5.0);
});

it('rejects fewer than five values', function () {
    new Boxplot(name: 'Jan', values: [1, 2, 3, 4]);
})->throws(
    InvalidArgumentException::class,
    'Boxplot "Jan" needs at least 5 values (min, Q1, median, Q3, max), 4 given.'
);

it('rejects unordered values', function () {
    new Boxplot(name: 'Jan', values: [20, 60, 50, 40, 100]);
})->throws(
    InvalidArgumentException::class,
    'Boxplot "Jan" values must be ordered: min <= Q1 <= median <= Q3 <= max.'
);

it('uses the median as its value', function () {
    expect((new Boxplot(name: 'Jan', values: [20, 40, 50, 60, 100]))->value())->toBe(50.0);
});

it('renders a flat box when all values are equal', function () {
    // max 5: left margin 50, width 720
    expect(boxplotChart(new Boxplot(name: 'Jan', values: [5, 5, 5, 5, 5])))
        ->toContain('<rect x="380" y="25" width="60" height="0"');
});

it('renders negative values on the default y axis', function () {
    // range -50..50: left margin 55, width 715; y(v) = 550 - 5.25 * (v + 50)
    expect(boxplotChart(new Boxplot(name: 'Jan', values: [-50, -20, 0, 20, 50])))
        ->toContain('<line x1="412.5" y1="550" x2="412.5" y2="25"')
        ->toContain('<rect x="382.5" y="182.5" width="60" height="210"');
});

it('renders a boxplot', function () {
    $svg = boxplotChart(new Boxplot(name: 'Jan', values: [20, 40, 50, 60, 100]));

    $whisker = '<line x1="415" y1="445" x2="415" y2="25" stroke="#333" stroke-dasharray="none" stroke-width="2" stroke-opacity="1.000000" />';
    $box = '<rect x="385" y="235" width="60" height="105" fill="#3498db" fill-opacity="1" stroke="#333" stroke-width="2" rx="0" ry="0"><title>20 / 40 / 50 / 60 / 100</title></rect>';

    expect($svg)
        ->toContain($whisker)
        ->toContain('<line x1="400" y1="445" x2="430" y2="445" stroke="#333" stroke-dasharray="none" stroke-width="2" stroke-opacity="1.000000" />')
        ->toContain('<line x1="400" y1="25" x2="430" y2="25" stroke="#333" stroke-dasharray="none" stroke-width="2" stroke-opacity="1.000000" />')
        ->toContain($box)
        ->toContain('<line x1="385" y1="287.5" x2="445" y2="287.5" stroke="#333" stroke-dasharray="none" stroke-width="2" stroke-opacity="1.000000" />')
        ->toContain('<text x="415" y="580" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">Jan</text>')
        ->and((int) strpos($svg, $whisker))->toBeLessThan((int) strpos($svg, $box));

    expect($svg)->not->toContain('<circle');
});

it('renders outliers as points and keeps them inside the scale', function () {
    $svg = boxplotChart(new Boxplot(name: 'Jan', values: [20, 40, 50, 60, 80, 100, 10]));

    expect($svg)
        ->toContain('<line x1="415" y1="445" x2="415" y2="130"')
        ->toContain('<circle cx="415" cy="25" r="4" fill="#333" stroke="none" stroke-width="0"><title>100</title></circle>')
        ->toContain('<circle cx="415" cy="497.5" r="4" fill="#333" stroke="none" stroke-width="0"><title>10</title></circle>')
        ->and(substr_count($svg, '<circle'))->toBe(2);
});

it('applies styling parameters', function () {
    $svg = boxplotChart(new Boxplot(
        name: 'Jan',
        values: [20, 40, 50, 60, 100, 10],
        color: 'black',
        strokeWidth: 3,
        fillColor: 'yellow',
        medianColor: 'red',
        outlierColor: 'green',
        outlierSize: 6,
        labelColor: 'blue',
        labelMarginY: 20,
    ));

    expect($svg)
        ->toContain('fill="yellow" fill-opacity="1" stroke="black" stroke-width="3"')
        ->toContain('<line x1="385" y1="287.5" x2="445" y2="287.5" stroke="red" stroke-dasharray="none" stroke-width="3" stroke-opacity="1.000000" />')
        ->toContain('<circle cx="415" cy="497.5" r="6" fill="green"')
        ->toContain('<text x="415" y="570" font-family="arial" font-size="14" fill="blue"');
});

it('uses the chart color for the label by default', function () {
    $chart = new Chart(
        color: 'white',
        series: [new Boxplots(boxplots: [new Boxplot(name: 'Jan', values: [20, 40, 50, 60, 100])])],
    );

    expect($chart->render())->toContain('font-size="14" fill="white" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">Jan</text>');
});

it('fills the slot when width is null and never exceeds it', function (?float $width) {
    $svg = boxplotChart(new Boxplot(name: 'Jan', values: [20, 40, 50, 60, 100], width: $width));

    expect($svg)->toContain('<rect x="60" y="235" width="710" height="105"');
})->with([[null], [5000.0]]);

it('omits the label when name is empty', function () {
    $svg = boxplotChart(new Boxplot(name: '', values: [20, 40, 50, 60, 100]));
    $median = '<line x1="385" y1="287.5" x2="445" y2="287.5" stroke="#333" stroke-dasharray="none" stroke-width="2" stroke-opacity="1.000000" />';

    expect($svg)->toContain($median)
        ->and(explode($median, $svg)[1])->not->toContain('<text');
});

it('escapes the label', function () {
    expect(boxplotChart(new Boxplot(name: '<b>"A&B"</b>', values: [20, 40, 50, 60, 100])))
        ->toContain('>&lt;b&gt;&quot;A&amp;B&quot;&lt;/b&gt;</text>');
});

it('renders on a named y axis', function () {
    $chart = new Chart(
        yAxis: [new YAxis(minValue: 0), new YAxis(name: 'right', minValue: 0, maxValue: 200)],
        series: [
            new Bars(bars: [new Bar(name: 'A', value: 100)]),
            new Boxplots(
                boxplots: [new Boxplot(name: '', values: [20, 40, 50, 60, 100], yAxis: 'right')],
                yAxis: 'right',
            ),
        ],
    );

    // two Y axes: left margin 110, width 660; y(v) = 550 - 2.625 * v
    expect($chart->render())->toContain('<rect x="410" y="392.5" width="60" height="52.5" fill="#3498db"');
});

it('aligns with bars slot by slot', function () {
    $chart = new Chart(
        series: [
            new Bars(bars: [new Bar(name: 'A', value: 100), new Bar(name: 'B', value: 50)]),
            new Boxplots(boxplots: [
                new Boxplot(name: '', values: [20, 40, 50, 60, 100]),
                new Boxplot(name: '', values: [10, 20, 30, 40, 50]),
            ]),
        ],
    );

    expect($chart->render())
        ->toContain('<text x="237.5" y="580"')
        ->toContain('<line x1="237.5" y1="445" x2="237.5" y2="25"')
        ->toContain('<text x="592.5" y="580"')
        ->toContain('<line x1="592.5" y1="497.5" x2="592.5" y2="287.5"');
});

it('can be placed in bars next to a bar', function () {
    $chart = new Chart(
        series: [
            new Bars(bars: [
                new Bar(name: 'A', value: 100),
                new Boxplot(name: 'B', values: [10, 20, 30, 40, 50]),
            ]),
        ],
    );

    expect($chart->render())
        ->toContain('<text x="237.5" y="580"')
        ->toContain('<text x="592.5" y="580"')
        ->toContain('<line x1="592.5" y1="497.5" x2="592.5" y2="287.5"');
});

it('keeps whiskers and outliers inside the scale in a bar group', function () {
    $group = new BarGroup(name: '2024', radius: 4, bars: [
        new Bar(value: 50),
        new Boxplot(name: '', values: [10, 30, 45, 60, 95, 140]),
    ]);

    expect($group->minValue())->toBe(10.0)
        ->and($group->maxValue())->toBe(140.0)
        ->and((new Chart(series: [new Bars(bars: [$group])]))->render())
        ->toContain('alignment-baseline="auto">140</text>');
});

it('rounds the box corners', function () {
    expect(boxplotChart(new Boxplot(name: 'Jan', values: [20, 40, 50, 60, 100], radius: 6)))
        ->toContain('<rect x="385" y="235" width="60" height="105" fill="#3498db" fill-opacity="1" stroke="#333" stroke-width="2" rx="6" ry="6">');
});

it('takes the radius of its bar group unless it has its own', function () {
    $own = new Boxplot(name: '', values: [10, 20, 30, 40, 50], radius: 2);
    $inherited = new Boxplot(name: '', values: [10, 20, 30, 40, 50]);

    new BarGroup(name: 'A', radius: 8, bars: [$own, $inherited]);

    expect($own->radius)->toBe(2)
        ->and($inherited->radius)->toBe(8);
});

it('aggregates min and max across boxplots', function () {
    $boxplots = new Boxplots(boxplots: [
        new Boxplot(name: 'A', values: [20, 40, 50, 60, 100]),
        new Boxplot(name: 'B', values: [10, 20, 30, 40, 50, 130]),
    ]);

    expect($boxplots->minValue())->toBe(10.0)
        ->and($boxplots->maxValue())->toBe(130.0);
});

it('renders nothing when empty', function () {
    expect((new Boxplots)->render(new Chart))->toBe('');
});

it('does not break a chart when empty', function () {
    expect((new Chart(series: [new Boxplots]))->render())->toContain('</svg>');

    $chart = new Chart(
        series: [
            new Bars(bars: [new Bar(name: 'A', value: 100)]),
            new Boxplots,
        ],
    );

    expect($chart->render())->toContain('<rect x="365" y="25" width="100" height="525" fill="#3498db"');
});

it('renders the full boxplot chart svg', function () {
    expect(boxplotChart(new Boxplot(name: 'Jan', values: [20, 40, 50, 60, 100])))->toBe(<<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
    <rect x="0" y="0" width="800" height="600" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0"/>
    <text x="50" y="555" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text><text x="50" y="450" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">20</text><text x="50" y="345" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">40</text><text x="50" y="240" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">60</text><text x="50" y="135" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">80</text><text x="50" y="30" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">100</text>
    <line x1="60" y1="550" x2="770" y2="550" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="1.000000" />
    <line x1="60" y1="445" x2="770" y2="445" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000" /><line x1="60" y1="340" x2="770" y2="340" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000" /><line x1="60" y1="235" x2="770" y2="235" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000" /><line x1="60" y1="130" x2="770" y2="130" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000" /><line x1="60" y1="25" x2="770" y2="25" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000" />
    
    <line x1="415" y1="445" x2="415" y2="25" stroke="#333" stroke-dasharray="none" stroke-width="2" stroke-opacity="1.000000" />
<line x1="400" y1="445" x2="430" y2="445" stroke="#333" stroke-dasharray="none" stroke-width="2" stroke-opacity="1.000000" />
<line x1="400" y1="25" x2="430" y2="25" stroke="#333" stroke-dasharray="none" stroke-width="2" stroke-opacity="1.000000" />
<rect x="385" y="235" width="60" height="105" fill="#3498db" fill-opacity="1" stroke="#333" stroke-width="2" rx="0" ry="0"><title>20 / 40 / 50 / 60 / 100</title></rect>
<line x1="385" y1="287.5" x2="445" y2="287.5" stroke="#333" stroke-dasharray="none" stroke-width="2" stroke-opacity="1.000000" />
<text x="415" y="580" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">Jan</text>
    
</svg>
SVG);
});
