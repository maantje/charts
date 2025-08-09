<?php

namespace Maantje\Charts\Bar;

use Maantje\Charts\Chart;
use Maantje\Charts\SVG\Text;

abstract class AbstractBar implements BarContract
{
    public function __construct(
        public ?string $name = null,
        public ?string $yAxis = null,
        public string $color = '#3498db',
        public ?float $width = null,
        public ?string $labelColor = null,
        public int $labelMarginY = 30,
    ) {}

    protected function calculateWidth(float $maxBarWidth): float
    {
        return min($this->width ?? $maxBarWidth, $maxBarWidth);
    }

    protected function calculateX(float $x, float $width, float $maxBarWidth): float
    {
        if (! is_null($this->width)) {
            return $x + ($maxBarWidth - $width) / 2;
        }

        return $x;
    }

    protected function calculateLabelX(float $x, float $width): float
    {
        return $x + $width / 2;
    }

    protected function renderLabel(Chart $chart, float $labelX): ?Text
    {
        if (! $this->name) {
            return null;
        }

        return new Text(
            content: $this->name,
            x: $labelX,
            y: $chart->bottom() + $this->labelMarginY,
            fontFamily: $chart->fontFamily,
            fontSize: $chart->fontSize,
            fill: $this->labelColor ?? $chart->color,
            textAnchor: 'middle'
        );
    }
}
