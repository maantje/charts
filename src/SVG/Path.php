<?php

namespace Maantje\Charts\SVG;

readonly class Path
{
    public function __construct(
        private string $d = '',
        private string $fill = 'black',
        private string $stroke = 'none',
        private int $strokeWidth = 0,
    ) {}

    public function __toString(): string
    {
        $attributes = sprintf(
            'd="%s" fill="%s" stroke="%s" stroke-width="%s"',
            htmlspecialchars($this->d, ENT_QUOTES),
            htmlspecialchars($this->fill, ENT_QUOTES),
            htmlspecialchars($this->stroke, ENT_QUOTES),
            $this->strokeWidth,
        );

        return sprintf('<path %s />', $attributes);
    }
}
