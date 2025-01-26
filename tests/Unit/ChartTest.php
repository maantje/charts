<?php

use Maantje\Charts\Chart;

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
