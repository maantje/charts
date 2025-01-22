<?php

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\BarGroup;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Chart;
use Maantje\Charts\YAxis;

it('renders grouped bar chart', function () {
    $chart = new Chart(
        yAxis: new YAxis(
            minValue: 0,
            maxValue: 1000,
        ),
        series: [
            new Bars(
                bars: [
                    new BarGroup(
                        name: 'January',
                        bars: [
                            new Bar(
                                value: 101,
                                color: '#1E90FF',
                            ),
                            new Bar(
                                value: 251,
                                color: '#32CD32',
                            ),
                            new Bar(
                                value: 389,
                                color: '#FFA500',
                            ),
                            new Bar(
                                value: 457,
                                color: '#FFD700',
                            ),
                            new Bar(
                                value: 601,
                                color: '#FF4500',
                            ),
                        ],
                        radius: 10,
                    ),
                    new BarGroup(
                        name: 'February',
                        bars: [
                            new Bar(
                                value: 73,
                                color: '#1E90FF',
                                radius: 10,
                            ),
                            new Bar(
                                value: 223,
                                color: '#32CD32',
                                radius: 10,
                            ),
                            new Bar(
                                value: 347,
                                color: '#FFA500',
                                radius: 10,
                            ),
                            new Bar(
                                value: 509,
                                color: '#FFD700',
                                radius: 10,
                            ),
                            new Bar(
                                value: 653,
                                color: '#FF4500',
                                radius: 10,
                            ),
                        ],
                    ),
                    new BarGroup(
                        name: 'March',
                        bars: [
                            new Bar(
                                value: 113,
                                color: '#1E90FF',
                                radius: 10,
                            ),
                            new Bar(
                                value: 281,
                                color: '#32CD32',
                                radius: 10,
                            ),
                            new Bar(
                                value: 401,
                                color: '#FFA500',
                                radius: 10,
                            ),
                            new Bar(
                                value: 541,
                                color: '#FFD700',
                                radius: 10,
                            ),
                            new Bar(
                                value: 733,
                                color: '#FF4500',
                                radius: 10,
                            ),
                        ],
                    ),
                ],
            ),
        ],
    );

    echo $chart->render();

    expect(pretty($chart->render()))->toBe(<<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
  <rect x="0" y="0" width="800" height="600" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
    <title/>
  </rect>
  <text x="120" y="555" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="120" y="450" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">200</text>
  <text x="120" y="345" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">400</text>
  <text x="120" y="240" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">600</text>
  <text x="120" y="135" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">800</text>
  <text x="120" y="30" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">1,000</text>
  <text x="80" y="262.5" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="middle" transform="rotate(270, 80, 262.5)"/>
  <line x1="130" y1="550" x2="770" y2="550" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="450" y="590" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto"/>
  <line x1="130" y1="550" x2="770" y2="550" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="130" y1="445" x2="770" y2="445" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="130" y1="340" x2="770" y2="340" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="130" y1="235" x2="770" y2="235" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="130" y1="130" x2="770" y2="130" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="130" y1="25" x2="770" y2="25" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="130" y1="550" x2="130" y2="560" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <rect x="179.16666666667" y="496.975" width="20" height="53.025" fill="#1E90FF" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>101</title>
  </rect>
  <rect x="204.16666666667" y="418.225" width="20" height="131.775" fill="#32CD32" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>251</title>
  </rect>
  <rect x="229.16666666667" y="345.775" width="20" height="204.225" fill="#FFA500" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>389</title>
  </rect>
  <rect x="254.16666666667" y="310.075" width="20" height="239.925" fill="#FFD700" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>457</title>
  </rect>
  <rect x="279.16666666667" y="234.475" width="20" height="315.525" fill="#FF4500" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>601</title>
  </rect>
  <line x1="343.33333333333" y1="550" x2="343.33333333333" y2="560" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="236.66666666667" y="580" font-family="arial" font-size="14" fill="#333" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">January</text>
  <line x1="343.33333333333" y1="550" x2="343.33333333333" y2="560" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <rect x="392.5" y="511.675" width="20" height="38.325" fill="#1E90FF" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>73</title>
  </rect>
  <rect x="417.5" y="432.925" width="20" height="117.075" fill="#32CD32" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>223</title>
  </rect>
  <rect x="442.5" y="367.825" width="20" height="182.175" fill="#FFA500" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>347</title>
  </rect>
  <rect x="467.5" y="282.775" width="20" height="267.225" fill="#FFD700" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>509</title>
  </rect>
  <rect x="492.5" y="207.175" width="20" height="342.825" fill="#FF4500" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>653</title>
  </rect>
  <line x1="556.66666666667" y1="550" x2="556.66666666667" y2="560" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="450" y="580" font-family="arial" font-size="14" fill="#333" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">February</text>
  <line x1="556.66666666667" y1="550" x2="556.66666666667" y2="560" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <rect x="605.83333333333" y="490.675" width="20" height="59.325" fill="#1E90FF" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>113</title>
  </rect>
  <rect x="630.83333333333" y="402.475" width="20" height="147.525" fill="#32CD32" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>281</title>
  </rect>
  <rect x="655.83333333333" y="339.475" width="20" height="210.525" fill="#FFA500" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>401</title>
  </rect>
  <rect x="680.83333333333" y="265.975" width="20" height="284.025" fill="#FFD700" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>541</title>
  </rect>
  <rect x="705.83333333333" y="165.175" width="20" height="384.825" fill="#FF4500" fill-opacity="1" stroke="none" stroke-width="0" rx="10" ry="10">
    <title>733</title>
  </rect>
  <line x1="770" y1="550" x2="770" y2="560" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="663.33333333333" y="580" font-family="arial" font-size="14" fill="#333" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">March</text>
</svg>
SVG
    );
});

it('renders empty grouped bar chart', function () {
    $chart = new Chart(
        yAxis: new YAxis(
            minValue: 0,
            maxValue: 1000,
        ),
        series: [
            new Bars(
                bars: [
                    new BarGroup(
                        name: 'January',
                        bars: [],
                    ),
                ],
            ),
        ],
    );

    expect(pretty($chart->render()))->toBe(<<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
  <rect x="0" y="0" width="800" height="600" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
    <title/>
  </rect>
  <text x="60" y="555" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
  <text x="60" y="450" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">200</text>
  <text x="60" y="345" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">400</text>
  <text x="60" y="240" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">600</text>
  <text x="60" y="135" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">800</text>
  <text x="60" y="30" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">1,000</text>
  <text x="20" y="262.5" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="middle" transform="rotate(270, 20, 262.5)"/>
  <line x1="70" y1="550" x2="770" y2="550" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="420" y="590" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto"/>
  <line x1="70" y1="550" x2="770" y2="550" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="70" y1="445" x2="770" y2="445" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="70" y1="340" x2="770" y2="340" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="70" y1="235" x2="770" y2="235" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="70" y1="130" x2="770" y2="130" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="70" y1="25" x2="770" y2="25" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
  <line x1="70" y1="550" x2="70" y2="560" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <line x1="770" y1="550" x2="770" y2="560" stroke="black" stroke-dasharray="none" stroke-width="1"/>
  <text x="420" y="580" font-family="arial" font-size="14" fill="#333" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">January</text>
</svg>
SVG
    );
});
