<?php

namespace Maantje\Charts\Pie;

use Maantje\Charts\SVG\Fragment;
use Maantje\Charts\SVG\Path;
use Maantje\Charts\SVG\Text;

readonly class Slice
{
    public function __construct(
        public float $value,
        public string $color,
        public string $label,
        public int $labelSize = 12,
        public string $labelColor = '#000',
        public float $explodeDistance = 0.0,
    ) {}

    public function render(PieChart $chart, string $pathData, float $labelX, float $labelY, float $percentage): string
    {
        $labelText = $chart->formatter->call($chart, $this->label, $percentage);

        return new Fragment([
            new Path(
                d: $pathData,
                fill: $this->color,
            ),
            new Text(
                content: $labelText,
                x: $labelX,
                y: $labelY,
                fontSize: $this->labelSize,
                fill: $this->labelColor,
                textAnchor: 'middle',
                dominantBaseline: 'middle',
            ),
        ]);
    }
}
