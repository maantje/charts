<?php

namespace Maantje\Phpviz;

interface Renderable
{
    public function render(Chart $chart): string;
}
