<?php

namespace Maantje\Charts\SVG;

use Stringable;

class Text implements Stringable
{
    public function __construct(
        protected null|int|float|string $content,
        protected float $x = 0,
        protected float $y = 0,
        protected string $fontFamily = 'Arial',
        protected int $fontSize = 16,
        protected string $fill = 'black',
        protected string $stroke = 'none',
        protected float $strokeWidth = 0,
        protected string $textAnchor = 'start',
        protected string $dominantBaseline = 'alphabetic',
        protected string $alignmentBaseline = 'auto',
        protected ?string $transform = null
    ) {
        //
    }

    public function __toString(): string
    {
        $attributes = sprintf(
            'x="%s" y="%s" font-family="%s" font-size="%s" fill="%s" stroke="%s" stroke-width="%s" text-anchor="%s" dominant-baseline="%s" alignment-baseline="%s"',
            $this->x,
            $this->y,
            htmlspecialchars($this->fontFamily, ENT_QUOTES),
            $this->fontSize,
            htmlspecialchars($this->fill, ENT_QUOTES),
            htmlspecialchars($this->stroke, ENT_QUOTES),
            $this->strokeWidth,
            htmlspecialchars($this->textAnchor, ENT_QUOTES),
            htmlspecialchars($this->dominantBaseline, ENT_QUOTES),
            htmlspecialchars($this->alignmentBaseline, ENT_QUOTES),
        );

        if ($this->transform) {
            $attributes .= sprintf(' transform="%s"', htmlspecialchars($this->transform, ENT_QUOTES));
        }

        if ($this->content === null || $this->content === '') {
            return '';
        }

        return sprintf('<text %s>%s</text>', $attributes, htmlspecialchars((string) $this->content, ENT_QUOTES));
    }
}
