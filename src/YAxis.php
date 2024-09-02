<?php

namespace Maantje\Phpviz;

use Closure;

class YAxis implements Renderable
{
    use MaxLabelWidth;

    public function __construct(
        public ?Closure $labelFormatter = null
    ) {
        if (is_null($labelFormatter)) {
            $this->labelFormatter = fn (mixed $label) => number_format($label);
        }
    }

    public function render(Chart $chart): string
    {
        $numLines = $chart->grid->lines;
        $lineSpacing = ($chart->height - 50) / $numLines;
        $svg = '';

        $labelPadding = 10;
        $leftMargin = $leftMargin + $labelPadding + 10;

        for ($i = 0; $i <= $numLines; $i++) {
            $value = $chart->minValue + (($i / $numLines) * ($chart->maxValue - $chart->minValue));

            $labelText = $this->labelFormatter->call($this, $value);
            $labelX = $leftMargin - $labelPadding;

            $labelY = $chart->height - 20 - ($i * $lineSpacing) + 5;
            $line = <<<SVG
            <text x="$labelX" y="$labelY" font-size="12" fill="$this->labelColor" text-anchor="end">$labelText</text>
            SVG;
            $svg .= $line;
        }

        return $svg;
    }
}
