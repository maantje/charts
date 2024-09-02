<?php

namespace Maantje\Phpviz\Line;

use Maantje\Phpviz\Chart;
use Maantje\Phpviz\Renderable;

class Line implements Renderable
{
    public function __construct(
        public readonly array $points = [],
        public readonly int $size = 5,
        public readonly ?string $yAxis = null,
        public readonly string $lineColor = 'black',
        public readonly string $fillColor = 'rgba(0, 0, 0, 0)'
    ) {}

    public function render(Chart $chart): string
    {
        $xSpacing = ($chart->end() - $chart->leftMargin) / (count($this->points) - 1);

        $pointsSvg = '';
        $points = [];

        /** @var Point $point * */
        foreach ($this->points as $index => $point) {
            $x = $chart->leftMargin + $index * $xSpacing;

            $y = $chart->yForAxis($point->y, $this->yAxis);

            $points[] = "$x,$y";

            $pointsSvg .= $point->render($x, $y);
        }

        $fillPoints = $points;
        $fillPoints[] = "$chart->width,".$chart->height;
        $fillPoints[] = "$chart->leftMargin,".$chart->height;
        $fillPoints[] = "$chart->leftMargin,".($chart->height - $chart->yForAxis($this->points[0]->y, $this->yAxis));

        $linePath = implode(' ', $points);
        $fillPath = implode(' ', $fillPoints);

        return <<<SVG
                <polygon points="$fillPath" fill="$this->fillColor" stroke="none"/>
                <polyline points="$linePath" fill="none" stroke="$this->lineColor" stroke-width="$this->size"/>
                $pointsSvg
            SVG;
    }
}
