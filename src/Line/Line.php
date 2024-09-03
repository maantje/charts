<?php

namespace Maantje\Charts\Line;

use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Polyline;

class Line implements Renderable
{
    /**
     * @param  Point[]  $points
     */
    public function __construct(
        public readonly array $points = [],
        public readonly int $size = 5,
        public readonly ?string $yAxis = null,
        public readonly string $lineColor = 'black',
    ) {}

    public function render(Chart $chart): string
    {
        $xSpacing = ($chart->end() - $chart->leftMargin) / (count($this->points) - 1);

        $pointsSvg = '';
        $points = [];

        foreach ($this->points as $index => $point) {
            $x = $chart->leftMargin + $index * $xSpacing;

            $y = $chart->yForAxis($point->y, $this->yAxis);

            $points[] = [$x, $y];

            $pointsSvg .= $point->render($x, $y);
        }

        return new Fragment([
            new Polyline(
                points: $points,
                stroke: $this->lineColor,
                strokeWidth: $this->size
            ),
            $pointsSvg,
        ]);
    }
}
