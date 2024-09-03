<?php

namespace Maantje\Charts\Annotations\XAxis;

use Maantje\Charts\Annotations\RendersAfterSeries;
use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Line;
use Maantje\Charts\SVG\Text;

class XAxisLineAnnotation implements Renderable, RendersAfterSeries
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

        return new Fragment([
            new Line(
                x1: $x,
                x2: $x,
                y2: $lineY,
                strokeDashArray: $this->dash,
                stroke: $this->color,
                strokeWidth: $this->size,
            ),
            new Text(
                content: $this->label,
                x: $labelX,
                y: $labelY,
                fontFamily: $chart->fontFamily,
                fontSize: $fontSize,
                fill: $labelColor,
                textAnchor: 'start',
            ),
        ]);
    }
}
