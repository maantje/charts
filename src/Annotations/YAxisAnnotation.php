<?php

namespace Maantje\Charts\Annotations;

interface YAxisAnnotation
{
    public function yAxis(): ?string;

    public function setYAxis(string $yAxis): void;
}
