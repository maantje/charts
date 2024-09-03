<?php

namespace Maantje\Charts;

use Closure;

class XAxis implements Renderable
{
    public Closure $formatter;

    /**
     * @param  float[]  $data
     * @param  Renderable[]  $annotations
     */
    public function __construct(
        public array $data = [],
        public string $title = '',
        public array $annotations = [],
        ?Closure $formatter = null
    ) {
        $this->formatter = $formatter ?? fn (mixed $label) => number_format($label);
    }

    public function maxValue(): float
    {
        return max(array_map(fn (float $data) => $data, $this->data));
    }

    public function minValue(): float
    {
        return min(array_map(fn (float $data) => $data, $this->data));
    }

    public function render(Chart $chart): string
    {
        $labelCount = count($this->data);
        //        $xSpacing = ($chart->end() - $chart->leftMargin) / ($labelCount - 1);

        $x1 = $chart->leftMargin;

        $svg = <<<SVG
            <line x1="$x1" y1="$chart->height" x2="{$chart->end()}" y2="$chart->height" stroke="black"/>
            SVG;

        for ($i = 0; $i < $labelCount; $i++) {
            $x = $chart->xFor($this->data[$i]);
            $y = $chart->height + 25;

            $label = $this->formatter->call($this, $this->data[$i]);
            $lineY = $chart->height - 5;

            $svg .= <<<SVG
                <text x="$x" y="$y" font-family="$chart->fontFamily" font-size="$chart->fontSize" text-anchor="middle">$label</text>
                <line x1="$x" x2="$x"  y1="$chart->height" y2="$lineY" stroke="black"/>

                SVG;
        }

        $titleX = ($chart->end() + $chart->leftMargin) / 2;
        $titleY = $chart->height + 30;

        $svg .= <<<SVG
                <text x="$titleX" y="$titleY" font-family="$chart->fontFamily" font-size="$chart->fontSize" text-anchor="middle">$this->title</text>
            SVG;

        return $svg;
    }
}
