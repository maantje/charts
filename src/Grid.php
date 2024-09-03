<?php

namespace Maantje\Charts;

use Maantje\Charts\SVG\Line;

readonly class Grid implements Renderable
{
    public function __construct(
        public int $lines = 5,
        public string $lineColor = '#ccc',
        public string $labelColor = '#333',
    ) {
        //
    }

    public function render(Chart $chart): string
    {
        $numLines = $this->lines;
        $lineSpacing = $chart->height / $numLines;

        $svg = '';

        for ($i = 0; $i <= $numLines; $i++) {
            $y = $chart->height - ($i * $lineSpacing);
            $x = $chart->leftMargin;
            $line = new Line(
                x1: $x,
                y1: $y,
                x2: $chart->end(),
                y2: $y,
                stroke: $this->lineColor,
                strokeWidth: 1
            );
            $svg .= $line;
        }

        return $svg;
    }
}
