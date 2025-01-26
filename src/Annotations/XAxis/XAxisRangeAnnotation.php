<?php

namespace Maantje\Charts\Annotations\XAxis;

use Maantje\Charts\Annotations\RendersAfterSeries;
use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Rect;
use Maantje\Charts\SVG\TextResizeableRect;

class XAxisRangeAnnotation implements Renderable, RendersAfterSeries
{
    public function __construct(
        public float $x1 = 0,
        public float $x2 = 0,
        public string $color = 'yellow',
        public ?int $fontSize = null,
        public float $opacity = 0.2,
        public string $label = '',
        public string $labelColor = 'white',
        public string $labelBackgroundColor = '',
        public string $labelBorderColor = 'none',
        public int $labelBorderWidth = 0,
        public int $labelOffsetX = 20,
        public int $labelPaddingX = 20,
    ) {}

    public function render(Chart $chart): string
    {
        $x1 = $chart->xFor($this->x1);
        $x2 = $chart->xFor($this->x2);

        $rectWidth = abs($x2 - $x1);

        $labelColor = $this->labelBackgroundColor ?: $this->color;
        $fontSize = $this->fontSize ?? $chart->fontSize;

        return new Fragment([
            new Rect(
                x: $x1,
                y: $chart->top(),
                width: $rectWidth,
                height: $chart->availableHeight(),
                fill: $this->color,
                fillOpacity: $this->opacity,
            ),
            new TextResizeableRect(
                content: $this->label,
                x: $x1 + $this->labelOffsetX,
                y: $chart->bottom() - 15,
                fontFamily: $chart->fontFamily,
                fontSize: $fontSize,
                rectFill: $labelColor,
                rectStroke: $this->labelBorderColor,
                rectStrokeWidth: $this->labelBorderWidth,
                fill: $this->labelColor,
                textAnchor: 'start'
            ),
        ]);
    }
}
