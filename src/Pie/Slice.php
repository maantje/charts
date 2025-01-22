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
        public string $label = '',
        public ?int $fontSize = null,
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
                fontFamily: $chart->fontFamily,
                fontSize: $this->fontSize ?? $chart->fontSize,
                fill: $this->labelColor,
                textAnchor: 'middle',
                dominantBaseline: 'middle',
            ),
        ]);
    }
}
