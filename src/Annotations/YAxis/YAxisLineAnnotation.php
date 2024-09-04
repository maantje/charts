<?php

namespace Maantje\Charts\Annotations\YAxis;

use Maantje\Charts\Annotations\HasYAxis;
use Maantje\Charts\Annotations\RendersAfterSeries;
use Maantje\Charts\Annotations\YAxisAnnotation;
use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Line;
use Maantje\Charts\SVG\TextResizeableRect;

class YAxisLineAnnotation implements Renderable, RendersAfterSeries, YAxisAnnotation
{
    use HasYAxis;

    public function __construct(
        public float $y,
        public ?string $yAxis = 'default',
        public string $color = 'yellow',
        public int $size = 2,
        public ?int $fontSize = null,
        public string $dash = '',
        public string $label = '',
        public string $labelColor = 'white',
        public string $labelBackgroundColor = '',
        public string $labelBorderColor = '',
        public int $labelBorderWidth = 0,
        public int $labelOffsetY = -5,
        public int $labelOffsetX = 10,
        public int $labelPaddingX = 20,
        public int $textLeftMargin = 0,
    ) {
        //
    }

    public function render(Chart $chart): string
    {
        $y = $chart->yForAxis($this->y, $this->yAxis);

        $labelY = $y - $this->size + $this->labelOffsetY;

        $labelColor = $this->labelBackgroundColor ?: $this->color;
        $fontSize = $this->fontSize ?? $chart->fontSize;

        return new Fragment([
            new Line(
                x1: $chart->left(),
                y1: $y,
                x2: $chart->right(),
                y2: $y,
                strokeDashArray: $this->dash,
                stroke: $this->color,
                strokeWidth: $this->size,
            ),
            new TextResizeableRect(
                content: $this->label,
                x: $chart->left() + $this->labelOffsetX,
                y: $labelY,
                fontFamily: $chart->fontFamily,
                fontSize: $fontSize,
                rectFill: $labelColor,
                rectStroke: $this->labelBorderColor,
                rectStrokeWidth: $this->labelBorderWidth,
                fill: $this->labelColor,
                labelPaddingX: $this->labelPaddingX,
                labelLeftMargin: $this->textLeftMargin,
                textAnchor: 'start'
            ),
        ]);
    }
}
