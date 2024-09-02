<?php

namespace Maantje\Charts\Line;

class Point
{
    public function __construct(
        public readonly float $y,
        public readonly float $x,
        public readonly string $color = '#000',
        public int $size = 0,
    ) {}

    public function render(float $x, float $y): string
    {
        return <<<SVG
                <circle cx="$x" cy="$y" r="$this->size" fill="$this->color" />
            SVG;

    }
}
