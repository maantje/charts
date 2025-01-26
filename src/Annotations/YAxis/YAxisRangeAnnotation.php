<?php

namespace Maantje\Charts\Annotations\YAxis;

use Maantje\Charts\Annotations\HasYAxis;
use Maantje\Charts\Annotations\RendersAfterSeries;
use Maantje\Charts\Annotations\YAxisAnnotation;
use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Rect;
use Maantje\Charts\SVG\TextResizeableRect;

class YAxisRangeAnnotation implements Renderable, RendersAfterSeries, YAxisAnnotation
{
    use HasYAxis;

    public function __construct(
        public float $y1 = 0,
        public float $y2 = 0,
        public ?string $yAxis = null,
        public string $color = 'yellow',
        public ?int $fontSize = null,
        public float $opacity = 0.2,
        public string $label = '',
        public string $labelColor = 'white',
        public string $labelBackgroundColor = '',
        public string $labelBorderColor = 'none',
        public int $labelBorderWidth = 0,
        public int $labelOffsetY = 8,
        public int $labelOffsetX = 10,
        public int $labelPaddingX = 20,
        public int $textLeftMargin = 0,
        public int $radius = 0,
    ) {
        //
    }

    public function render(Chart $chart): string
    {
        $y1 = $chart->yForAxis($this->y1, $this->yAxis);
        $y2 = $chart->yForAxis($this->y2, $this->yAxis);

        $rectHeight = abs($y2 - $y1);
        $rectY = min($y1, $y2);
        $labelY = $rectY + $rectHeight - $this->labelOffsetY;
        $labelColor = $this->labelBackgroundColor ?: $this->color;
        $fontSize = $this->fontSize ?? $chart->fontSize;

        return new Fragment([
            new Rect(
                x: $chart->left(),
                y: $rectY,
                width: $chart->availableWidth(),
                height: $rectHeight,
                fill: $this->color,
                fillOpacity: $this->opacity,
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
                rectRx: $this->radius,
                rectRy: $this->radius,
                fill: $this->labelColor,
                labelLeftMargin: $this->textLeftMargin,
                textAnchor: 'start'
            ),
        ]);
    }
}
