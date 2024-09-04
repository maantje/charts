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

        $labelColor = $this->labelColor ?: $this->color;
        $fontSize = $this->fontSize ?? $chart->fontSize;

        return new Fragment([
            new Line(
                x1: $x,
                y1: $chart->bottom(),
                x2: $x,
                y2: $chart->top(),
                strokeDashArray: $this->dash,
                stroke: $this->color,
                strokeWidth: $this->size,
            ),
            new Text(
                content: $this->label,
                x: $x + $this->size + 5,
                y: $chart->bottom() - 10,
                fontFamily: $chart->fontFamily,
                fontSize: $fontSize,
                fill: $labelColor,
                textAnchor: 'start',
            ),
        ]);
    }
}
