<?php

namespace Maantje\Charts\Annotations\YAxis;

use Maantje\Charts\Annotations\HasYAxis;
use Maantje\Charts\Annotations\RendersAfterSeries;
use Maantje\Charts\Annotations\YAxisAnnotation;
use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Line;
use Maantje\Charts\SVG\Text;

class YAxisLineAnnotation implements Renderable, RendersAfterSeries, YAxisAnnotation
{
    use HasYAxis;

    public function __construct(
        public float $y,
        public ?string $yAxis = null,
        public string $color = 'yellow',
        public int $size = 2,
        public ?int $fontSize = null,
        public string $dash = '',
        public string $label = '',
        public string $labelColor = '',
    ) {
        //
    }

    public function render(Chart $chart): string
    {
        $y = $chart->yForAxis($this->y, $this->yAxis);

        $lineX = $chart->leftMargin;
        $labelY = $y - $this->size + 20;
        $labelX = $lineX + 5;
        $labelColor = $this->labelColor ?: $this->color;

        $fontSize = $this->fontSize ?? $chart->fontSize;

        return new Fragment([
            new Line(
                x1: $lineX,
                y1: $y,
                x2: $chart->end(),
                y2: $y,
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
                textAnchor: 'start'
            ),
        ]);
    }
}
