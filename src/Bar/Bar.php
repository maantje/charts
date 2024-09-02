<?php

namespace Maantje\Phpviz\Bar;

use Maantje\Phpviz\Chart;

class Bar
{
    public function __construct(
        public readonly string $name,
        public readonly float $value,
        public readonly ?string $yAxis = null,
        public readonly string $color = '#3498db',
        public readonly float $width = 100,
        public readonly string $labelColor = '#333',
        public readonly int $labelMarginY = 30
    ) {}

    public function render(Chart $chart, float $x): string
    {
        $y = $chart->yForAxis($this->value, $this->yAxis);
        $barHeight = $chart->height - $y;
        $labelY = $chart->height + $this->labelMarginY;
        $labelX = $x + $this->width / 2;

        return <<<SVG
            <rect x="$x" y="$y" width="$this->width" height="$barHeight" fill="$this->color">
                <title>$this->value</title>
            </rect>
            <text x="$labelX" y="$labelY" font-size="$chart->fontSize" fill="$this->labelColor" text-anchor="middle">$this->name</text>
        SVG;
    }
}
