<?php

namespace Maantje\Phpviz\Bar;

class Bar
{
    public function __construct(
        public readonly string $name,
        public readonly float $value,
        public readonly string $color = '#3498db',
        public readonly float $width = 100,
        public readonly string $labelColor = '#333'
    ) {}

    public function render(float $height, float $barHeight, float $x): string
    {
        $y = $height - $barHeight - 20;
        $labelY = $height - 5;
        $labelX = $x + $this->width / 2;

        return <<<SVG
            <rect x="$x" y="$y" width="$this->width" height="$barHeight" fill="$this->color">
                <title>$this->value</title>
            </rect>
            <text x="$labelX" y="$labelY" font-size="12" fill="$this->labelColor" text-anchor="middle">$this->name</text>
        SVG;
    }
}
