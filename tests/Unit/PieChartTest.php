<?php

use Maantje\Charts\Pie\PieChart;
use Maantje\Charts\Pie\Slice;

it('renders pie chart', function () {
    $chart = new PieChart(
        size: 500,
        slices: [
            new Slice(
                value: 14,
                color: '#5B9BD5',
                label: 'Toys',
                explodeDistance: 50,
            ),
            new Slice(
                value: 43,
                color: '#ED7D31',
                label: 'Furniture',
            ),
            new Slice(
                value: 15,
                color: '#A5A5A5',
                label: 'Home',
            ),
            new Slice(
                value: 28,
                color: '#FFC001',
                label: 'Electronics',
            ),
        ],
    );

    expect(pretty($chart->render()))->toBe(<<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500">
  <rect x="0" y="0" width="500" height="500" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
    <title/>
  </rect>
  <path d="M 295.2413526233,271.28896457825 L 495.2413526233,271.28896457825 A 200,200 0 0,1 422.72615057304,425.39161313341 Z" fill="#5B9BD5"/>
  <text x="415.88495961877" y="328.05953678693" font-family="arial" font-size="14" fill="#000" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="middle" alignment-baseline="auto">Toys - 14%</text>
  <path d="M 250,250 L 377.48479794974,404.10264855516 A 200,200 0 0,1 69.034589506796,164.84414168699 Z" fill="#ED7D31"/>
  <text x="168.27905951294" y="355.35400165009" font-family="arial" font-size="14" fill="#000" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="middle" alignment-baseline="auto">Furniture - 43%</text>
  <path d="M 250,250 L 69.034589506796,164.84414168699 A 200,200 0 0,1 212.52373708286,53.542549854262 Z" fill="#A5A5A5"/>
  <text x="168.27905951294" y="144.64599834991" font-family="arial" font-size="14" fill="#000" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="middle" alignment-baseline="auto">Home - 15%</text>
  <path d="M 250,250 L 212.52373708286,53.542549854262 A 200,200 0 0,1 450,250 Z" fill="#FFC001"/>
  <text x="334.98986529983" y="147.26490096323" font-family="arial" font-size="14" fill="#000" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="middle" alignment-baseline="auto">Electronics - 28%</text>
</svg>
SVG
    );
});

it('renders single slice', function () {
    $chart = new PieChart(
        size: 500,
        slices: [
            new Slice(
                value: 43,
                color: '#ED7D31',
                label: 'Furniture',
            ),
        ],
    );

    expect(pretty($chart->render()))->toBe(<<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500">
  <rect x="0" y="0" width="500" height="500" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
    <title/>
  </rect>
  <path d="M 250,250 m -250,0 a 250,250 0 1,0 500,0 a 250,250 0 1,0 -500,0 Z" fill="#ED7D31"/>
  <text x="250" y="125" font-family="arial" font-size="14" fill="#000" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="middle" alignment-baseline="auto">Furniture - 100%</text>
</svg>
SVG
    );
});

it('renders empty chart', function () {
    $chart = new PieChart(
        size: 500,
        slices: [],
    );

    expect(pretty($chart->render()))->toBe(<<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500">
  <rect x="0" y="0" width="500" height="500" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
    <title/>
  </rect>
</svg>
SVG
    );
});
