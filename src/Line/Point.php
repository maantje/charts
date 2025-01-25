<?php

namespace Maantje\Charts\Line;

use Maantje\Charts\SVG\Circle;
use Maantje\Charts\SVG\Fragment;

class Point
{
    public function __construct(
        public float $y,
        public float $x,
        public string $color = 'transparent',
        public int $size = 10,
    ) {}

    public function render(float $x, float $y): string
    {
        return new Fragment([
            new Circle(
                cx: $x,
                cy: $y,
                r: $this->size,
                fill: $this->color,
                title: $this->y
            ),
        ]);
    }
}
