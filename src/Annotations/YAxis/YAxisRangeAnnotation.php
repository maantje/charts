<?php

namespace Maantje\Phpviz\Annotations\YAxis;

use Maantje\Phpviz\Chart;
use Maantje\Phpviz\Renderable;

class YAxisRangeAnnotation implements Renderable
{
    public function __construct(
        public float $y1 = 0,
        public float $y2 = 0,
        public ?string $yAxis = null,
        public string $color = 'yellow',
        public int $fontSize = 14,
        public float $opacity = 0.3,
        public string $label = '',
        public string $labelColor = ''
    ) {}

    public function render(Chart $chart): string
    {
        $y1 = $chart->yForAxis($this->y1, $this->yAxis);
        $y2 = $chart->yForAxis($this->y2, $this->yAxis);

        $rectHeight = abs($y2 - $y1);
        $rectY = min($y1, $y2);
        $rectX = $chart->leftMargin;

        $labelY = $rectY + $rectHeight - 10;
        $labelX = $rectX + 5;
        $labelColor = $this->labelColor ?: $this->color;
        $width = $chart->end() - $chart->leftMargin;
        $fontSize = $this->fontSize ?? $chart->fontSize;

        return <<<SVG
        <rect x="$rectX" y="$rectY" width="$width" height="$rectHeight" fill="$this->color" fill-opacity="$this->opacity" />
        <text x="$labelX" y="$labelY" font-family="$chart->fontFamily" font-size="$fontSize" fill="$labelColor" text-anchor="start">$this->label</text>
        SVG;
    }
}
