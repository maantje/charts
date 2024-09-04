<?php

namespace Maantje\Charts\Bar;

class Segment
{
    public function __construct(
        public float $value,
        public string $color,
        public string $labelColor = 'black',
    ) {}
}
