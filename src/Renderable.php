<?php

namespace Maantje\Phpviz;

interface Renderable
{
    public function render(float $height, float $width, float $leftMargin, float $minValue, float $maxValue): string;
}
