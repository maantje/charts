<?php

namespace Maantje\Charts\Bar;

use Maantje\Charts\Chart;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Line;
use Maantje\Charts\SVG\Text;

class BarGroup implements BarContract
{
    /**
     * @param  Bar[]  $bars
     */
    public function __construct(
        private readonly string $name,
        private readonly int $margin = 5,
        private readonly int $width = 100,
        private readonly array $bars = [],
        public string $labelColor = '#333',
        public int $labelMarginY = 30,
        public ?int $fontSize = null,
        public ?int $radius = null,
    ) {
        if (is_null($this->radius)) {
            return;
        }

        foreach ($this->bars as $bar) {
            if (is_null($bar->radius)) {
                $bar->radius = $this->radius;
            }
        }
    }

    public function maxValue(): float
    {
        if (count($this->bars) === 0) {
            return 0;
        }

        return max(array_map(fn (BarContract $bar) => $bar->value(), $this->bars));
    }

    public function minValue(): float
    {
        if (count($this->bars) === 0) {
            return 0;
        }

        return min(array_map(fn (BarContract $bar) => $bar->value(), $this->bars));
    }

    public function render(Chart $chart, float $x, float $maxGroupWidth): string
    {
        $numBars = count($this->bars);
        $barWidth = 0;

        if ($numBars > 0) {
            $barWidth = min($maxGroupWidth, $this->width) / $numBars;
        }

        $labelX = $x + ($maxGroupWidth / 2);
        $startX = $x;
        $x += ($maxGroupWidth / 2) - (($barWidth + $this->margin) * $numBars / 2);

        return new Fragment([
            new Line(
                x1: $startX,
                y1: $chart->bottom(),
                x2: $startX,
                y2: $chart->bottom() + 10,
            ),
            ...array_map(function (BarContract $bar) use ($barWidth, &$x, $chart) {
                $svg = $bar->render($chart, $x + $this->margin, $barWidth);
                $x += $this->margin + $barWidth;

                return $svg;
            }, $this->bars),
            new Line(
                x1: $startX + $maxGroupWidth,
                y1: $chart->bottom(),
                x2: $startX + $maxGroupWidth,
                y2: $chart->bottom() + 10,
            ),
            new Text(
                content: $this->name,
                x: $labelX,
                y: $chart->bottom() + $this->labelMarginY,
                fontFamily: $chart->fontFamily,
                fontSize: $this->fontSize ?? $chart->fontSize,
                fill: $this->labelColor,
                textAnchor: 'middle'
            ),
        ]);
    }

    public function value(): float
    {
        return $this->maxValue();
    }
}
