<?php

namespace Maantje\Charts\SVG;

use Stringable;

readonly class Fragment implements Stringable
{
    /**
     * @param  (string|null)[]  $children
     */
    public function __construct(public array $children)
    {
        //
    }

    public function __toString(): string
    {
        return implode(PHP_EOL, array_filter($this->children, fn (?string $item) => $item !== null));
    }
}
