<?php

namespace Maantje\Charts\Annotations;

use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Circle;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Rect;
use Maantje\Charts\SVG\Text;

class PointAnnotation implements Renderable, RendersAfterSeries, YAxisAnnotation
{
    use HasYAxis;

    public function __construct(
        public float $x,
        public float $y,
        public ?string $yAxis = null,
        public int $markerSize = 5,
        public string $markerBackgroundColor = '',
        public string $markerBorderColor = '',
        public int $markerBorderWidth = 0,
        public string $label = '',
        public string $labelColor = 'white',
        public string $labelBackgroundColor = 'red',
        public string $labelBorderColor = '',
        public int $labelBorderWidth = 0,
        public int $labelOffsetY = 20,
        public int $labelPaddingX = 20,
        public ?int $fontSize = null,
    ) {
        //
    }

    public function render(Chart $chart): string
    {
        $x = $chart->xFor($this->x);
        $y = $chart->yForAxis($this->y, $this->yAxis);

        $labelY = $y - $this->markerSize - $this->labelOffsetY;
        $fontSize = $this->fontSize ?? $chart->fontSize;

        $characterSize = $fontSize / 2.2;
        $characterHeight = $fontSize * 1.2;

        $rectWidth = strlen($this->label) * $characterSize + $this->labelPaddingX;
        $rectHeight = max(30, $characterHeight);

        $rectX = $x - $rectWidth / 2;
        $rectY = $labelY - $characterSize - $rectHeight / 2;

        return new Fragment([
            new Circle(
                cx: $x,
                cy: $y,
                r: $this->markerSize,
                fill: $this->markerBackgroundColor,
                stroke: $this->markerBorderColor,
                strokeWidth: $this->markerBorderWidth,
                title: $this->y,
            ),
            new Rect(
                x: $rectX,
                y: $rectY,
                width: $rectWidth,
                height: $rectHeight,
                fill: $this->labelBackgroundColor,
                stroke: $this->labelBorderColor,
                strokeWidth: $this->labelBorderWidth,
            ),
            new Text(
                content: $this->label,
                x: $x,
                y: $labelY,
                fontFamily: $chart->fontFamily,
                fontSize: $fontSize,
                fill: $this->labelColor,
                textAnchor: 'middle',
            ),
        ]);
    }
}
