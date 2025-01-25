<?php

namespace Maantje\Charts\SVG;

use Stringable;

class Polygon implements Stringable
{
    /**
     * @param  array<int, array{float, float}>  $points
     */
    public function __construct(
        protected array $points = [],
        protected string $fill = 'black',
        protected string $stroke = 'none',
        protected float $strokeWidth = 0,
        protected string $pointerEvents = 'none',
        protected ?string $transform = null
    ) {}

    public function __toString(): string
    {
        $pointsString = implode(' ', array_map(fn ($point) => implode(',', $point), $this->points));

        $attributes = sprintf(
            'points="%s" fill="%s" stroke="%s" stroke-width="%s" pointer-events="%s"',
            htmlspecialchars($pointsString, ENT_QUOTES),
            htmlspecialchars($this->fill, ENT_QUOTES),
            htmlspecialchars($this->stroke, ENT_QUOTES),
            $this->strokeWidth,
            htmlspecialchars($this->pointerEvents, ENT_QUOTES),
        );

        if ($this->transform) {
            $attributes .= sprintf(' transform="%s"', htmlspecialchars($this->transform, ENT_QUOTES));
        }

        return sprintf('<polygon %s />', $attributes);
    }
}
