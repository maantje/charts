<?php

namespace Maantje\Phpviz\Bar;

use Maantje\Phpviz\MaxLabelWidth;

class BarChart
{
    use MaxLabelWidth;

    /**
     * @param  Bar[]  $data
     */
    public function __construct(
        private readonly BarOptions $options,
        public readonly array $data,
    ) {}

    public function render(): string
    {
        return <<<SVG
            <svg width="{$this->options->width}" height="{$this->options->height}" xmlns="http://www.w3.org/2000/svg">
                {$this->options->grid->render($this->options->height, $this->options->width, $this->maxValue())}
                {$this->renderBars()}
            </svg>
            SVG;
    }

    private function maxValue(): float
    {
        return max(array_map(fn ($data) => $data->value, $this->data));
    }

    private function renderBars(): string
    {
        $maxValue = $this->maxValue();
        $numBars = count($this->data);

        $labelPadding = 10;
        $leftMargin = $this->maxLabelWidth($maxValue) + $labelPadding + 10;

        $xOffset = $leftMargin;
        $barSpacing = 0;

        switch ($this->options->alignment) {
            case Alignment::FILL:
                $totalBarWidth = array_sum(array_map(fn ($data) => $data->width, $this->data));
                $barSpacing = ($this->options->width - $leftMargin - $totalBarWidth) / ($numBars - 1);
                break;
            case Alignment::JUSTIFY_BETWEEN:
                $totalBarWidth = array_sum(array_map(fn ($data) => $data->width, $this->data));
                $barSpacing = ($this->options->width - $leftMargin - $totalBarWidth) / ($numBars - 1);
                break;
            case Alignment::JUSTIFY_AROUND:
                $totalBarWidth = array_sum(array_map(fn ($data) => $data->width, $this->data));
                $barSpacing = ($this->options->width - $leftMargin - $totalBarWidth) / ($numBars + 1);
                $xOffset += $barSpacing;
                break;
        }

        $x = $xOffset;

        $svg = '';

        foreach ($this->data as $bar) {
            $barHeight = ($bar->value / $maxValue) * ($this->options->height - 50);

            $svg .= $bar->render($this->options->height, $barHeight, $x);
            $x += $bar->width + $barSpacing;
        }

        return $svg;
    }
}
