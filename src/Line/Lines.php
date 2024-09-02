<?php

namespace Maantje\Charts\Line;

use Maantje\Charts\Chart;
use Maantje\Charts\Element;

class Lines extends Element
{
    /**
     * @param Line[] $lines
     */
    public function __construct(
        public readonly array $lines,
        public ?string $yAxis = null,
    ) {
        parent::__construct($yAxis);
    }

    public function render(Chart $chart): string
    {
        $svg = '';

        foreach ($this->lines as $line) {
            $svg .= $line->render($chart);
        }

        return $svg;
    }

    public function maxValue(): float
    {
        $maxValue = 0;

        foreach ($this->lines as $dataSet) {
            $dataSetMax = max(array_map(fn (Point $point) => $point->y, $dataSet->points));
            if ($dataSetMax > $maxValue) {
                $maxValue = $dataSetMax;
            }
        }

        return $maxValue;
    }

    public function minValue(): float
    {
        $minValue = 0;

        foreach ($this->lines as $dataSet) {
            $dataSetMin = min(array_map(fn (Point $point) => $point->y, $dataSet->points));
            if ($dataSetMin < $minValue) {
                $minValue = $dataSetMin;
            }
        }

        return $minValue;
    }
}
