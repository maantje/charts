<?php

namespace Maantje\Charts\SVG;

readonly class Path
{
    public function __construct(
        private string $d = '',
        private string $fill = '',
    ) {}

    public function __toString(): string
    {
        $attributes = sprintf(
            'd="%s" fill="%s"',
            htmlspecialchars($this->d, ENT_QUOTES),
            htmlspecialchars($this->fill, ENT_QUOTES),
        );

        return sprintf('<path %s />', $attributes);
    }
}
