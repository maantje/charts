<?php

namespace Maantje\Charts;

use Maantje\Charts\Annotations\RendersAfterSeries;
use Maantje\Charts\Annotations\RendersBeforeSeries;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;
use Maantje\Charts\SVG\Rect;

class Chart
{
    /** @var array<string, float> */
    public array $maxValue = [];

    /** @var array<string, float> */
    public array $minValue = [];

    /**
     * @var YAxis[]
     */
    public array $yAxis = [];

    /**
     * @param  Serie[]  $series
     * @param  Renderable[]  $annotations
     * @param  YAxis|YAxis[]  $yAxis
     */
    public function __construct(
        protected float $width = 800,
        protected float $height = 600,
        public ?string $background = 'white',
        public int $fontSize = 14,
        public string $fontFamily = 'arial',
        public readonly Grid $grid = new Grid,
        YAxis|array $yAxis = new YAxis(
            minValue: 0,
        ),
        public XAxis $xAxis = new XAxis,
        public array $annotations = [],
        public array $series = [],
        protected float $leftMargin = 10,
        protected float $rightMargin = 30,
        protected float $bottomMargin = 50,
        protected float $topMargin = 25,
    ) {
        $this->yAxis = is_array($yAxis) ? $yAxis : [$yAxis];
        $this->yAxis = array_reduce($this->yAxis, function (array $carry, YAxis $yAxis) {
            $carry[$yAxis->name ?? 'default'] = $yAxis;

            return $carry;
        }, []);

        if (count($this->yAxis) === 0) {
            $this->yAxis['default'] = new YAxis('default');
        }

        if (count($this->xAxis->data) === 0) {
            $this->guessXAxisData();
        }
    }

    public function render(): string
    {
        return <<<SVG
            <svg width="$this->width" height="$this->height"  xmlns="http://www.w3.org/2000/svg">
                {$this->background()}
                {$this->renderYAxis()}
                {$this->xAxis->render($this)}
                {$this->grid->render($this)}
                {$this->renderAnnotations(RendersBeforeSeries::class)}
                {$this->renderSeries()}
                {$this->renderAnnotations(RendersAfterSeries::class)}
            </svg>
            SVG;
    }

    public function renderYAxis(): string
    {
        $svg = '';

        foreach ($this->yAxis as $yAxis) {
            $svg .= $yAxis->render($this);
        }

        return $svg;
    }

    public function xFor(float $x): float
    {
        return $this->leftMargin + (($x - $this->xAxis->minValue()) / ($this->xAxis->maxValue() - $this->xAxis->minValue())) * ($this->width - $this->leftMargin - $this->rightMargin);
    }

    public function yForAxis(float $y, ?string $axis = null): float
    {
        return $this->topMargin + $this->availableHeight() - (($y - $this->minValue($axis)) / ($this->maxValue($axis) - $this->minValue($axis))) * ($this->availableHeight());
    }

    protected function renderSeries(): string
    {
        $svg = '';

        foreach ($this->series as $serie) {
            $svg .= $serie->render($this);
        }

        return $svg;
    }

    /**
     * @param  class-string  $interface
     */
    protected function renderAnnotations(string $interface): string
    {
        $svg = '';

        foreach ([...$this->yAxis, $this->xAxis] as $axis) {
            foreach ($axis->annotations as $annotation) {
                if (is_a($annotation, $interface)) {
                    $svg .= $annotation->render($this);
                }
            }
        }

        return $svg;
    }

    public function maxValue(?string $yAxis = null): float
    {
        $yAxis = $yAxis ?? 'default';

        if (array_key_exists($yAxis, $this->yAxis) && ! is_null($this->yAxis[$yAxis]->maxValue)) {
            return $this->yAxis[$yAxis]->maxValue;
        }

        if (array_key_exists($yAxis, $this->maxValue)) {
            return $this->maxValue[$yAxis];
        }

        $filtered = array_filter($this->series, fn ($element) => ($element->yAxis ?? 'default') === $yAxis);

        return $this->maxValue[$yAxis] = max(array_map(fn ($element) => $element->maxValue(), $filtered));
    }

    public function minValue(?string $yAxis = null): float
    {
        $yAxis = $yAxis ?? 'default';

        if (array_key_exists($yAxis, $this->yAxis) && ! is_null($this->yAxis[$yAxis]->minValue)) {
            return $this->yAxis[$yAxis]->minValue;
        }

        if (array_key_exists($yAxis, $this->minValue)) {
            return $this->minValue[$yAxis];
        }

        $filtered = array_filter($this->series, fn ($element) => ($element->yAxis ?? 'default') === $yAxis);

        return $this->minValue[$yAxis] = min(array_map(fn ($element) => $element->minValue(), $filtered));
    }

    protected function background(): string
    {
        if (is_null($this->background)) {
            return '';
        }

        return new Rect(
            width: $this->width,
            height: $this->height,
            fill: $this->background,
        );
    }

    public function availableHeight(): float
    {
        return $this->height - $this->bottomMargin - $this->topMargin;
    }

    public function availableWidth(): float
    {
        return $this->width - $this->rightMargin - $this->leftMargin;
    }

    public function top(): float
    {
        return $this->topMargin;
    }

    public function bottom(): float
    {
        return $this->height - $this->bottomMargin;
    }

    public function left(): float
    {
        return $this->leftMargin;
    }

    public function right(): float
    {
        return $this->width - $this->rightMargin;
    }

    public function incrementLeftMargin(float $value): void
    {
        $this->leftMargin += $value;
    }

    protected function guessXAxisData(): void
    {
        if (count($this->series) === 0) {
            return;
        }

        $firstSeries = $this->series[0];

        if ($firstSeries instanceof Lines) {
            $this->xAxis->data = array_map(fn (Point $point) => $point->x, $firstSeries->lines[0]->points);
        }
    }
}
