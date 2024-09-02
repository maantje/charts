<?php

namespace Maantje\Charts\Annotations\XAxis;

use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;

class XAxisLineAnnotation implements Renderable
{
    public function __construct(
        public float   $x,
        public string  $color,
        public ?string $xAxis = null,
        public int     $size = 2,
        public ?int    $fontSize = null,
        public string  $dash = '',
        public string  $label = '',
        public string  $labelColor = '',
    ) {}

    public function render(Chart $chart): string
    {
        // @todo Where am I loosing 35px
        $x = $chart->leftMargin + (($this->x - $chart->xAxis->minValue()) / ($chart->xAxis->maxValue() - $chart->xAxis->minValue())) * ($chart->width - 35);

        $lineY = $chart->height;
        $labelX = $x + $this->size + 5;
        $labelY = $lineY - 10;
        $labelColor = $this->labelColor ?: $this->color;

        $fontSize = $this->fontSize ?? $chart->fontSize;

        return <<<SVG
        <line x1="$x" y1="0" stroke-dasharray="$this->dash" x2="$x" y2="$lineY" stroke="$this->color" stroke-width="$this->size"/>
        <text x="$labelX" y="$labelY" font-family="$chart->fontFamily" font-size="$fontSize"  fill="$labelColor" text-anchor="start">$this->label</text>
        SVG;

    }
}
