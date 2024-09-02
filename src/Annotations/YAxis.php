<?php

namespace Maantje\Phpviz\Annotations;

use Maantje\Phpviz\Renderable;

class YAxis implements Renderable
{
    public function __construct(
        public float $y = 0,
        public int $size = 2,
        public int $fontSize = 14,
        public string $color = '',
        public string $dash = '',
        public string $label = '',
        public string $labelColor = '',
    ) {}

    public function render(float $height, float $width, float $leftMargin, float $minValue, float $maxValue): string
    {
        $y = $height - 20 - (($this->y - $minValue) / ($maxValue - $minValue)) * ($height - 50);


        $labelY = $y - $this->size - 5;
        $labelX = $leftMargin + 5;
        $labelColor = $this->labelColor ?: $this->color;

        return <<<SVG
        <line x1="$leftMargin" y1="$y"  stroke-dasharray="20,15" x2="$width" y2="$y" stroke="$this->color" stroke-width="$this->size"/>
        <text x="$labelX" y="$labelY" font-size="$this->fontSize"  fill="$labelColor" text-anchor="start">$this->label</text>
        SVG;

    }
}
