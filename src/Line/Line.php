<?php

namespace Maantje\Charts\Line;

use Maantje\Charts\Chart;
use Maantje\Charts\Renderable;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Path;

class Line implements Renderable
{
    use GeneratesPaths;

    /**
     * @param  (Point|array{float, float})[]  $points
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
        $pointsSvg = '';
        $points = [];
        $minY = $chart->yForAxis($chart->minValue($this->yAxis), $this->yAxis);

        foreach ($this->points as $point) {
            [$x, $y] = is_array($point) ? $point : [$point->x, $point->y];

            $x = $chart->xFor($x);
            $y = $chart->yForAxis($y, $this->yAxis);

            $points[] = [$x, min($y, $minY)];

            if (! is_array($point)) {
                $pointsSvg .= $point->render($x, $y);
            }
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
     * @return float[]
     */
    public function xPoints(): array
    {
        return array_map(fn (Point|array $point) => is_array($point) ? $point[0] : $point->x, $this->points);
    }

    /**
     * @return float[]
     */
    public function yPoints(): array
    {
        return array_map(fn (Point|array $point) => is_array($point) ? $point[1] : $point->y, $this->points);
    }

    public function maxXValue(): float
    {
        return max($this->xPoints());
    }

    public function maxYValue(): float
    {
        return max($this->yPoints());
    }

    public function minYValue(): float
    {
        return min($this->yPoints());
    }
}
