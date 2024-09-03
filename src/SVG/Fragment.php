<?php

namespace Maantje\Charts\SVG;

use Stringable;

readonly class Fragment implements Stringable
{
    /**
     * @param  string[]  $children
     */
    public function __construct(public array $children)
    {
        //
    }

    public function __toString(): string
    {
        return implode(PHP_EOL, $this->children);
    }
}
