<?php

namespace Maantje\Charts\SVG;

use Stringable;

readonly class Line implements Stringable
{
    public function __construct(
        private float $x1 = 0,
        private float $y1 = 0,
        private float $x2 = 100,
        private float $y2 = 100,
        private string $strokeDashArray = 'none',
        private string $stroke = 'black',
        private float $strokeWidth = 1,
        private ?string $transform = null
    ) {}

    public function __toString(): string
    {
        $attributes = sprintf(
            'x1="%s" y1="%s" x2="%s" y2="%s" stroke="%s" stroke-dasharray="%s" stroke-width="%s"',
            $this->x1,
            $this->y1,
            $this->x2,
            $this->y2,
            htmlspecialchars($this->stroke, ENT_QUOTES),
            htmlspecialchars($this->strokeDashArray, ENT_QUOTES),
            $this->strokeWidth
        );

        if ($this->transform) {
            $attributes .= sprintf(' transform="%s"', htmlspecialchars($this->transform, ENT_QUOTES));
        }

        return sprintf('<line %s />', $attributes);
    }
}
