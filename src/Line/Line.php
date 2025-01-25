<?php

namespace Maantje\Charts\Line;

use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Path;

class Line implements Renderable
{
    /**
     * @param  Point[]  $points
     */
    public function __construct(
        public array $points = [],
        public int $size = 5,
        public ?string $yAxis = null,
        public string $color = 'black',
        public ?string $areaColor = null,
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

        $linePath = $this->stepLine
            ? $this->generateStepPath($points)
            : $this->generateSmoothPath($points);

        $areaPath = $this->generateAreaPath($points, $minY);

        return new Fragment([
            $this->areaColor ? new Path(
                d: $areaPath,
                fill: $this->areaColor,
                stroke: 'none'
            ) : null,
            new Path(
                d: $linePath,
                fill: 'none',
                stroke: $this->color,
                strokeWidth: $this->size
            ),
            $pointsSvg,
        ]);
    }

    /**
     * @param  array{float, float}[]  $points
     */
    protected function generateAreaPath(array $points, float $minY): string
    {
        if (count($points) < 2) {
            return '';
        }

        $startX = $points[0][0];
        $startY = $points[0][1];
        $path = "M $startX,$startY";
        $path .= $this->generateMiddleAreaPath($points);

        $lastPoint = end($points);
        $firstX = $points[0][0];
        $path .= " L $lastPoint[0],$minY L $firstX,$minY Z";

        return $path;
    }

    /**
     * @param  array{float, float}[]  $points
     */
    protected function generateMiddleAreaPath(array $points): string
    {
        return match (true) {
            $this->stepLine => $this->generateStepSegments($points),
            $this->curve !== null => $this->generateCurveSegments($points),
            default => $this->generateStraightSegments($points)
        };
    }

    /**
     * @param  array{float, float}[]  $points
     */
    protected function generateStepSegments(array $points): string
    {
        $path = '';
        foreach (array_slice($points, 1) as $next) {
            $path .= " H $next[0] V $next[1]";
        }

        return $path;
    }

    /**
     * @param  array{float, float}[]  $points
     */
    protected function generateCurveSegments(array $points): string
    {
        $path = '';
        for ($i = 0; $i < count($points) - 1; $i++) {
            [$cp1x, $cp1y, $cp2x, $cp2y] = $this->curveControlPoints($points, $i);
            $p2 = $points[$i + 1];
            $path .= sprintf(' C %.2f,%.2f %.2f,%.2f %.2f,%.2f',
                $cp1x, $cp1y, $cp2x, $cp2y, $p2[0], $p2[1]);
        }

        return $path;
    }

    /**
     * @param  array{float, float}[]  $points
     * @return array{float, float, float, float}
     */
    protected function curveControlPoints(array $points, int $i): array
    {
        $p0 = $points[$i - 1] ?? $points[$i];
        $p1 = $points[$i];
        $p2 = $points[$i + 1];
        $p3 = $points[$i + 2] ?? $p2;

        $cp1x = $p1[0] + ($p2[0] - $p0[0]) / $this->curve;
        $cp1y = $p1[1] + ($p2[1] - $p0[1]) / $this->curve;
        $cp2x = $p2[0] - ($p3[0] - $p1[0]) / $this->curve;
        $cp2y = $p2[1] - ($p3[1] - $p1[1]) / $this->curve;

        return [$cp1x, $cp1y, $cp2x, $cp2y];
    }

    /**
     * @param  array{float, float}[]  $points
     */
    protected function generateStraightSegments(array $points): string
    {
        $path = '';
        foreach (array_slice($points, 1) as [$x, $y]) {
            $path .= " L $x,$y";
        }

        return $path;
    }

    /**
     * @param  array{float, float}[]  $points
     */
    protected function generateSmoothPath(array $points): string
    {
        if (count($points) < 2) {
            return '';
        }

        $d = "M {$points[0][0]},{$points[0][1]}";

        if ($this->curve === null) {
            return $d.$this->generateStraightSegments($points);
        }

        return $d.$this->generateCurveSegments($points);
    }

    /**
     * @param  array{float, float}[]  $points
     */
    protected function generateStepPath(array $points): string
    {
        if (count($points) < 2) {
            return '';
        }

        return "M {$points[0][0]},{$points[0][1]}".$this->generateStepSegments($points);
    }
}
