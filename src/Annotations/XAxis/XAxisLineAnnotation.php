<?php

namespace Maantje\Charts\Annotations\XAxis;

use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;

class XAxisLineAnnotation implements Renderable
{
    public function __construct(
        public float $x,
        public string $color,
        public int $size = 2,
        public ?int $fontSize = null,
        public string $dash = '',
        public string $label = '',
        public string $labelColor = '',
    ) {}

    public function render(Chart $chart): string
    {
        $x = $chart->xFor($this->x);

        $lineY = $chart->height;
        $labelX = $x + $this->size + 5;
        $labelY = $lineY - 10;
        $labelColor = $this->labelColor ?: $this->color;

        $fontSize = $this->fontSize ?? $chart->fontSize;

        return <<<SVG
        <line x1="$x" x2="$x" y1="0" y2="$lineY" stroke-dasharray="$this->dash" stroke="$this->color" stroke-width="$this->size"/>
        <text x="$labelX" y="$labelY" font-family="$chart->fontFamily" font-size="$fontSize" fill="$labelColor" text-anchor="start">$this->label</text>
        SVG;

    }
}
