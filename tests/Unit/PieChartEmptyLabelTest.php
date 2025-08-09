<?php

use Maantje\Charts\Pie\PieChart;
use Maantje\Charts\Pie\Slice;

it('renders pie chart with empty label without dash', function () {
    $chart = new PieChart(
        size: 500,
        slices: [
            new Slice(
                value: 100,
                color: '#5B9BD5',
                label: '',
            ),
        ],
    );

    $rendered = $chart->render();

    expect($rendered)->toContain('100%');
    expect($rendered)->not->toContain('- 100%');
});

it('renders pie chart with whitespace-only label without dash', function () {
    $chart = new PieChart(
        size: 500,
        slices: [
            new Slice(
                value: 100,
                color: '#5B9BD5',
                label: '   ',
            ),
        ],
    );

    $rendered = $chart->render();

    expect($rendered)->toContain('100%');
    expect($rendered)->not->toContain('- 100%');
});

it('renders pie chart with label including dash', function () {
    $chart = new PieChart(
        size: 500,
        slices: [
            new Slice(
                value: 100,
                color: '#5B9BD5',
                label: 'Test',
            ),
        ],
    );

    $rendered = $chart->render();

    expect($rendered)->toContain('Test - 100%');
});
