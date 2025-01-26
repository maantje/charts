<?php

namespace Maantje\Charts\SVG;

use Stringable;

class Line implements Stringable
{
    public function __construct(
        protected float $x1 = 0,
        protected float $y1 = 0,
        protected float $x2 = 100,
        protected float $y2 = 100,
        protected string $strokeDashArray = 'none',
        protected string $stroke = 'black',
        protected float $strokeWidth = 1,
        protected float $strokeOpacity = 1,
        protected ?string $transform = null
    ) {}

    public function __toString(): string
    {
        $attributes = sprintf(
            'x1="%s" y1="%s" x2="%s" y2="%s" stroke="%s" stroke-dasharray="%s" stroke-width="%s" stroke-opacity="%f"',
            $this->x1,
            $this->y1,
            $this->x2,
            $this->y2,
            htmlspecialchars($this->stroke, ENT_QUOTES),
            htmlspecialchars($this->strokeDashArray, ENT_QUOTES),
            $this->strokeWidth,
            $this->strokeOpacity,
        );

        if ($this->transform) {
            $attributes .= sprintf(' transform="%s"', htmlspecialchars($this->transform, ENT_QUOTES));
        }

        return sprintf('<line %s />', $attributes);
    }
}
