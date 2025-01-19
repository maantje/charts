<?php

namespace Maantje\Charts\Bar;

use Maantje\Charts\Chart;
use Maantje\Charts\Serie;

class Bars extends Serie
{
    /**
     * @param  BarContract[]  $bars
     */
    public function __construct(
        private readonly array $bars = [],
        public ?string $yAxis = null,
    ) {
        parent::__construct($yAxis);
    }

    public function maxValue(): float
    {
        if (count($this->bars) === 0) {
            return 0;
        }

        return max(array_map(fn (BarContract $data) => $data->value(), $this->bars));
    }

    public function minValue(): float
    {
        if (count($this->bars) === 0) {
            return 0;
        }

        return min(array_map(fn (BarContract $data) => $data->value(), $this->bars));
    }

    public function render(Chart $chart): string
    {
        $numBars = count($this->bars);

        $maxBarWidth = 0;

        if ($numBars > 0) {
            $maxBarWidth = $chart->availableWidth() / $numBars;
        }

        $x = $chart->left();

        $svg = '';

        foreach ($this->bars as $bar) {
            $svg .= $bar->render($chart, $x, $maxBarWidth);

            $x += $maxBarWidth;
        }

        return $svg;
    }
}
