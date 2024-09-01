<?php

namespace Maantje\Phpviz\Line;

class Line
{
    public function __construct(
        public readonly array $points,
        public readonly string $lineColor,
    ) {}

    public function render(int $height, int $width, float $leftMargin , float $maxValue): string
    {
        $xSpacing = ($width - $leftMargin) / (sizeof($this->points) - 1);

        $svg = '';
        $points = [];

        /** @var Point $point  **/
        foreach ($this->points as $index => $point) {
            $x = $leftMargin + $index * $xSpacing;
            $y = $height - 20 - ($point->value / $maxValue) * ($height - 50);
            $points[] = "$x,$y";
            $svg .= $point->render($x, $y);
        }

        $linePath = implode(' ', $points);

        $svg .= <<<SVG
            <polyline points="$linePath" fill="none" stroke="$this->lineColor" stroke-width="2"/>
            SVG;

        return $svg;
    }
}
