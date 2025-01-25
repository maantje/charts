<?php

namespace Maantje\Charts\Pie;

use Closure;
use Maantje\Charts\SVG\Rect;

class PieChart
{
    public Closure $formatter;

    /**
     * @param  Slice[]  $slices
     */
    public function __construct(
        protected int $size = 400,
        protected array $slices = [],
        public ?string $background = 'white',
        public int $fontSize = 14,
        public string $fontFamily = 'arial',
        ?Closure $formatter = null
    ) {
        $this->formatter = $formatter ?? fn (string $label, float $percentage) => "$label - $percentage%";
    }

    public function render(): string
    {
        return <<<SVG
            <svg width="$this->size" height="$this->size" xmlns="http://www.w3.org/2000/svg">
                {$this->background()}
                {$this->renderSlices()}
            </svg>
            SVG;
    }

    protected function renderSlices(): string
    {
        if (empty($this->slices)) {
            return '';
        }

        $total = array_sum(array_map(fn ($data) => $data->value, $this->slices));

        if ($total === 0.0) {
            return '';
        }

        $maxExplodeDistance = max(array_map(fn ($data) => $data->explodeDistance, $this->slices));
        $cx = $this->size / 2;
        $cy = $this->size / 2;

        $radius = ($this->size / 2) - $maxExplodeDistance;

        $currentAngle = 0;
        $svg = '';

        foreach ($this->slices as $slice) {
            if ($slice->value <= 0) {
                continue;
            }

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

            $labelX = $adjustedCx + ($radius / 1.5) * cos($midAngle);
            $labelY = $adjustedCy + ($radius / 1.5) * sin($midAngle);

            $percentage = round(($slice->value / $total) * 100, 2);

            $svg .= $slice->render($this, $pathData, $labelX, $labelY, $percentage);
        }

        if (count($this->slices) === 1) {
            $slice = $this->slices[0];
            $pathData = "M $cx,$cy m -$radius,0 a $radius,$radius 0 1,0 ".(2 * $radius).",0 a $radius,$radius 0 1,0 -".(2 * $radius).',0 Z';

            $labelX = $cx;
            $labelY = $cy - ($radius / 2);

            $percentage = 100;

            $svg = $slice->render($this, $pathData, $labelX, $labelY, $percentage);
        }

        return $svg;
    }

    protected function background(): string
    {
        if (is_null($this->background)) {
            return '';
        }

        return new Rect(
            width: $this->size,
            height: $this->size,
            fill: $this->background,
        );
    }
}
