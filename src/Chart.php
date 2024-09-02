<?php

namespace Maantje\Phpviz;

class Chart
{
    public float $leftMargin = 0;

    public array $maxValue = [];

    public array $minValue = [];

    /**
     * @param  Element[]  $elements
     * @param  YAxis[]  $yAxis
     */
    public function __construct(
        public float $width = 800,
        public float $height = 600,
        public ?string $background = null,
        public int $paddingY = 40,
        public int $paddingX = 20,
        public int $fontSize = 14,
        public readonly Grid $grid = new Grid,
        public array $yAxis = [],
        public XAxis $xAxis = new XAxis,
        public array $elements = [],
    ) {
        $this->yAxis = array_reduce($this->yAxis, function (array $carry, YAxis $yAxis) {
            $carry[$yAxis->name] = $yAxis;

            return $carry;
        }, []);
    }

    public function render(): string
    {

        $paddedWidth = $this->width + $this->paddingX * 2;
        $paddedHeight = $this->height + $this->paddingY * 2;

        return <<<SVG
            <svg width="$this->width" height="$this->height" viewBox="-$this->paddingX -$this->paddingY $paddedWidth $paddedHeight" xmlns="http://www.w3.org/2000/svg">
                {$this->background()}
                {$this->renderYAxis()}
                {$this->xAxis->render($this)}
                {$this->grid->render($this)}
                {$this->renderAnnotations()}
                {$this->renderElements()}
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

    protected function renderElements(): string
    {
        $svg = '';

        foreach ($this->elements as $element) {
            $svg .= $element->render($this);
        }

        return $svg;
    }

    protected function renderAnnotations(): string
    {
        $svg = '';

        foreach ($this->yAxis as $yAxis) {
            foreach ($yAxis->annotations as $annotation) {
                $svg .= $annotation->render($this);
            }
        }

        return $svg;
    }

    public function maxValue(?string $yAxis = null): float
    {
        if (array_key_exists($yAxis, $this->yAxis)) {
            return $this->yAxis[$yAxis]->maxValue;
        }

        if (array_key_exists($yAxis, $this->maxValue)) {
            return $this->maxValue[$yAxis];
        }

        $filtered = array_filter($this->elements, fn ($element) => $element->yAxis === $yAxis);

        return $this->maxValue[$yAxis] = max(array_map(fn ($element) => $element->maxValue(), $filtered));
    }

    public function minValue(?string $yAxis = null): float
    {
        if (array_key_exists($yAxis, $this->yAxis)) {
            return $this->yAxis[$yAxis]->minValue;
        }

        if (array_key_exists($yAxis, $this->minValue)) {
            return $this->minValue[$yAxis];
        }

        $filtered = array_filter($this->elements, fn ($element) => $element->yAxis === $yAxis);

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
}
