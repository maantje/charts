<?php

namespace Maantje\Charts\Annotations\YAxis;

use Maantje\Charts\Annotations\HasYAxis;
use Maantje\Charts\Annotations\RendersBeforeSeries;
use Maantje\Charts\Annotations\YAxisAnnotation;
use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Rect;
use Maantje\Charts\SVG\Text;

class YAxisRangeAnnotation implements Renderable, RendersBeforeSeries, YAxisAnnotation
{
    use HasYAxis;

    public function __construct(
        public float $y1 = 0,
        public float $y2 = 0,
        public ?string $yAxis = null,
        public string $color = 'yellow',
        public int $fontSize = 14,
        public float $opacity = 0.3,
        public string $label = '',
        public string $labelColor = ''
    ) {
        //
    }

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

        return new Fragment([
            new Rect(
                x: $rectX,
                y: $rectY,
                width: $width,
                height: $rectHeight,
                fill: $this->color,
                fillOpacity: $this->opacity,
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
