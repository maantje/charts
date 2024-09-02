<?php

namespace Maantje\Phpviz\Line;

class Line
{
    public function __construct(
        public readonly array $points = [],
        public readonly int $size = 3,
        public readonly string $lineColor = 'black',
        public readonly string $fillColor = 'rgba(0, 0, 0, 0)'
    ) {}

    public function render(int $height, int $width, float $leftMargin, float $minValue, float $maxValue): string
    {
        $xSpacing = ($width - $leftMargin) / (count($this->points) - 1);

        $svg = '';
        $points = [];

        /** @var Point $point * */
        foreach ($this->points as $index => $point) {
            $x = $leftMargin + $index * $xSpacing;

            $y = $height - 20 - (($point->value - $minValue) / ($maxValue - $minValue)) * ($height - 50);

            $points[] = "$x,$y";

            $svg .= $point->render($x, $y);
        }

        $fillPoints = $points;
        $fillPoints[] = "$width,".$height - 20;
        $fillPoints[] = "$leftMargin,".$height - 20;
        $fillPoints[] = "$leftMargin,".($height - 20 - (($this->points[0]->value - $minValue) / ($maxValue - $minValue)) * ($height - 50));

        $linePath = implode(' ', $points);
        $fillPath = implode(' ', $fillPoints);

        $svg .= <<<SVG
                <polygon points="$fillPath" fill="$this->fillColor" stroke="none"/>
                <polyline points="$linePath" fill="none" stroke="$this->lineColor" stroke-width="$this->size"/>
            SVG;

        return $svg;
    }
}
