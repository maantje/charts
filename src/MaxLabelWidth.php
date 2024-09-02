<?php

namespace Maantje\Phpviz;

trait MaxLabelWidth
{
    private function maxLabelWidth(float $maxValue): float
    {
        $maxLabelWidth = 0;

        for ($i = 0; $i <= 5; $i++) {
            $value = ($i / 5) * $maxValue;
            $labelText = number_format($value, 2);
            $textWidth = strlen($labelText) * 5;
            if ($textWidth > $maxLabelWidth) {
                $maxLabelWidth = $textWidth;
            }
        }

        return $maxLabelWidth;
    }
}
