<?php

namespace Maantje\Charts\Pie;

class PieChart
{
    public function __construct(
        private readonly PieOptions $options,
        private readonly array $data,
    ) {}

    public function render(): string
    {
        return <<<SVG
            <svg width="{$this->options->size}" height="{$this->options->size}" viewBox="0 0 {$this->options->size} {$this->options->size}" xmlns="http://www.w3.org/2000/svg">
                {$this->renderSlices()}
            </svg>
            SVG;
    }

    private function renderSlices(): string
    {
        $total = array_sum(array_map(fn ($data) => $data->value, $this->data));
        $maxExplodeDistance = max(array_map(fn ($data) => $data->explodeDistance, $this->data));
        $cx = $this->options->size / 2;
        $cy = $this->options->size / 2;

        $radius = (min($this->options->size, $this->options->size) / 2) - $maxExplodeDistance;

        $currentAngle = 0;
        $svg = '';

        /** @var Slice $slice */
        foreach ($this->data as $slice) {
            $sliceAngle = ($slice->value / $total) * 360;
            $currentAngle += $sliceAngle;
            $largeArcFlag = $sliceAngle > 180 ? 1 : 0;

            $midAngle = deg2rad($currentAngle - $sliceAngle / 2);
            $explodeX = $slice->explodeDistance * cos($midAngle);
            $explodeY = $slice->explodeDistance * sin($midAngle);

            $adjustedCx = $cx + $explodeX;
            $adjustedCy = $cy + $explodeY;

            $x1 = $adjustedCx + $radius * cos(deg2rad($currentAngle - $sliceAngle));
            $y1 = $adjustedCy + $radius * sin(deg2rad($currentAngle - $sliceAngle));
            $x2 = $adjustedCx + $radius * cos(deg2rad($currentAngle));
            $y2 = $adjustedCy + $radius * sin(deg2rad($currentAngle));

            $pathData = "M $adjustedCx,$adjustedCy L $x1,$y1 A $radius,$radius 0 $largeArcFlag,1 $x2,$y2 Z";

            $labelX = $adjustedCx + ($radius / 1.5) * cos($midAngle); // 1.5 factor to place label inside the slice
            $labelY = $adjustedCy + ($radius / 1.5) * sin($midAngle);

            $percentage = round(($slice->value / $total) * 100, 2);

            $svg .= $slice->render($pathData, $labelX, $labelY, $percentage);
        }

        return $svg;
    }
}
