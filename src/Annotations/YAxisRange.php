<?php

namespace Maantje\Phpviz\Annotations;

use Maantje\Phpviz\Renderable;

class YAxisRange implements Renderable
{
    public function __construct(
        public float $y1 = 0,
        public float $y2 = 0,
        public string $color = 'yellow',
        public int $fontSize = 14,
        public float $opacity = 0.3,
        public string $label = '',
        public string $labelColor = ''
    ) {}

    public function render(float $height, float $width, float $leftMargin, float $minValue, float $maxValue): string
    {
        $y1 = $height - 20 - (($this->y1 - $minValue) / ($maxValue - $minValue)) * ($height - 50);
        $y2 = $height - 20 - (($this->y2 - $minValue) / ($maxValue - $minValue)) * ($height - 50);

        $rectHeight = abs($y2 - $y1);
        $rectY = min($y1, $y2);

        $labelY = $rectY - 5;
        $labelX = $leftMargin + 5;
        $labelColor = $this->labelColor ?: $this->color;

        return <<<SVG
        <rect x="$leftMargin" y="$rectY" width="$width" height="$rectHeight" fill="$this->color" fill-opacity="$this->opacity" />
        <text x="$labelX" y="$labelY" font-size="$this->fontSize" fill="$labelColor" text-anchor="start">$this->label</text>
        SVG;
    }
}
