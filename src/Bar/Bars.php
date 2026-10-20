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
        protected array $bars = [],
        public ?string $yAxis = null,
    ) {
        parent::__construct($yAxis);
    }

    public function maxValue(): float
    {
        if (count($this->bars) === 0) {
            return 0;
        }

        return max(array_map(fn (BarContract $data) => $data->maxValue(), $this->bars));
    }

    public function minValue(): float
    {
        if (count($this->bars) === 0) {
            return 0;
        }

        return min(array_map(fn (BarContract $data) => $data->minValue(), $this->bars));
    }

    public function render(Chart $chart): string
    {
        $svg = '';

        foreach (array_values($this->bars) as $index => $bar) {
            $svg .= $bar->render($chart, $this->slotX($chart, $index), $this->slotWidth($chart));
        }

        return $svg;
    }

    public function count(): int
    {
        return count($this->bars);
    }

    /**
     * @return float[]
     */
    public function values(): array
    {
        return array_map(fn (BarContract $bar) => $bar->value(), array_values($this->bars));
    }

    public function slotWidth(Chart $chart): float
    {
        if ($this->count() === 0) {
            return 0;
        }

        return $chart->availableWidth() / $this->count();
    }

    public function slotX(Chart $chart, int $index): float
    {
        return $chart->left() + $index * $this->slotWidth($chart);
    }

    public function slotCenter(Chart $chart, int $index): float
    {
        return $this->slotX($chart, $index) + $this->slotWidth($chart) / 2;
    }
}
