<?php

namespace Maantje\Charts\Boxplot;

use InvalidArgumentException;
use Maantje\Charts\Bar\BarContract;
use Maantje\Charts\Chart;
use Maantje\Charts\SVG\Circle;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Line;
use Maantje\Charts\SVG\Rect;
use Maantje\Charts\SVG\Text;

class Boxplot implements BarContract
{
    /** @var array<int, int|float> */
    public array $values;

    /**
     * @param  float[]  $values  min, Q1, median, Q3, max, then outliers
     */
    public function __construct(
        public string $name,
        array $values,
        public ?string $yAxis = null,
        public string $color = '#333',
        public float $strokeWidth = 2,
        public string $fillColor = '#3498db',
        public ?float $width = 60,
        public ?string $medianColor = null,
        public ?string $outlierColor = null,
        public float $outlierSize = 4,
        public ?string $labelColor = null,
        public int $labelMarginY = 30,
        public ?int $radius = null,
    ) {
        $this->values = array_values($values);

        if (count($this->values) < 5) {
            throw new InvalidArgumentException(sprintf(
                'Boxplot "%s" needs at least 5 values (min, Q1, median, Q3, max), %d given.',
                $this->name,
                count($this->values)
            ));
        }

        for ($i = 1; $i < 5; $i++) {
            if ($this->values[$i] < $this->values[$i - 1]) {
                throw new InvalidArgumentException(sprintf(
                    'Boxplot "%s" values must be ordered: min <= Q1 <= median <= Q3 <= max.',
                    $this->name
                ));
            }
        }
    }

    public function render(Chart $chart, float $x, float $maxWidth): string
    {
        $width = min($this->width ?? $maxWidth, $maxWidth);
        $x += ($maxWidth - $width) / 2;
        $centerX = $x + $width / 2;
        $capHalf = $width / 4;

        [$min, $q1, $median, $q3, $max] = array_map(
            fn (float $value) => $chart->yForAxis($value, $this->yAxis),
            array_slice($this->values, 0, 5)
        );

        $elements = [
            new Line(
                x1: $centerX,
                y1: $min,
                x2: $centerX,
                y2: $max,
                stroke: $this->color,
                strokeWidth: $this->strokeWidth
            ),
            new Line(
                x1: $centerX - $capHalf,
                y1: $min,
                x2: $centerX + $capHalf,
                y2: $min,
                stroke: $this->color,
                strokeWidth: $this->strokeWidth
            ),
            new Line(
                x1: $centerX - $capHalf,
                y1: $max,
                x2: $centerX + $capHalf,
                y2: $max,
                stroke: $this->color,
                strokeWidth: $this->strokeWidth
            ),
            new Rect(
                x: $x,
                y: $q3,
                width: $width,
                height: $q1 - $q3,
                fill: $this->fillColor,
                stroke: $this->color,
                strokeWidth: $this->strokeWidth,
                rx: $this->radius ?? 0,
                ry: $this->radius ?? 0,
                title: implode(' / ', array_slice($this->values, 0, 5))
            ),
            new Line(
                x1: $x,
                y1: $median,
                x2: $x + $width,
                y2: $median,
                stroke: $this->medianColor ?? $this->color,
                strokeWidth: $this->strokeWidth
            ),
        ];

        foreach (array_slice($this->values, 5) as $outlier) {
            $elements[] = new Circle(
                cx: $centerX,
                cy: $chart->yForAxis($outlier, $this->yAxis),
                r: $this->outlierSize,
                fill: $this->outlierColor ?? $this->color,
                title: $outlier
            );
        }

        if ($this->name !== '') {
            $elements[] = new Text(
                content: $this->name,
                x: $centerX,
                y: $chart->bottom() + $this->labelMarginY,
                fontFamily: $chart->fontFamily,
                fontSize: $chart->fontSize,
                fill: $this->labelColor ?? $chart->color,
                textAnchor: 'middle'
            );
        }

        return new Fragment($elements);
    }

    /**
     * The median, as the single value of the boxplot.
     */
    public function value(): float
    {
        return $this->values[2];
    }

    public function minValue(): float
    {
        return min($this->values);
    }

    public function maxValue(): float
    {
        return max($this->values);
    }
}
