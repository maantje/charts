<?php

namespace Maantje\Phpviz;

class Chart
{
    use MaxLabelWidth;

    /**
     * @param  Element[]  $elements
     * @param  Renderable[]  $annotations
     */
    public function __construct(
        public readonly float $width = 500,
        public readonly float $height = 300,
        public readonly Grid $grid = new Grid,
        public array $elements = [],
        public array $annotations = [],
        public ?float $maxValue = null,
        public ?float $minValue = null,
    ) {}

    public function render(): string
    {
        $maxValue = $this->maxValue();
        $minValue = $this->minValue();
        $labelWidth = $this->maxLabelWidth($maxValue);

        return <<<SVG
            <svg width="$this->width" height="$this->height" xmlns="http://www.w3.org/2000/svg">
                {$this->grid->render($this->height, $this->width, $labelWidth, $minValue, $maxValue)}
                {$this->renderAnnotations($labelWidth + 20, $minValue, $maxValue)}
                {$this->renderElements($labelWidth + 20, $minValue, $maxValue)}
            </svg>
            SVG;
    }

    protected function yForAxis(float $y, string $axis = 'default')
    {
        $this->height - 20 - (($y - $this->minValue()) / ($this->maxValue() - $this->minValue())) * ($this->height - 50);
    }

    protected function renderElements(float $leftMargin, float $minValue, float $maxValue): string
    {
        $svg = '';

        foreach ($this->elements as $element) {
            $svg .= $element->render($this->height, $this->width, $leftMargin, $minValue, $maxValue);
        }

        return $svg;
    }

    protected function renderAnnotations(float $leftMargin, float $minValue, float $maxValue): string
    {
        $svg = '';

        foreach ($this->annotations as $annotation) {
            $svg .= $annotation->render($this->height, $this->width, $leftMargin, $minValue, $maxValue);
        }

        return $svg;
    }


    protected function maxValue(): float
    {
        if ($this->maxValue) {
            return $this->maxValue;
        }

        return $this->maxValue = max(array_map(fn ($element) => $element->maxValue(), $this->elements));
    }

    protected function minValue(): float
    {
        if ($this->minValue) {
            return $this->minValue;
        }

        return $this->minValue = min(array_map(fn ($element) => $element->minValue(), $this->elements));
    }
}
