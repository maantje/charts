<?php

namespace Maantje\Charts\Line;

use Maantje\Charts\Chart;
use Maantje\Charts\Serie;

class Lines extends Serie
{
    /**
     * @param  Line[]  $lines
     */
    public function __construct(
        public array $lines,
        public ?string $yAxis = null,
    ) {
        parent::__construct($yAxis);
    }

    public function render(Chart $chart): string
    {
        $svg = '';

        foreach ($this->lines as $line) {
            $svg .= $line->render($chart);
        }

        return $svg;
    }

    public function maxValue(): float
    {
        if (empty($this->lines)) {
            return 0;
        }

        return max(array_map(fn (Line $line) => $line->maxYValue(), $this->lines));
    }

    public function minValue(): float
    {
        if (empty($this->lines)) {
            return 0;
        }

        return min(array_map(fn (Line $line) => $line->minYValue(), $this->lines));
    }
}
