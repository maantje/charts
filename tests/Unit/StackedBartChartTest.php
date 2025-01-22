<?php

use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Bar\Segment;
use Maantje\Charts\Bar\StackedBar;
use Maantje\Charts\Chart;

it('renders stacked bar chart', function () {
    $chart = new Chart(
        series: [
            new Bars(
                bars: [
                    new StackedBar(
                        name: 'January',
                        segments: [
                            new Segment(value: 40, color: 'green', labelColor: 'white'),
                            new Segment(value: 30, color: 'red', labelColor: 'white'),
                        ],
                    ),
                    new StackedBar(
                        name: 'February',
                        segments: [
                            new Segment(value: 40, color: 'green', labelColor: 'white'),
                            new Segment(value: 30, color: 'red', labelColor: 'white'),
                        ],
                        percentage: true,
                    ),
                ],
            ),
        ],
    );

    expect(pretty($chart->render()))
        ->toBe(<<<'SVG'
            <svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
              <rect x="0" y="0" width="800" height="600" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
                <title/>
              </rect>
              <text x="45" y="555" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
              <text x="45" y="450" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">14</text>
              <text x="45" y="345" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">28</text>
              <text x="45" y="240" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">42</text>
              <text x="45" y="135" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">56</text>
              <text x="45" y="30" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">70</text>
              <text x="20" y="262.5" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="middle" transform="rotate(270, 20, 262.5)"/>
              <line x1="55" y1="550" x2="770" y2="550" stroke="black" stroke-dasharray="none" stroke-width="1"/>
              <text x="412.5" y="590" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto"/>
              <line x1="55" y1="550" x2="770" y2="550" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
              <line x1="55" y1="445" x2="770" y2="445" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
              <line x1="55" y1="340" x2="770" y2="340" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
              <line x1="55" y1="235" x2="770" y2="235" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
              <line x1="55" y1="130" x2="770" y2="130" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
              <line x1="55" y1="25" x2="770" y2="25" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
              <rect x="183.75" y="250" width="100" height="300" fill="green" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
                <title>40</title>
              </rect>
              <text x="233.75" y="540" font-family="Arial" font-size="16" fill="white" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto"/>
              <rect x="183.75" y="25" width="100" height="225" fill="red" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
                <title>30</title>
              </rect>
              <text x="233.75" y="240" font-family="Arial" font-size="16" fill="white" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto"/>
              <text x="233.75" y="580" font-family="arial" font-size="14" fill="#333" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">January</text>
              <rect x="541.25" y="250" width="100" height="300" fill="green" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
                <title>40</title>
              </rect>
              <text x="591.25" y="540" font-family="Arial" font-size="16" fill="white" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">57%</text>
              <rect x="541.25" y="25" width="100" height="225" fill="red" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0">
                <title>30</title>
              </rect>
              <text x="591.25" y="240" font-family="Arial" font-size="16" fill="white" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">43%</text>
              <text x="591.25" y="580" font-family="arial" font-size="14" fill="#333" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">February</text>
            </svg>
            SVG
        );
});

it('renders empty stacked bar chart', function () {
    $chart = new Chart(
        series: [
            $bars = new Bars(
                bars: [
                    new StackedBar(
                        name: 'January',
                        segments: [],
                    ),
                ],
            ),
        ],
    );

    $svg = $chart->render();

    expect(pretty($svg))
        ->toBe(<<<'SVG'
            <svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
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
              <text x="410" y="580" font-family="arial" font-size="14" fill="#333" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">January</text>
            </svg>
            SVG
        );
});
