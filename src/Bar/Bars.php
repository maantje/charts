<?php

namespace Maantje\Phpviz\Bar;

use Maantje\Phpviz\Chart;
use Maantje\Phpviz\Element;

class Bars extends Element
{
    public function __construct(
        private readonly array $bars = [],
        public ?string $yAxis = null,
        public readonly Alignment $alignment = Alignment::JUSTIFY_AROUND
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
        $xOffset = $chart->leftMargin;
        $barSpacing = 0;

        switch ($this->alignment) {
            case Alignment::FILL:
                $totalBarWidth = array_sum(array_map(fn (Bar $bar) => $bar->width, $this->bars));
                $barSpacing = ($chart->width - $chart->leftMargin - $totalBarWidth) / ($numBars - 1);
                break;
            case Alignment::JUSTIFY_BETWEEN:
                $totalBarWidth = array_sum(array_map(fn (Bar $bar) => $bar->width, $this->bars));
                $barSpacing = ($chart->width - $chart->leftMargin - $totalBarWidth) / ($numBars - 1);
                break;
            case Alignment::JUSTIFY_AROUND:
                $totalBarWidth = array_sum(array_map(fn (Bar $bar) => $bar->width, $this->bars));
                $barSpacing = ($chart->width - $chart->leftMargin - $totalBarWidth) / ($numBars + 1);
                $xOffset += $barSpacing;
                break;
        }

        $x = $xOffset;

        $svg = '';

        /** @var Bar $bar */
        foreach ($this->bars as $bar) {
            $svg .= $bar->render($chart, $x);

            $x += $bar->width + $barSpacing;
        }

        return $svg;
    }
}
