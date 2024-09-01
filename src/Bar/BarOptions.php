<?php

namespace Maantje\Phpviz\Bar;

use Maantje\Phpviz\Grid;

class BarOptions
{
    public function __construct(
        public readonly float $width = 500,
        public readonly float $height = 300,
        public readonly Grid $grid = new Grid,
        public readonly Alignment $alignment = Alignment::JUSTIFY_AROUND
    ) {}
}
