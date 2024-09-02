<?php

namespace Maantje\Phpviz\Bar;

use Maantje\Phpviz\Chart;
use Maantje\Phpviz\Element;

class Bars extends Element
{
    public function __construct(
        private readonly array $bars = [],
        public ?string $yAxis = null,
    ) {
        parent::__construct($yAxis);
    }

    public function maxValue(): float
    {
        return max(array_map(fn (Bar $data) => $data->value, $this->bars));
    }

    public function minValue(): float
    {
        return min(array_map(fn (Bar $data) => $data->value, $this->bars));
    }

    public function render(Chart $chart): string
    {
        $numBars = count($this->bars);
        $availableWidth = $chart->width - $chart->leftMargin;

        $maxBarWidth = $availableWidth / $numBars;

        $xOffset = $chart->leftMargin;

        $x = $xOffset;

        $svg = '';

        /** @var Bar $bar */
        foreach ($this->bars as $bar) {
            $svg .= $bar->render($chart, $x, $maxBarWidth);

            $x += $maxBarWidth;
        }

        return $svg;
    }
}
