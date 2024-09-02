<?php

namespace Maantje\Phpviz;

abstract class Element implements Renderable
{
    abstract public function maxValue(): float;

    abstract public function minValue(): float;
}
