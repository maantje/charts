<?php

use Maantje\Charts\Chart;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;

it('renders line chart', function () {
    $chart = new Chart(
        series: [
            new Lines(
                lines: [
                    new Line(
                        points: [
                            new Point(y: 0, x: 0),
                            new Point(y: 4, x: 100),
                            new Point(y: 12, x: 200),
                            new Point(y: 8, x: 300),
                        ],
                    ),
                    new Line(
                        points: [
                            new Point(y: 4, x: 0),
                            new Point(y: 12, x: 100),
                            new Point(y: 24, x: 200),
                            new Point(y: 7, x: 300),
                        ],
                        lineColor: 'blue'
                    ),
                ]
            ),
        ],
    );

    expect(pretty($chart->render()))->toBe(<<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600">
  <rect x="0" y="0" width="800" height="600" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
    <title/>
  </rect>
  <text x="45" y="555" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="45" y="450" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">5</text>
  <text x="45" y="345" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">10</text>
  <text x="45" y="240" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">14</text>
  <text x="45" y="135" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">19</text>
  <text x="45" y="30" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">24</text>
  <text x="20" y="262.5" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="middle" transform="rotate(270, 20, 262.5)"/>
  <line x1="55" y1="550" x2="770" y2="550" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="55" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <line x1="55" y1="550" x2="55" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="293.33333333333" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">100</text>
  <line x1="293.33333333333" y1="550" x2="293.33333333333" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="531.66666666667" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">200</text>
  <line x1="531.66666666667" y1="550" x2="531.66666666667" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="770" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">300</text>
  <line x1="770" y1="550" x2="770" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="412.5" y="590" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto"/>
  <line x1="55" y1="550" x2="770" y2="550" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="55" y1="445" x2="770" y2="445" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="55" y1="340" x2="770" y2="340" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="55" y1="235" x2="770" y2="235" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="55" y1="130" x2="770" y2="130" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="55" y1="25" x2="770" y2="25" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <path d="M 55,550 L 293.33333333333,462.5 L 531.66666666667,287.5 L 770,375" fill="none" stroke="black" stroke-width="5"/>
  <circle cx="55" cy="550" r="10" fill="rgba(0, 0, 0, 0)" stroke="none" stroke-width="0">
    <title>0</title>
  </circle>
  <circle cx="293.33333333333" cy="462.5" r="10" fill="rgba(0, 0, 0, 0)" stroke="none" stroke-width="0">
    <title>4</title>
  </circle>
  <circle cx="531.66666666667" cy="287.5" r="10" fill="rgba(0, 0, 0, 0)" stroke="none" stroke-width="0">
    <title>12</title>
  </circle>
  <circle cx="770" cy="375" r="10" fill="rgba(0, 0, 0, 0)" stroke="none" stroke-width="0">
    <title>8</title>
  </circle>
  <path d="M 55,462.5 L 293.33333333333,287.5 L 531.66666666667,25 L 770,396.875" fill="none" stroke="blue" stroke-width="5"/>
  <circle cx="55" cy="462.5" r="10" fill="rgba(0, 0, 0, 0)" stroke="none" stroke-width="0">
    <title>4</title>
  </circle>
  <circle cx="293.33333333333" cy="287.5" r="10" fill="rgba(0, 0, 0, 0)" stroke="none" stroke-width="0">
    <title>12</title>
  </circle>
  <circle cx="531.66666666667" cy="25" r="10" fill="rgba(0, 0, 0, 0)" stroke="none" stroke-width="0">
    <title>24</title>
  </circle>
  <circle cx="770" cy="396.875" r="10" fill="rgba(0, 0, 0, 0)" stroke="none" stroke-width="0">
    <title>7</title>
  </circle>
</svg>
SVG
    );
});

it('renders empty line chart', function () {
    $chart = new Chart(
        series: [
            new Lines(
                lines: []
            ),
        ],
    );

    $svg = <<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600">
  <rect x="0" y="0" width="800" height="600" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
    <title/>
  </rect>
  <text x="40" y="555" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="40" y="450" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="40" y="345" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="40" y="240" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="40" y="135" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="40" y="30" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="20" y="262.5" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="middle" transform="rotate(270, 20, 262.5)"/>
  <line x1="50" y1="550" x2="770" y2="550" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="410" y="590" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto"/>
  <line x1="50" y1="550" x2="770" y2="550" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="50" y1="445" x2="770" y2="445" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="50" y1="340" x2="770" y2="340" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="50" y1="235" x2="770" y2="235" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="50" y1="130" x2="770" y2="130" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="50" y1="25" x2="770" y2="25" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
</svg>
SVG;

    expect(pretty($chart->render()))->toBe($svg);
});
