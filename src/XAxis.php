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
        $svg = <<<SVG
            <line x1="{$chart->left()}" y1="{$chart->bottom()}" x2="{$chart->right()}" y2="{$chart->bottom()}" stroke="black"/>
            SVG;

        for ($i = 0; $i < $labelCount; $i++) {
            $x = $chart->xFor($this->data[$i]);
            $y = $chart->bottom() + 25;

            $label = $this->formatter->call($this, $this->data[$i]);
            $lineY = $chart->bottom() - 5;

            $svg .= <<<SVG
                <text x="$x" y="$y" font-family="$chart->fontFamily" font-size="$chart->fontSize" text-anchor="middle">$label</text>
                <line x1="$x" x2="$x" y1="{$chart->bottom()}" y2="$lineY" stroke="black"/>
                SVG;
        }

        $titleX = $chart->availableWidth() / 2 + $chart->left();
        $titleY = $chart->bottom() + 40;

        $svg .= <<<SVG
                <text x="$titleX" y="$titleY" font-family="$chart->fontFamily" font-size="$chart->fontSize" text-anchor="middle">$this->title</text>
            SVG;

        return $svg;
    }
}
