<?php

use Maantje\Charts\Chart;
use Maantje\Charts\Line\Line;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;

it('render line chart', function () {
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

    expect($chart->render())->toBe(<<<'SVG'
<svg width="800" height="600" viewBox="-20 -40 840 680" xmlns="http://www.w3.org/2000/svg">
    <rect width="100%" height="100%" x="-20" y="-40" fill="white" /> 
    <text x="10" y="605" font-family="arial" font-size="14" fill="black" text-anchor="end">0</text><text x="10" y="485" font-family="arial" font-size="14" fill="black" text-anchor="end">5</text><text x="10" y="365" font-family="arial" font-size="14" fill="black" text-anchor="end">10</text><text x="10" y="245" font-family="arial" font-size="14" fill="black" text-anchor="end">14</text><text x="10" y="125" font-family="arial" font-size="14" fill="black" text-anchor="end">19</text><text x="10" y="5" font-family="arial" font-size="14" fill="black" text-anchor="end">24</text><text text-anchor="middle" font-family="arial" alignment-baseline="middle" transform="rotate(270, 10, 300)" x="10" y="300" font-size="14" fill="black"></text>
    <line x1="20" y1="600" x2="800" y2="600" stroke="black"/><text x="20" y="625" font-family="arial" font-size="14" text-anchor="middle">0</text>
<line x1="20" x2="20"  y1="600" y2="595" stroke="black"/>
<text x="280" y="625" font-family="arial" font-size="14" text-anchor="middle">100</text>
<line x1="280" x2="280"  y1="600" y2="595" stroke="black"/>
<text x="540" y="625" font-family="arial" font-size="14" text-anchor="middle">200</text>
<line x1="540" x2="540"  y1="600" y2="595" stroke="black"/>
<text x="800" y="625" font-family="arial" font-size="14" text-anchor="middle">300</text>
<line x1="800" x2="800"  y1="600" y2="595" stroke="black"/>
    <text x="410" y="630" font-family="arial" font-size="14" text-anchor="middle"></text>
    <line x1="20" y1="600" x2="800" y2="600" stroke="#ccc" stroke-width="1"/><line x1="20" y1="480" x2="800" y2="480" stroke="#ccc" stroke-width="1"/><line x1="20" y1="360" x2="800" y2="360" stroke="#ccc" stroke-width="1"/><line x1="20" y1="240" x2="800" y2="240" stroke="#ccc" stroke-width="1"/><line x1="20" y1="120" x2="800" y2="120" stroke="#ccc" stroke-width="1"/><line x1="20" y1="0" x2="800" y2="0" stroke="#ccc" stroke-width="1"/>
    
        <polygon points="20,600 280,500 540,300 800,400 800,600 20,600 20,0" fill="rgba(0, 0, 0, 0)" stroke="none"/>
    <polyline points="20,600 280,500 540,300 800,400" fill="none" stroke="black" stroke-width="5"/>
        <circle cx="20" cy="600" r="0" fill="#000" />    <circle cx="280" cy="500" r="0" fill="#000" />    <circle cx="540" cy="300" r="0" fill="#000" />    <circle cx="800" cy="400" r="0" fill="#000" />    <polygon points="20,500 280,300 540,0 800,425 800,600 20,600 20,100" fill="rgba(0, 0, 0, 0)" stroke="none"/>
    <polyline points="20,500 280,300 540,0 800,425" fill="none" stroke="blue" stroke-width="5"/>
        <circle cx="20" cy="500" r="0" fill="#000" />    <circle cx="280" cy="300" r="0" fill="#000" />    <circle cx="540" cy="0" r="0" fill="#000" />    <circle cx="800" cy="425" r="0" fill="#000" />
    
</svg>
SVG
    );
});
