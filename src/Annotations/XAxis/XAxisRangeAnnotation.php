<?php

namespace Maantje\Charts\Annotations\XAxis;

use Maantje\Charts\Annotations\RendersBeforeSeries;
use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Rect;
use Maantje\Charts\SVG\Text;

class XAxisRangeAnnotation implements Renderable, RendersBeforeSeries
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

        $labelColor = $this->labelColor ?: $this->color;
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
            new Text(
                content: $this->label,
                x: $rectX + 5,
                y: $chart->bottom() - 10,
                fontFamily: $chart->fontFamily,
                fontSize: $fontSize,
                fill: $labelColor,
                textAnchor: 'start'
            ),
        ]);
    }
}
