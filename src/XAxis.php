<?php

namespace Maantje\Charts;

use Closure;
use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Line;
use Maantje\Charts\SVG\Text;

class XAxis implements Renderable
{
    public Closure $formatter;

    /**
     * @param  float[]  $data
     * @param  Renderable[]  $annotations
     */
    public function __construct(
        public array $data = [],
        public string $title = '',
        public ?float $minValue = null,
        public ?float $maxValue = null,
        public array $annotations = [],
        public ?string $color = null,
        public int $fontSize = 14,
        public ?string $fontFamily = null,
        ?Closure $formatter = null
    ) {
        $this->formatter = $formatter ?? fn (mixed $label) => number_format($label);
    }

    public function maxValue(): float
    {
        if ($this->maxValue !== null) {
            return $this->maxValue;
        }

        if (count($this->data) === 0) {
            return 0;
        }

        return max(array_map(fn (float $data) => $data, $this->data));
    }

    public function minValue(): float
    {
        if ($this->minValue !== null) {
            return $this->minValue;
        }

        if (count($this->data) === 0) {
            return 0;
        }

        return min(array_map(fn (float $data) => $data, $this->data));
    }

    public function render(Chart $chart): string
    {
        $labelCount = count($this->data);

        $svg = new Line(
            x1: $chart->left(),
            y1: $chart->bottom(),
            x2: $chart->right(),
            y2: $chart->bottom(),
            stroke: $this->color ?? $chart->color,
        );

        for ($i = 0; $i < $labelCount; $i++) {
            $x = $chart->xFor($this->data[$i]);
            $y = $chart->bottom() + 25;

            $label = $this->formatter->call($this, $this->data[$i]);
            $lineY = $chart->bottom() - 5;

            $svg .= new Fragment([
                new Text(
                    content: $label,
                    x: $x,
                    y: $y,
                    fontFamily: $this->fontFamily ?? $chart->fontFamily,
                    fontSize: $this->fontSize ?? $chart->fontSize,
                    fill: $this->color ?? $chart->color,
                    textAnchor: 'middle'
                ),
                new Line(
                    x1: $x,
                    y1: $chart->bottom(),
                    x2: $x,
                    y2: $lineY,
                    stroke: $this->color ?? $chart->color
                ),
            ]);
        }

        $titleX = $chart->availableWidth() / 2 + $chart->left();
        $titleY = $chart->bottom() + 40;

        $svg .= new Text(
            content: $this->title,
            x: $titleX,
            y: $titleY,
            fontFamily: $this->fontFamily ?? $chart->fontFamily,
            fontSize: $this->fontSize ?? $chart->fontSize,
            fill: $this->color ?? $chart->color,
            textAnchor: 'middle',
        );

        return $svg;
    }
}
