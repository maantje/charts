<?php

namespace Maantje\Charts\SVG;

use Stringable;

readonly class Rect implements Stringable
{
    public function __construct(
        private float $x = 0,
        private float $y = 0,
        private float $width = 100,
        private float $height = 100,
        private string $fill = 'black',
        private float $fillOpacity = 1,
        private string $stroke = 'none',
        private float $strokeWidth = 0,
        private float $rx = 0,
        private float $ry = 0,
        public mixed $title = '',
        private ?string $transform = null
    ) {}

    public function __toString(): string
    {
        $attributes = sprintf(
            'x="%s" y="%s" width="%s" height="%s" fill="%s" fill-opacity="%s" stroke="%s" stroke-width="%s" rx="%s" ry="%s"',
            $this->x,
            $this->y,
            $this->width,
            $this->height,
            htmlspecialchars($this->fill, ENT_QUOTES),
            $this->fillOpacity,
            htmlspecialchars($this->stroke, ENT_QUOTES),
            $this->strokeWidth,
            $this->rx,
            $this->ry
        );

        if ($this->transform) {
            $attributes .= sprintf(' transform="%s"', htmlspecialchars($this->transform, ENT_QUOTES));
        }

        if ($this->title === '') {
            return sprintf('<rect %s/>', $attributes);
        }

        return sprintf('<rect %s><title>%s</title></rect>', $attributes, htmlspecialchars($this->title, ENT_QUOTES));
    }
}
