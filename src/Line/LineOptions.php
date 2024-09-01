<?php

namespace Maantje\Phpviz\Line;

use Maantje\Phpviz\Grid;

class LineOptions
{
    public function __construct(
        public readonly int $width,
        public readonly int $height,
        public readonly Grid $grid = new Grid,
    ) {}
}
