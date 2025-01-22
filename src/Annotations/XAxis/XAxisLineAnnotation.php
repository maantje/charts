<?php

namespace Maantje\Charts\Annotations\XAxis;

use Maantje\Charts\Annotations\RendersAfterSeries;
use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Line;
use Maantje\Charts\SVG\TextResizeableRect;

class XAxisLineAnnotation implements Renderable, RendersAfterSeries
{
    public function __construct(
        public float $x,
        public string $color,
        public int $size = 2,
        public ?int $fontSize = null,
        public string $dash = '',
        public string $label = '',
        public string $labelColor = 'white',
        public string $labelBackgroundColor = '',
        public string $labelBorderColor = '',
        public int $labelBorderWidth = 0,
        public int $labelOffsetX = 20,
        public int $textLeftMargin = 0,
        public int $textTopMargin = 0,
        public int $radius = 0,
    ) {}

    public function render(Chart $chart): string
    {
        $x = $chart->xFor($this->x);

        $labelColor = $this->labelBackgroundColor ?: $this->color;
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
            new TextResizeableRect(
                content: $this->label,
                x: $x + $this->size + $this->labelOffsetX,
                y: $chart->bottom() - 15,
                fontFamily: $chart->fontFamily,
                fontSize: $fontSize,
                rectFill: $labelColor,
                rectStroke: $this->labelBorderColor,
                rectStrokeWidth: $this->labelBorderWidth,
                rectRx: $this->radius,
                rectRy: $this->radius,
                fill: $this->labelColor,
                labelLeftMargin: $this->textLeftMargin,
                labelTopMargin: $this->textTopMargin,
                textAnchor: 'start'
            ),
        ]);
    }
}
