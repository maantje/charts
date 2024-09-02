<?php

namespace Maantje\Phpviz;

use Closure;

class XAxis implements Renderable
{
    use MaxLabelWidth;

    public function __construct(
        public array $data = [],
        public string $title = '',
        public ?Closure $formatter = null
    ) {
        if (is_null($formatter)) {
            $this->formatter = fn (mixed $label) => number_format($label);
        }
    }

    public function render(Chart $chart): string
    {
        $labelCount = count($this->data);
        $xSpacing = ($chart->end() - $chart->leftMargin) / ($labelCount - 1);

        $x1 = $chart->leftMargin;

        $svg = <<<SVG
            <line x1="$x1" y1="$chart->height" x2="{$chart->end()}" y2="$chart->height" stroke="black"/>
            SVG;

        for ($i = 0; $i < $labelCount; $i++) {
            $x = $chart->leftMargin + $i * $xSpacing;
            $y = $chart->height + 25;

            $label = $this->formatter->call($this, $this->data[$i]);
            $svg .= <<<SVG
                <text x="$x" y="$y" font-family="$chart->fontFamily" font-size="$chart->fontSize" text-anchor="middle">$label</text>'
                SVG;
        }

        $titleX = ($chart->end() + $chart->leftMargin) / 2;
        $titleY = $chart->height + 30;

        $svg .= <<<SVG
                <text x="$titleX" y="$titleY" font-family="$chart->fontFamily" font-size="$chart->fontSize" text-anchor="middle">$this->title</text>'
            SVG;

        return $svg;
    }
}
