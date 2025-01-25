
<?php

use Maantje\Charts\Chart;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;

it('renders area line chart', function () {
    $chart = new Chart(
        series: [
            new Lines(
                lines: [
                    new Line(
                        points: [
                            new Point(y: 20, x: 0),
                            new Point(y: 35, x: 100),
                            new Point(y: 50, x: 200),
                            new Point(y: 30, x: 300),
                            new Point(y: 50, x: 400),
                            new Point(y: 45, x: 500),
                            new Point(y: 30, x: 600),
                        ],
                        color: 'rgb(75, 192, 192)',
                        areaColor: 'rgba(75, 192, 192, 0.3)',
                        curve: 8
                    ),

                    new Line(
                        points: [
                            new Point(y: 10, x: 0),
                            new Point(y: 20, x: 100),
                            new Point(y: 15, x: 200),
                            new Point(y: 25, x: 300),
                            new Point(y: 20, x: 400),
                            new Point(y: 35, x: 500),
                            new Point(y: 35, x: 600),
                        ],
                        color: 'rgb(255, 99, 132)',
                        areaColor: 'rgba(255, 99, 132, 0.3)',
                        stepLine: true
                    ),

                    new Line(
                        points: [
                            new Point(y: 10, x: 0),
                            new Point(y: 40, x: 100),
                            new Point(y: 20, x: 200),
                            new Point(y: 50, x: 300),
                            new Point(y: 30, x: 400),
                            new Point(y: 60, x: 500),
                            new Point(y: 40, x: 600),
                        ],
                        color: 'rgb(54, 162, 235)',
                        areaColor: 'rgba(54, 162, 235, 0.3)',
                    ),
                ]
            ),
        ]
    );

    expect(pretty($chart->render()))->toBe(<<<'SVG'
        <svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
          <rect x="0" y="0" width="800" height="600" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0"/>
          <text x="45" y="555" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
          <text x="45" y="450" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">12</text>
          <text x="45" y="345" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">24</text>
          <text x="45" y="240" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">36</text>
          <text x="45" y="135" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">48</text>
          <text x="45" y="30" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">60</text>
          <line x1="55" y1="550" x2="770" y2="550" stroke="black" stroke-dasharray="none" stroke-width="1"/>
          <text x="55" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
          <line x1="55" y1="550" x2="55" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1"/>
          <text x="174.16666666667" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">100</text>
          <line x1="174.16666666667" y1="550" x2="174.16666666667" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1"/>
          <text x="293.33333333333" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">200</text>
          <line x1="293.33333333333" y1="550" x2="293.33333333333" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1"/>
          <text x="412.5" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">300</text>
          <line x1="412.5" y1="550" x2="412.5" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1"/>
          <text x="531.66666666667" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">400</text>
          <line x1="531.66666666667" y1="550" x2="531.66666666667" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1"/>
          <text x="650.83333333333" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">500</text>
          <line x1="650.83333333333" y1="550" x2="650.83333333333" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1"/>
          <text x="770" y="575" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">600</text>
          <line x1="770" y1="550" x2="770" y2="545" stroke="black" stroke-dasharray="none" stroke-width="1"/>
          <line x1="55" y1="550" x2="770" y2="550" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
          <line x1="55" y1="445" x2="770" y2="445" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
          <line x1="55" y1="340" x2="770" y2="340" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
          <line x1="55" y1="235" x2="770" y2="235" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
          <line x1="55" y1="130" x2="770" y2="130" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
          <line x1="55" y1="25" x2="770" y2="25" stroke="#ccc" stroke-dasharray="none" stroke-width="1"/>
          <path d="M 55,375 C 69.90,358.59 144.38,276.56 174.17,243.75 C 203.96,210.94 263.54,107.03 293.33,112.50 C 323.13,117.97 382.71,287.50 412.50,287.50 C 442.29,287.50 501.88,128.91 531.67,112.50 C 561.46,96.09 621.04,134.38 650.83,156.25 C 680.62,178.12 755.10,271.09 770.00,287.50 L 770,550 L 55,550 Z" fill="rgba(75, 192, 192, 0.3)" stroke="none" stroke-width="0"/>
          <path d="M 55,375 C 69.90,358.59 144.38,276.56 174.17,243.75 C 203.96,210.94 263.54,107.03 293.33,112.50 C 323.13,117.97 382.71,287.50 412.50,287.50 C 442.29,287.50 501.88,128.91 531.67,112.50 C 561.46,96.09 621.04,134.38 650.83,156.25 C 680.62,178.12 755.10,271.09 770.00,287.50" fill="none" stroke="rgb(75, 192, 192)" stroke-width="5"/>
          <circle cx="55" cy="375" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>20</title>
          </circle>
          <circle cx="174.16666666667" cy="243.75" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>35</title>
          </circle>
          <circle cx="293.33333333333" cy="112.5" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>50</title>
          </circle>
          <circle cx="412.5" cy="287.5" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>30</title>
          </circle>
          <circle cx="531.66666666667" cy="112.5" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>50</title>
          </circle>
          <circle cx="650.83333333333" cy="156.25" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>45</title>
          </circle>
          <circle cx="770" cy="287.5" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>30</title>
          </circle>
          <path d="M 55,462.5 H 174.16666666667 V 375 H 293.33333333333 V 418.75 H 412.5 V 331.25 H 531.66666666667 V 375 H 650.83333333333 V 243.75 H 770 V 243.75 L 770,550 L 55,550 Z" fill="rgba(255, 99, 132, 0.3)" stroke="none" stroke-width="0"/>
          <path d="M 55,462.5 H 174.16666666667 V 375 H 293.33333333333 V 418.75 H 412.5 V 331.25 H 531.66666666667 V 375 H 650.83333333333 V 243.75 H 770 V 243.75" fill="none" stroke="rgb(255, 99, 132)" stroke-width="5"/>
          <circle cx="55" cy="462.5" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>10</title>
          </circle>
          <circle cx="174.16666666667" cy="375" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>20</title>
          </circle>
          <circle cx="293.33333333333" cy="418.75" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>15</title>
          </circle>
          <circle cx="412.5" cy="331.25" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>25</title>
          </circle>
          <circle cx="531.66666666667" cy="375" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>20</title>
          </circle>
          <circle cx="650.83333333333" cy="243.75" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>35</title>
          </circle>
          <circle cx="770" cy="243.75" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>35</title>
          </circle>
          <path d="M 55,462.5 L 174.16666666667,200 L 293.33333333333,375 L 412.5,112.5 L 531.66666666667,287.5 L 650.83333333333,25 L 770,200 L 770,550 L 55,550 Z" fill="rgba(54, 162, 235, 0.3)" stroke="none" stroke-width="0"/>
          <path d="M 55,462.5 L 174.16666666667,200 L 293.33333333333,375 L 412.5,112.5 L 531.66666666667,287.5 L 650.83333333333,25 L 770,200" fill="none" stroke="rgb(54, 162, 235)" stroke-width="5"/>
          <circle cx="55" cy="462.5" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>10</title>
          </circle>
          <circle cx="174.16666666667" cy="200" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>40</title>
          </circle>
          <circle cx="293.33333333333" cy="375" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>20</title>
          </circle>
          <circle cx="412.5" cy="112.5" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>50</title>
          </circle>
          <circle cx="531.66666666667" cy="287.5" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>30</title>
          </circle>
          <circle cx="650.83333333333" cy="25" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>60</title>
          </circle>
          <circle cx="770" cy="200" r="10" fill="transparent" stroke="none" stroke-width="0">
            <title>40</title>
          </circle>
        </svg>
        SVG
    );
});
