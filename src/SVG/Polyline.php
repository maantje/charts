<?php

namespace Maantje\Charts\SVG;

use Stringable;

class Polyline implements Stringable
{
    /**
     * @param  array<int, array{float, float}>  $points
     */
    public function __construct(
        protected array $points = [],
        protected string $fill = 'black',
        protected string $stroke = 'black',
        protected float $strokeWidth = 1,
        protected ?string $transform = null
    ) {}

    public function __toString(): string
    {
        $pointsString = implode(' ', array_map(fn ($point) => implode(',', $point), $this->points));

        $attributes = sprintf(
            'points="%s" fill="%s" stroke="%s" stroke-width="%s"',
            htmlspecialchars($pointsString, ENT_QUOTES),
            htmlspecialchars($this->fill, ENT_QUOTES),
            htmlspecialchars($this->stroke, ENT_QUOTES),
            $this->strokeWidth
        );

        if ($this->transform) {
            $attributes .= sprintf(' transform="%s"', htmlspecialchars($this->transform, ENT_QUOTES));
        }

        return sprintf('<polyline %s />', $attributes);
    }
}
