<?php

namespace Maantje\Charts\Bar;

use Maantje\Charts\Chart;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Rect;
use Maantje\Charts\SVG\Text;

class Bar implements BarContract
{
    public function __construct(
        public string $name,
        public float $value,
        public ?string $yAxis = null,
        public string $color = '#3498db',
        public ?float $width = 100,
        public string $labelColor = '#333',
        public int $labelMarginY = 30
    ) {}

    public function render(Chart $chart, float $x, float $maxBarWidth): string
    {
        $width = min($this->width ?? $maxBarWidth, $maxBarWidth);
        $y = $chart->yForAxis($this->value, $this->yAxis);

        if (! is_null($this->width)) {
            $x += ($maxBarWidth - $width) / 2;
        }

        $labelX = $x + $width / 2;

        return new Fragment([
            new Rect(
                x: $x,
                y: $y,
                width: $width,
                height: $chart->bottom() - $y,
                fill: $this->color,
                title: $this->value
            ),
            new Text(
                content: $this->name,
                x: $labelX,
                y: $chart->bottom() + $this->labelMarginY,
                fontFamily: $chart->fontFamily,
                fontSize: $chart->fontSize,
                fill: $this->labelColor,
                textAnchor: 'middle'
            ),
        ]);
    }

    public function value(): float
    {
        return $this->value;
    }
}
