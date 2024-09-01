<?php

namespace Maantje\Phpviz\Line;

class Point
{
    public function __construct(
        public readonly float $value,
        public readonly string $color = '#000'
    ) {}

    public function render(float $x, float $y): string
    {
        return <<<SVG
            <circle cx="$x" cy="$y" r="3" fill="$this->color" />
            SVG;

    }
}
