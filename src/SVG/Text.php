<?php

namespace Maantje\Charts\SVG;

use Stringable;

class Text implements Stringable
{
    public function __construct(
        private null|int|float|string $content,
        private float $x = 0,
        private float $y = 0,
        private string $fontFamily = 'Arial',
        private int $fontSize = 16,
        private string $fill = 'black',
        private string $stroke = 'none',
        private float $strokeWidth = 0,
        private string $textAnchor = 'start',
        private string $dominantBaseline = 'alphabetic',
        private ?string $transform = null
    ) {
        if (is_null($this->content)) {
            $this->content = '';
        }
    }

    public function __toString(): string
    {
        $attributes = sprintf(
            'x="%s" y="%s" font-family="%s" font-size="%s" fill="%s" stroke="%s" stroke-width="%s" text-anchor="%s" dominant-baseline="%s"',
            $this->x,
            $this->y,
            htmlspecialchars($this->fontFamily, ENT_QUOTES),
            $this->fontSize,
            htmlspecialchars($this->fill, ENT_QUOTES),
            htmlspecialchars($this->stroke, ENT_QUOTES),
            $this->strokeWidth,
            htmlspecialchars($this->textAnchor, ENT_QUOTES),
            htmlspecialchars($this->dominantBaseline, ENT_QUOTES)
        );

        if ($this->transform) {
            $attributes .= sprintf(' transform="%s"', htmlspecialchars($this->transform, ENT_QUOTES));
        }

        return sprintf('<text %s>%s</text>', $attributes, htmlspecialchars((string) $this->content, ENT_QUOTES));
    }
}
