<?php

namespace Maantje\Charts\Line;

use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Path;

readonly class Line implements Renderable
{
    /**
     * @param  Point[]  $points
     */
    public function __construct(
        public array $points = [],
        public int $size = 5,
        public ?string $yAxis = null,
        public string $lineColor = 'black',
        public ?float $curve = null,
        public bool $stepLine = false,
    ) {}

    public function render(Chart $chart): string
    {
        $xSpacing = $chart->availableWidth() / (count($this->points) - 1);

        $pointsSvg = '';
        $points = [];
        $minY = $chart->yForAxis($chart->minValue($this->yAxis), $this->yAxis);

        foreach ($this->points as $index => $point) {
            $x = $chart->left() + $index * $xSpacing;
            $y = $chart->yForAxis($point->y, $this->yAxis);

            $points[] = [$x, min($y, $minY)];
            $pointsSvg .= $point->render($x, $y);
        }

        $d = $this->stepLine
            ? $this->generateStepPath($points)
            : $this->generateSmoothPath($points, $this->curve);

        return new Fragment([
            new Path(
                d: $d,
                fill: 'none',
                stroke: $this->lineColor,
                strokeWidth: $this->size
            ),
            $pointsSvg,
        ]);
    }

    /**
     * @param  array{float, float}[]  $points
     */
    public function generateSmoothPath(array $points, ?float $curveFactor = null): string
    {
        if (count($points) < 2) {
            return '';
        }

        $d = "M {$points[0][0]},{$points[0][1]}";

        if ($curveFactor === null) {
            for ($i = 1; $i < count($points); $i++) {
                $d .= " L {$points[$i][0]},{$points[$i][1]}";
            }

            return $d;
        }

        for ($i = 0; $i < count($points) - 1; $i++) {
            $p0 = $points[$i - 1] ?? $points[$i];
            $p1 = $points[$i];
            $p2 = $points[$i + 1];
            $p3 = $points[$i + 2] ?? $points[$i + 1];

            $cp1x = $p1[0] + ($p2[0] - $p0[0]) / $curveFactor;
            $cp1y = $p1[1] + ($p2[1] - $p0[1]) / $curveFactor;

            $cp2x = $p2[0] - ($p3[0] - $p1[0]) / $curveFactor;
            $cp2y = $p2[1] - ($p3[1] - $p1[1]) / $curveFactor;

            $d .= sprintf(
                ' C %.2f,%.2f %.2f,%.2f %.2f,%.2f',
                $cp1x, $cp1y,
                $cp2x, $cp2y,
                $p2[0], $p2[1]
            );
        }

        return $d;
    }

    /**
     * @param  array{float, float}[]  $points
     */
    public function generateStepPath(array $points): string
    {
        if (count($points) < 2) {
            return '';
        }

        $d = "M {$points[0][0]},{$points[0][1]}";

        for ($i = 1; $i < count($points); $i++) {
            $current = $points[$i];

            $d .= " H {$current[0]}";

            $d .= " V {$current[1]}";
        }

        return $d;
    }
}
