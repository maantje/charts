<?php

namespace Maantje\Phpviz\Line;

class Point
{
    public function __construct(
        public readonly float $value,
        public readonly string $color = '#000',
        public int $size = 3,
    ) {}

    public function render(float $x, float $y): string
    {
        return <<<SVG
            <circle cx="$x" cy="$y" r="$this->size" fill="$this->color" />
            SVG;

    }
}
