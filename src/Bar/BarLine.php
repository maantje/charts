<?php

namespace Maantje\Charts\Bar;

use Maantje\Charts\Chart;
use Maantje\Charts\Line\GeneratesPaths;
use Maantje\Charts\Line\Point;
use Maantje\Charts\Serie;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Path;

class BarLine extends Serie
{
    use GeneratesPaths;

    /**
     * @param  (float|null)[]|null  $values  one value per bar, in order; null leaves a gap. Defaults to the value of each bar.
     */
    public function __construct(
        public Bars $bars,
        public ?array $values = null,
        public int $size = 5,
        ?string $yAxis = null,
        public string $color = 'black',
        public ?string $areaColor = null,
        public ?float $curve = null,
        public bool $stepLine = false,
        public ?string $pointColor = null,
        public int $pointSize = 5,
    ) {
        parent::__construct($yAxis ?? $bars->yAxis);
    }

    public function render(Chart $chart): string
    {
        $minY = $chart->yForAxis($chart->minValue($this->yAxis), $this->yAxis);

        $segments = [];
        $points = [];
        $pointsSvg = '';

        foreach ($this->values() as $index => $value) {
            if ($value === null) {
                $segments[] = $points;
                $points = [];

                continue;
            }

            $x = $this->bars->slotCenter($chart, $index);
            $y = $chart->yForAxis($value, $this->yAxis);

            $points[] = [$x, min($y, $minY)];

            $pointsSvg .= (new Point(x: $index, y: $value, color: $this->pointColor, size: $this->pointSize))->render($x, $y);
        }

        $segments[] = $points;
        $segments = array_filter($segments, fn (array $points) => count($points) > 1);

        return new Fragment([
            ...array_map(fn (array $points) => $this->areaColor ? new Path(
                d: $this->generateAreaPath($points, $minY),
                fill: $this->areaColor,
                stroke: 'none'
            ) : null, $segments),
            ...array_map(fn (array $points) => new Path(
                d: $this->stepLine ? $this->generateStepPath($points) : $this->generateSmoothPath($points),
                fill: 'none',
                stroke: $this->color,
                strokeWidth: $this->size
            ), $segments),
            $pointsSvg,
        ]);
    }

    /**
     * The values drawn, one per bar; values beyond the last bar are left out.
     *
     * @return (float|null)[]
     */
    public function values(): array
    {
        return array_slice(array_values($this->values ?? $this->bars->values()), 0, $this->bars->count());
    }

    public function maxValue(): float
    {
        $values = array_filter($this->values(), fn (?float $value) => $value !== null);

        return count($values) === 0 ? 0 : max($values);
    }

    public function minValue(): float
    {
        $values = array_filter($this->values(), fn (?float $value) => $value !== null);

        return count($values) === 0 ? 0 : min($values);
    }
}
