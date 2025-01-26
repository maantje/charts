<?php

use Maantje\Charts\Chart;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;

it('can render multiple times', function () {
    $chart = new Chart(
        series: [
            new Lines(
                lines: [
                    new Line(
                        points: [
                            new Point(x: 0, y: 0),
                            new Point(x: 100, y: 4),
                            new Point(x: 200, y: 12),
                            new Point(x: 300, y: 8),
                        ],
                    ),
                    new Line(
                        points: [
                            new Point(x: 0, y: 4),
                            new Point(x: 100, y: 12),
                            new Point(x: 200, y: 24),
                            new Point(x: 300, y: 7),
                        ],
                        color: 'blue'
                    ),
                ]
            ),
        ],
    );

    $chart->render();

    expect(pretty($chart->render()))->toBe(<<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
  <rect x="0" y="0" width="800" height="600" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0"/>
  <text x="45" y="555" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="45" y="450" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">5</text>
  <text x="45" y="345" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">10</text>
  <text x="45" y="240" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">14</text>
  <text x="45" y="135" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">19</text>
  <text x="45" y="30" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">24</text>
  <line x1="55" y1="550" x2="770" y2="550" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="1.000000"/>
  <text x="55" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <line x1="55" y1="550" x2="55" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="1.000000"/>
  <text x="293.33333333333" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">100</text>
  <line x1="293.33333333333" y1="550" x2="293.33333333333" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="1.000000"/>
  <text x="531.66666666667" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">200</text>
  <line x1="531.66666666667" y1="550" x2="531.66666666667" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="1.000000"/>
  <text x="770" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">300</text>
  <line x1="770" y1="550" x2="770" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="1.000000"/>
  <line x1="55" y1="445" x2="770" y2="445" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
  <line x1="55" y1="340" x2="770" y2="340" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
  <line x1="55" y1="235" x2="770" y2="235" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
  <line x1="55" y1="130" x2="770" y2="130" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
  <line x1="55" y1="25" x2="770" y2="25" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
  <path d="M 55,550 L 293.33333333333,462.5 L 531.66666666667,287.5 L 770,375" fill="none" stroke="black" stroke-width="5"/>
  <path d="M 55,462.5 L 293.33333333333,287.5 L 531.66666666667,25 L 770,396.875" fill="none" stroke="blue" stroke-width="5"/>
</svg>
SVG
    );
});
