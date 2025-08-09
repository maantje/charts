<?php

namespace Maantje\Charts\Bar;

use Closure;
use Maantje\Charts\Chart;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Rect;
use Maantje\Charts\SVG\Text;

class StackedBar extends AbstractBar
{
    /**
     * @param  Segment[]  $segments
     */
    public function __construct(
        string $name,
        public array $segments = [],
        ?string $yAxis = null,
        string $color = '#3498db',
        ?float $width = 100,
        ?string $labelColor = null,
        int $labelMarginY = 30,
        public bool $percentage = false,
        public ?Closure $formatter = null
    ) {
        parent::__construct($name, $yAxis, $color, $width, $labelColor, $labelMarginY);
    }

    public function render(Chart $chart, float $x, float $maxBarWidth): string
    {
        $width = $this->calculateWidth($maxBarWidth);
        $x = $this->calculateX($x, $width, $maxBarWidth);
        $labelX = $this->calculateLabelX($x, $width);

        $initialY = $chart->yForAxis($this->value(), $this->yAxis);
        $zeroY = $chart->zeroLineY($this->yAxis);
        $currentY = $zeroY;

        return new Fragment([
            ...array_map(function (Segment $segment) use ($width, $x, $initialY, $chart, &$currentY, $zeroY) {
                $totalBarHeight = abs($initialY - $zeroY);
                $segmentHeight = abs($segment->value) * $totalBarHeight / abs($this->value());

                $nextY = $this->value() < 0 ? $currentY + $segmentHeight : $currentY - $segmentHeight;
                $rectY = min($currentY, $nextY);
                $currentY = $nextY;

                return new Fragment([
                    new Rect(
                        x: $x,
                        y: $rectY,
                        width: $width,
                        height: $segmentHeight,
                        fill: $segment->color ?? $this->color,
                        title: $segment->value
                    ),
                    new Text(
                        content: $this->percentage
                            ? number_format(($segment->value / $this->value()) * 100).'%'
                            : $this->formatter?->call($this, $segment->value),
                        x: $x + $width / 2,
                        y: $rectY + $segmentHeight - 10,
                        fontFamily: $chart->fontFamily,
                        fontSize: $chart->fontSize,
                        fill: $segment->labelColor ?? $chart->color,
                        textAnchor: 'middle'
                    ),
                ]);
            }, $this->segments),
            $this->renderLabel($chart, $labelX),
        ]);
    }

    public function value(): float
    {
        return array_sum(array_map(fn (Segment $segment) => $segment->value, $this->segments));
    }

    public function maxValue(): float
    {
        return $this->value();
    }

    public function minValue(): float
    {
        return $this->value();
    }
}
