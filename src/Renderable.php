<?php

namespace Maantje\Charts;

interface Renderable
{
    public function render(Chart $chart): string;
}
