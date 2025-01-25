<?php

namespace Maantje\Charts\SVG;

use Stringable;

class Rect implements Stringable
{
    public function __construct(
        protected float $x = 0,
        protected float $y = 0,
        protected float $width = 100,
        protected float $height = 100,
        protected string $fill = 'black',
        protected float $fillOpacity = 1,
        protected string $stroke = 'none',
        protected float $strokeWidth = 0,
        protected float $rx = 0,
        protected float $ry = 0,
        public mixed $title = '',
        protected ?string $transform = null
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
