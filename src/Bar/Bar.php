<?php

namespace Maantje\Charts\Bar;

use Maantje\Charts\Chart;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Rect;

class Bar extends AbstractBar
{
    public function __construct(
        ?string $name = null,
        public float $value = 0,
        ?string $yAxis = null,
        string $color = '#3498db',
        ?float $width = 100,
        ?string $labelColor = null,
        public ?int $fontSize = null,
        public ?string $fontFamily = null,
        int $labelMarginY = 30,
        public ?int $radius = null,
    ) {
        parent::__construct($name, $yAxis, $color, $width, $labelColor, $labelMarginY);
    }

    public function render(Chart $chart, float $x, float $maxBarWidth): string
    {
        $width = $this->calculateWidth($maxBarWidth);
        $x = $this->calculateX($x, $width, $maxBarWidth);
        $labelX = $this->calculateLabelX($x, $width);

        $valueY = $chart->yForAxis($this->value, $this->yAxis);
        $baseline = $chart->minValue($this->yAxis) >= 0 ? $chart->bottom() : $chart->zeroLineY($this->yAxis);

        $y = min($valueY, $baseline);
        $height = abs($valueY - $baseline);

        return new Fragment([
            new Rect(
                x: $x,
                y: $y,
                width: $width,
                height: $height,
                fill: $this->color,
                rx: $this->radius ?? 0,
                ry: $this->radius ?? 0,
                title: $this->value,
            ),
            $this->renderLabel($chart, $labelX),
        ]);
    }

    public function value(): float
    {
        return $this->value;
    }

    public function maxValue(): float
    {
        return $this->value;
    }

    public function minValue(): float
    {
        return $this->value;
    }
}
