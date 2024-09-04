<?php

namespace Maantje\Charts;

abstract class Serie implements Renderable
{
    public function __construct(public ?string $yAxis = null) {}

    abstract public function maxValue(): float;

    abstract public function minValue(): float;
}
