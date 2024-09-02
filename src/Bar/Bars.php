<?php

namespace Maantje\Phpviz\Bar;

use Maantje\Phpviz\Element;

class Bars extends Element
{
    public function __construct(
        private readonly array $bars = [],
        public readonly Alignment $alignment = Alignment::JUSTIFY_AROUND
    ) {}

    public function maxValue(): float
    {
        return max(array_map(fn ($data) => $data->value, $this->bars));
    }

    public function minValue(): float
    {
        return min(array_map(fn ($data) => $data->value, $this->bars));
    }

    public function render(float $height, float $width, float $leftMargin, float $minValue, float $maxValue): string
    {
        $numBars = count($this->bars);
        $xOffset = $leftMargin;
        $barSpacing = 0;

        switch ($this->alignment) {
            case Alignment::FILL:
                $totalBarWidth = array_sum(array_map(fn (Bar $bar) => $bar->width, $this->bars));
                $barSpacing = ($width - $leftMargin - $totalBarWidth) / ($numBars - 1);
                break;
            case Alignment::JUSTIFY_BETWEEN:
                $totalBarWidth = array_sum(array_map(fn (Bar $bar) => $bar->width, $this->bars));
                $barSpacing = ($width - $leftMargin - $totalBarWidth) / ($numBars - 1);
                break;
            case Alignment::JUSTIFY_AROUND:
                $totalBarWidth = array_sum(array_map(fn (Bar $bar) => $bar->width, $this->bars));
                $barSpacing = ($width - $leftMargin - $totalBarWidth) / ($numBars + 1);
                $xOffset += $barSpacing;
                break;
        }

        $x = $xOffset;

        $svg = '';

        /** @var Bar $bar */
        foreach ($this->bars as $bar) {
            $barHeight = (($bar->value - $minValue) / ($maxValue - $minValue)) * ($height - 50);
            $svg .= $bar->render($height, $barHeight, $x);

            $x += $bar->width + $barSpacing;
        }

        return $svg;
    }
}
