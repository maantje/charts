<?php

use Maantje\Charts\Annotations\PointAnnotation;
use Maantje\Charts\Annotations\XAxis\XAxisRangeAnnotation;
use Maantje\Charts\Annotations\YAxis\YAxisLineAnnotation;
use Maantje\Charts\Chart;
use Maantje\Charts\Formatter;
use Maantje\Charts\XAxis;
use Maantje\Charts\YAxis;

it('renders annotations', function () {
    $chart = new Chart(
        yAxis: new YAxis(
            minValue: 0,
            maxValue: 100,
            annotations: [
                new PointAnnotation(
                    x: 0,
                    y: 0,
                    markerSize: 10,
                    markerBackgroundColor: 'white',
                    markerBorderColor: 'red',
                    markerBorderWidth: 4,
                    label: 'Point 1',
                ),
                new YAxisLineAnnotation(
                    y: 50,
                    color: 'blue',
                    size: 3,
                    label: 'Y Axis annotation',
                    labelColor: 'white',
                ),
            ],
            formatter: Formatter::number('nl_NL', 2)
        ),
        xAxis: new XAxis(
            minValue: 0,
            maxValue: 100,
            annotations: [
                new XAxisRangeAnnotation(
                    x1: 50,
                    x2: 100,
                    color: 'pink',
                    label: 'X Axis range annotation'
                ),
            ],
        ),
        series: []
    );

    expect(pretty($chart->render()))
        ->toBe(<<<'SVG'
            <svg xmlns="http://www.w3.org/2000/svg" width="800" height="600" viewBox="0 0 800 600">
              <rect x="0" y="0" width="800" height="600" fill="white" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0"/>
              <text x="50" y="555" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">0</text>
              <text x="50" y="450" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">20</text>
              <text x="50" y="345" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">40</text>
              <text x="50" y="240" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">60</text>
              <text x="50" y="135" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">80</text>
              <text x="50" y="30" font-family="arial" font-size="14" fill="black" stroke="none" stroke-width="0" text-anchor="end" dominant-baseline="alphabetic" alignment-baseline="auto">100</text>
              <line x1="60" y1="550" x2="770" y2="550" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="1.000000"/>
              <line x1="60" y1="445" x2="770" y2="445" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
              <line x1="60" y1="340" x2="770" y2="340" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
              <line x1="60" y1="235" x2="770" y2="235" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
              <line x1="60" y1="130" x2="770" y2="130" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
              <line x1="60" y1="25" x2="770" y2="25" stroke="black" stroke-dasharray="none" stroke-width="1" stroke-opacity="0.200000"/>
              <circle cx="60" cy="550" r="10" fill="white" stroke="red" stroke-width="4">
                <title>0</title>
              </circle>
              <rect x="27.727272727273" y="502.63636363636" width="64.545454545455" height="22" fill="red" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0"/>
              <text x="60" y="520" font-family="arial" font-size="14" fill="white" stroke="none" stroke-width="0" text-anchor="middle" dominant-baseline="alphabetic" alignment-baseline="auto">Point 1</text>
              <line x1="60" y1="287.5" x2="770" y2="287.5" stroke="blue" stroke-dasharray="none" stroke-width="3" stroke-opacity="1.000000"/>
              <rect x="60" y="262.13636363636" width="128.18181818182" height="22" fill="blue" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0"/>
              <text x="70" y="279.5" font-family="arial" font-size="14" fill="white" stroke="none" stroke-width="0" text-anchor="start" dominant-baseline="alphabetic" alignment-baseline="auto">Y Axis annotation</text>
              <rect x="415" y="25" width="355" height="525" fill="pink" fill-opacity="0.2" stroke="none" stroke-width="0" rx="0" ry="0"/>
              <rect x="425" y="517.63636363636" width="166.36363636364" height="22" fill="pink" fill-opacity="1" stroke="none" stroke-width="0" rx="0" ry="0"/>
              <text x="435" y="535" font-family="arial" font-size="14" fill="white" stroke="none" stroke-width="0" text-anchor="start" dominant-baseline="alphabetic" alignment-baseline="auto">X Axis range annotation</text>
            </svg>
            SVG
        );
});
