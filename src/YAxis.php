<?php

namespace Maantje\Charts;

use Closure;

class YAxis implements Renderable
{
    public Closure $formatter;

    /**
     * @param  Renderable[]  $annotations
     */
    public function __construct(
        public string $name = 'default',
        public string $title = '',
        public string $color = 'black',
        public ?float $minValue = null,
        public ?float $maxValue = null,
        public int $labelMargin = 0,
        public array $annotations = [],
        public int $characterSize = 5,
        ?Closure $formatter = null
    ) {
        $this->formatter = $formatter ?? fn (mixed $label) => number_format($label);
    }

    public function render(Chart $chart): string
    {
        $numLines = $chart->grid->lines;
        $lineSpacing = $chart->height / $numLines;
        $svg = '';

        $titleMargin = 10;
        $labelWidth = strlen($this->formatter->call($this, $chart->maxValue($this->name))) * $this->characterSize + $this->labelMargin;

        $chart->leftMargin += $labelWidth + $titleMargin;

        for ($i = 0; $i <= $numLines; $i++) {
            $value = $chart->minValue($this->name) + (($i / $numLines) * ($chart->maxValue($this->name) - $chart->minValue($this->name)));

            $labelText = $this->formatter->call($this, $value);
            $labelX = $chart->leftMargin - 10;
            $labelY = $chart->height - ($i * $lineSpacing) + 5;

            $svg .= <<<SVG
            <text x="$labelX" y="$labelY" font-family="$chart->fontFamily" font-size="$chart->fontSize" fill="$this->color" text-anchor="end">$labelText</text>
            SVG;
        }

        $titleY = ($chart->height) / 2;
        $titleX = $chart->leftMargin - $labelWidth;

        $svg .= <<<SVG
            <text text-anchor="middle" font-family="$chart->fontFamily" alignment-baseline="middle" transform="rotate(270, $titleX, $titleY)" x="$titleX" y="$titleY" font-size="$chart->fontSize" fill="$this->color">$this->title</text>
            SVG;

        return $svg;
    }
}
