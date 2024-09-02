<?php

namespace Maantje\Charts\Bar;

use Maantje\Charts\Chart;

class Bar
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
        $barHeight = $chart->height - $y;

        if (!is_null($this->width)) {
            $x += ($maxBarWidth - $width) / 2;
        }

        $labelY = $chart->height + $this->labelMarginY;
        $labelX = $x + $width / 2;


        return <<<SVG
            <rect x="$x" y="$y" width="$width" height="$barHeight" fill="$this->color">
                <title>$this->value</title>
            </rect>
            <text x="$labelX" y="$labelY" font-family="$chart->fontFamily" font-size="$chart->fontSize" fill="$this->labelColor" text-anchor="middle">$this->name</text>
        SVG;
    }
}
