<?php

namespace Maantje\Charts\Bar;

use Maantje\Charts\Chart;

interface BarContract
{
    public function value(): float;

    public function render(Chart $chart, float $x, float $maxBarWidth): string;
}
