<?php

namespace Maantje\Charts;

use Maantje\Charts\Annotations\XAxis\XAxisLineAnnotation;
use Maantje\Charts\Annotations\YAxis\YAxisLineAnnotation;
use Maantje\Charts\Annotations\YAxis\YAxisRangeAnnotation;
use Maantje\Charts\Line\Lines;
use Maantje\Charts\Line\Point;

class Chart
{
    public float $leftMargin = 0;

    public array $maxValue = [];

    public array $minValue = [];

    /**
     * @var YAxis[]  $yAxis
     */
    public array $yAxis = [];

    /**
     * @param  Element[]  $series
     * @param  YAxis|YAxis[]  $yAxis
     */
    public function __construct(
        public float $width = 800,
        public float $height = 600,
        public ?string $background = 'white',
        public int $paddingY = 40,
        public int $paddingX = 20,
        public int $fontSize = 14,
        public string $fontFamily = 'arial',
        public readonly Grid $grid = new Grid,
        YAxis|array $yAxis = new YAxis(
            minValue: 0,
        ),
        public XAxis $xAxis = new XAxis(),
        public array $series = [],
    ) {
        $this->yAxis = is_array($yAxis) ? $yAxis : [$yAxis];
        $this->yAxis = array_reduce($this->yAxis, function (array $carry, YAxis $yAxis) {
            $carry[$yAxis->name ?? 'default'] = $yAxis;

            return $carry;
        }, []);

        if (count($this->yAxis) === 0) {
            $this->yAxis['default'] = new YAxis('default');
        }

        if (sizeof($this->xAxis->data) === 0) {
          $this->guessXAxisData();
        }
    }

    public function render(): string
    {

        $paddedWidth = $this->width + $this->paddingX * 2;
        $paddedHeight = $this->height + $this->paddingY * 2;

        return <<<SVG
            <svg width="$this->width" height="$this->height" viewBox="-$this->paddingX -$this->paddingY $paddedWidth $paddedHeight" xmlns="http://www.w3.org/2000/svg">
                {$this->background()}
                {$this->renderYAxis()}
                {$this->xAxis?->render($this)}
                {$this->grid->render($this)}
                {$this->renderAnnotations([YAxisRangeAnnotation::class])}
                {$this->renderSeries()}
                {$this->renderAnnotations([YAxisLineAnnotation::class, XAxisLineAnnotation::class])}
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

    public function yForAxis(float $y, ?string $axis = null): float
    {
        return $this->height - (($y - $this->minValue($axis)) / ($this->maxValue($axis) - $this->minValue($axis))) * $this->height;
    }

    protected function renderSeries(): string
    {
        $svg = '';

        foreach ($this->series as $serie) {
            $svg .= $serie->render($this);
        }

        return $svg;
    }

    protected function renderAnnotations(array $types): string
    {
        $svg = '';

        foreach ([...$this->yAxis, $this->xAxis] as $axis) {
            foreach ($axis->annotations as $annotation) {
                if (in_array(get_class($annotation), $types)) {
                    $svg .= $annotation->render($this);
                }
            }
        }

        return $svg;
    }

    public function maxValue(?string $yAxis = null): float
    {
        $yAxis = $yAxis ?? 'default';

        if (array_key_exists($yAxis, $this->yAxis) && !is_null($this->yAxis[$yAxis]->maxValue)) {
            return $this->yAxis[$yAxis]->maxValue;
        }

        if (array_key_exists($yAxis, $this->maxValue)) {
            return $this->maxValue[$yAxis];
        }

        $filtered = array_filter($this->series, fn ($element) => $element->yAxis ?? $yAxis === 'default');

        return $this->maxValue[$yAxis] = max(array_map(fn ($element) => $element->maxValue(), $filtered));
    }

    public function minValue(?string $yAxis = null): float
    {
        $yAxis = $yAxis ?? 'default';

        if (array_key_exists($yAxis, $this->yAxis) && !is_null($this->yAxis[$yAxis]->minValue)) {
            return $this->yAxis[$yAxis]->minValue;
        }

        if (array_key_exists($yAxis, $this->minValue)) {
            return $this->minValue[$yAxis];
        }

        $filtered = array_filter($this->series, fn ($element) => $element->yAxis ?? $yAxis === 'default');

        return $this->minValue[$yAxis] = min(array_map(fn ($element) => $element->minValue(), $filtered));
    }

    private function background(): string
    {
        if (is_null($this->background)) {
            return '';
        }

        return <<<SVG
            <rect width="100%" height="100%" x="-$this->paddingX" y="-$this->paddingY" fill="$this->background" /> 
            SVG;
    }

    public function end(): float
    {
        return $this->width;
    }

    private function guessXAxisData(): void
    {
        if (sizeof($this->series) === 0) {
            return;
        }

        $firstSeries = $this->series[0];

        if ($firstSeries instanceof Lines) {
            $this->xAxis->data = array_map(fn (Point $point) => $point->x, $firstSeries->lines[0]->points);
        }
    }
}
