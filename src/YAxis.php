<?php

namespace Maantje\Phpviz;

use Closure;

class YAxis implements Renderable
{
    use MaxLabelWidth;

    /**
     * @param  Renderable[]  $annotations
     */
    public function __construct(
        public string $name,
        public string $title = '',
        public ?float $minValue = null,
        public ?float $maxValue = null,
        public array $annotations = [],
        public ?Closure $labelFormatter = null
    ) {
        if (is_null($labelFormatter)) {
            $this->labelFormatter = fn (mixed $label) => number_format($label);
        }
    }

    public function render(Chart $chart): string
    {
        $numLines = $chart->grid->lines;
        $lineSpacing = $chart->height / $numLines;
        $svg = '';

        $titleMargin = 10;
        $labelWidth = $this->maxLabelWidth($chart->maxValue($this->name));

        $chart->leftMargin += $labelWidth + $titleMargin;

        for ($i = 0; $i <= $numLines; $i++) {
            $value = $this->minValue + (($i / $numLines) * ($this->maxValue - $this->minValue));

            $labelText = $this->labelFormatter->call($this, $value);
            $labelX = $chart->leftMargin - 5;
            $labelY = $chart->height - ($i * $lineSpacing) + 5;

            $svg .= <<<SVG
            <text x="$labelX" y="$labelY" font-size="$chart->fontSize" fill="blue" text-anchor="end">$labelText</text>
            SVG;
        }

        $titleY = ($chart->height) / 2;
        $titleX = $chart->leftMargin - $labelWidth ;

        $svg .= <<<SVG
            <text text-anchor="middle" alignment-baseline="middle" transform="rotate(270, $titleX, $titleY)" x="$titleX" y="$titleY" font-size="$chart->fontSize" fill="blue">$this->title</text>
            SVG;

        return $svg;
    }
}
