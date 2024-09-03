<?php

namespace Maantje\Charts\Annotations\XAxis;

use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;

class XAxisRangeAnnotation implements Renderable
{
    public function __construct(
        public float $x1 = 0,
        public float $x2 = 0,
        public string $color = 'yellow',
        public int $fontSize = 14,
        public float $opacity = 0.3,
        public string $label = '',
        public string $labelColor = ''
    ) {}

    public function render(Chart $chart): string
    {
        $x1 = $chart->xFor($this->x1);
        $x2 = $chart->xFor($this->x2);

        $rectWidth = abs($x2 - $x1);
        $rectX = min($x1, $x2);

        $labelY = $chart->height - 10;
        $labelX = $rectX + 5;
        $labelColor = $this->labelColor ?: $this->color;
        $fontSize = $this->fontSize ?? $chart->fontSize;

        return <<<SVG
        <rect x="$x1" width="$rectWidth" height="$chart->height" fill="$this->color" fill-opacity="$this->opacity" />
        <text x="$labelX" y="$labelY" font-family="$chart->fontFamily" font-size="$fontSize" fill="$labelColor" text-anchor="start">$this->label</text>
        SVG;
    }
}
