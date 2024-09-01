<?php

namespace Maantje\Phpviz\Line;

use Maantje\Phpviz\MaxLabelWidth;

class LineChart
{
    use MaxLabelWidth;

    public function __construct(
        private readonly LineOptions $options,
        private readonly array $lines,
    ) {}

    public function render(): string
    {
        return <<<SVG
            <svg width="{$this->options->width}" height="{$this->options->height}" xmlns="http://www.w3.org/2000/svg">
                {$this->options->grid->render($this->options->height, $this->options->width, $this->getMaxValue())}
                {$this->renderLines()}
            </svg>
            SVG;
    }

    private function renderLines(): string
    {
        $maxValue = $this->getMaxValue();

        $labelPadding = 10;
        $maxLabelWidth = $this->maxLabelWidth($maxValue);
        $leftMargin = $maxLabelWidth + $labelPadding + 10;
        $svg = '';

        /** @var Line $line */
        foreach ($this->lines as $line) {
            $svg .= $line->render($this->options->height, $this->options->width, $leftMargin, $maxValue);
        }

        return $svg;
    }

    private function getMaxValue(): float
    {
        $maxValue = 0;

        foreach ($this->lines as $dataSet) {
            $dataSetMax = max(array_map(fn ($point) => $point->value, $dataSet->points));
            if ($dataSetMax > $maxValue) {
                $maxValue = $dataSetMax;
            }
        }

        return $maxValue;
    }
}
