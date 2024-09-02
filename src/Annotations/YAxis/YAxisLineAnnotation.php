<?php

namespace Maantje\Phpviz\Annotations\YAxis;

use Maantje\Phpviz\Chart;
use Maantje\Phpviz\Renderable;

class YAxisLineAnnotation implements Renderable
{
    public function __construct(
        public float $y,
        public string $color,
        public ?string $yAxis = null,
        public int $size = 2,
        public ?int $fontSize = null,
        public string $dash = '',
        public string $label = '',
        public string $labelColor = '',
    ) {}

    public function render(Chart $chart): string
    {
        $y = $chart->yForAxis($this->y, $this->yAxis);

        $lineX = $chart->leftMargin;
        $labelY = $y - $this->size + 20;
        $labelX = $lineX + 5;
        $labelColor = $this->labelColor ?: $this->color;

        $fontSize = $this->fontSize ?? $chart->fontSize;

        return <<<SVG
        <line x1="$lineX" y1="$y" stroke-dasharray="$this->dash" x2="{$chart->end()}" y2="$y" stroke="$this->color" stroke-width="$this->size"/>
        <text x="$labelX" y="$labelY" font-family="$chart->fontFamily" font-size="$fontSize"  fill="$labelColor" text-anchor="start">$this->label</text>
        SVG;

    }
}
