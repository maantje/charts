<?php

use Maantje\Charts\Bar\Bar;
use Maantje\Charts\Bar\Bars;
use Maantje\Charts\Chart;

it('render bar chart', function () {

    $chart = new Chart(
        series: [
            new Bars(
                bars: [
                    new Bar(
                        name: 'Jan',
                        value: 222301,
                    ),
                    new Bar(
                        name: 'Feb',
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

    expect($chart->render())->toBe(<<<'SVG'
<svg width="800" height="600" viewBox="-20 -40 840 680" xmlns="http://www.w3.org/2000/svg">
    <rect width="100%" height="100%" x="-20" y="-40" fill="white" /> 
    <text x="35" y="605" font-family="arial" font-size="14" fill="black" text-anchor="end">0</text><text x="35" y="485" font-family="arial" font-size="14" fill="black" text-anchor="end">44,460</text><text x="35" y="365" font-family="arial" font-size="14" fill="black" text-anchor="end">88,920</text><text x="35" y="245" font-family="arial" font-size="14" fill="black" text-anchor="end">133,381</text><text x="35" y="125" font-family="arial" font-size="14" fill="black" text-anchor="end">177,841</text><text x="35" y="5" font-family="arial" font-size="14" fill="black" text-anchor="end">222,301</text><text text-anchor="middle" font-family="arial" alignment-baseline="middle" transform="rotate(270, 10, 300)" x="10" y="300" font-size="14" fill="black"></text>
    <line x1="45" y1="600" x2="800" y2="600" stroke="black"/>    <text x="422.5" y="630" font-family="arial" font-size="14" text-anchor="middle"></text>
    <line x1="45" y1="600" x2="800" y2="600" stroke="#ccc" stroke-width="1"/><line x1="45" y1="480" x2="800" y2="480" stroke="#ccc" stroke-width="1"/><line x1="45" y1="360" x2="800" y2="360" stroke="#ccc" stroke-width="1"/><line x1="45" y1="240" x2="800" y2="240" stroke="#ccc" stroke-width="1"/><line x1="45" y1="120" x2="800" y2="120" stroke="#ccc" stroke-width="1"/><line x1="45" y1="0" x2="800" y2="0" stroke="#ccc" stroke-width="1"/>
    
        <rect x="120.83333333333" y="0" width="100" height="600" fill="#3498db">
        <title>222301</title>
    </rect>
    <text x="170.83333333333" y="630" font-family="arial" font-size="14" fill="#333" text-anchor="middle">Jan</text>    <rect x="372.5" y="89.227668791413" width="100" height="510.77233120859" fill="#3498db">
        <title>189242</title>
    </rect>
    <text x="422.5" y="630" font-family="arial" font-size="14" fill="#333" text-anchor="middle">Feb</text>    <rect x="624.16666666667" y="208.84926293629" width="100" height="391.15073706371" fill="#3498db">
        <title>144922</title>
    </rect>
    <text x="674.16666666667" y="630" font-family="arial" font-size="14" fill="#333" text-anchor="middle">March</text>
    
</svg>
SVG
    );
});
