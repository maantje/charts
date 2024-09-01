<?php

namespace Maantje\Phpviz\Pie;

class Slice
{
    public function __construct(
        public readonly float $value,
        public readonly string $color,
        public readonly string $label,
        public readonly string $labelColor = '#000',
        public readonly float $explodeDistance = 0.0
    ) {}

    public function render(string $pathData, float $labelX, float $labelY, float $percentage): string
    {
        $labelText = "$this->label ($percentage%)";

        return <<<SVG
            <path d="$pathData" fill="$this->color" />
            <text x="$labelX" y="$labelY" font-size="12" fill="$this->labelColor" text-anchor="middle" dominant-baseline="middle">$labelText</text>
            SVG;

    }
}
