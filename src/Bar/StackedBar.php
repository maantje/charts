<?php

namespace Maantje\Charts\Bar;

use Closure;
use Maantje\Charts\Chart;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Rect;
use Maantje\Charts\SVG\Text;

class StackedBar implements BarContract
{
    /**
     * @param  Segment[]  $segments
     */
    public function __construct(
        public string $name,
        public array $segments = [],
        public ?string $yAxis = null,
        public string $color = '#3498db',
        public ?float $width = 100,
        public ?string $labelColor = null,
        public int $labelMarginY = 30,
        public bool $percentage = false,
        public ?Closure $formatter = null
    ) {
        //
    }

    public function render(Chart $chart, float $x, float $maxBarWidth): string
    {
        $width = min($this->width ?? $maxBarWidth, $maxBarWidth);
        $initialY = $chart->yForAxis($this->value(), $this->yAxis);
        $currentY = $chart->bottom();

        if (! is_null($this->width)) {
            $x += ($maxBarWidth - $width) / 2;
        }

        $labelX = $x + $width / 2;

        return new Fragment([
            ...array_map(function (Segment $segment) use ($width, $x, $initialY, $chart, &$currentY) {
                $segmentHeight = $segment->value * ($chart->bottom() - $initialY) / $this->value();
                $currentY -= $segmentHeight;

                return new Fragment([
                    new Rect(
                        x: $x,
                        y: $currentY,
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
                        y: $currentY + $segmentHeight - 10,
                        fontFamily: $chart->fontFamily,
                        fontSize: $chart->fontSize,
                        fill: $segment->labelColor ?? $chart->color,
                        textAnchor: 'middle'
                    ),
                ]);
            }, $this->segments),
            new Text(
                content: $this->name,
                x: $labelX,
                y: $chart->bottom() + $this->labelMarginY,
                fontFamily: $chart->fontFamily,
                fontSize: $chart->fontSize,
                fill: $this->labelColor ?? $chart->color,
                textAnchor: 'middle'
            ),
        ]);
    }

    public function value(): float
    {
        return array_sum(array_map(fn (Segment $segment) => $segment->value, $this->segments));
    }
}
