<?php

namespace Maantje\Charts;

use Maantje\Charts\SVG\Line;

class Grid implements Renderable
{
    public function __construct(
        public int $lines = 5,
        public ?string $lineColor = null,
        public float $thickness = 1,
        public float $opacity = 0.2,
    ) {
        //
    }

    public function render(Chart $chart): string
    {
        $numLines = $this->lines;
        $lineSpacing = $chart->availableHeight() / $numLines;

        $svg = '';

        for ($i = 1; $i <= $numLines; $i++) {
            $y = $chart->bottom() - ($i * $lineSpacing);

            $line = new Line(
                x1: $chart->left(),
                y1: $y,
                x2: $chart->right(),
                y2: $y,
                stroke: $this->lineColor ?? $chart->color,
                strokeWidth: $this->thickness,
                strokeOpacity: $this->opacity,
            );
            $svg .= $line;
        }

        return $svg;
    }
}
