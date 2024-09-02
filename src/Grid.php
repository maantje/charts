<?php

namespace Maantje\Phpviz;

class Grid implements Renderable
{
    public function __construct(
        public readonly int $lines = 5,
        public readonly string $lineColor = '#ccc',
        public readonly string $labelColor = '#333',
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
            $line = <<<SVG
            <line x1="$x" y1="$y" x2="{$chart->end()}" y2="$y" stroke="$this->lineColor" stroke-width="1"/>
            SVG;
            $svg .= $line;
        }

        return $svg;
    }
}
