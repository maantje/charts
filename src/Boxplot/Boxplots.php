<?php

namespace Maantje\Charts\Boxplot;

use Maantje\Charts\Bar\Bars;

class Boxplots extends Bars
{
    /**
     * @param  Boxplot[]  $boxplots
     */
    public function __construct(
        array $boxplots = [],
        ?string $yAxis = null,
    ) {
        parent::__construct(bars: $boxplots, yAxis: $yAxis);
    }
}
