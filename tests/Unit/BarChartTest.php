<?php

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Chart;

it('renders bar chart', function () {
    $chart = new Chart(
        series: [
            new Bars(
                bars: [
                    new Bar(
                        name: 'January',
                        value: 222301,
                    ),
                    new Bar(
                        name: 'February',
                        value: 189242,
                    ),
                    new Bar(
                        name: 'March',
                        value: 144922,
                    ),
                ],
            ),
        ],
    );

    expect(pretty($chart->render()))->toBe(<<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600">
  <rect x="0" y="0" width="800" height="600" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
    <title/>
  </rect>
  <text x="70" y="555" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="70" y="450" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">44,460</text>
  <text x="70" y="345" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">88,920</text>
  <text x="70" y="240" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">133,381</text>
  <text x="70" y="135" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">177,841</text>
  <text x="70" y="30" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">222,301</text>
  <text x="20" y="262.5" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="middle" transform="rotate(270, 20, 262.5)"/>
  <line x1="80" y1="550" x2="770" y2="550" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="425" y="590" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto"/>
  <line x1="80" y1="550" x2="770" y2="550" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="80" y1="445" x2="770" y2="445" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="80" y1="340" x2="770" y2="340" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="80" y1="235" x2="770" y2="235" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="80" y1="130" x2="770" y2="130" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="80" y1="25" x2="770" y2="25" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <rect x="145" y="25" width="100" height="525" fill="#3498db" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
    <title>222301</title>
  </rect>
  <text x="195" y="580" font-family="arial" font-size="14" fill="#333" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">January</text>
  <rect x="375" y="103.07421019249" width="100" height="446.92578980751" fill="#3498db" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
    <title>189242</title>
  </rect>
  <text x="425" y="580" font-family="arial" font-size="14" fill="#333" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">February</text>
  <rect x="605" y="207.74310506925" width="100" height="342.25689493075" fill="#3498db" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
    <title>144922</title>
  </rect>
  <text x="655" y="580" font-family="arial" font-size="14" fill="#333" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">March</text>
</svg>
SVG
    );
});

it('renders empty chart', function () {
    $chart = new Chart(
        series: [
            new Bars(
                bars: [],
            ),
        ],
    );

    expect(pretty($chart->render()))->toBe(<<<'SVG'
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
SVG
    );
});
