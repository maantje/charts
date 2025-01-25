<?php

namespace Maantje\Charts\SVG;

use Stringable;

class TextResizeableRect implements Stringable
{
    public function __construct(
        protected string $content,
        protected float $x = 0,
        protected float $y = 0,
        protected string $fontFamily = 'Arial',
        protected int $fontSize = 16,
        protected string $rectFill = 'black',
        protected string $rectStroke = 'none',
        protected int $rectStrokeWidth = 0,
        protected int $rectRx = 0,
        protected int $rectRy = 0,
        protected string $fill = 'white',
        public int $labelPaddingX = 20,
        public int $labelLeftMargin = 0,
        public int $labelTopMargin = 0,
        public string $textAnchor = 'middle'
    ) {}

    public function __toString(): string
    {
        $characterSize = $this->fontSize / 2.2;
        $characterHeight = $this->fontSize * 1.2;

        $rectWidth = mb_strwidth($this->content) * $characterSize + $this->labelPaddingX;
        $rectHeight = max(22, $characterHeight);

        $rectX = match ($this->textAnchor) {
            'start' => $this->x - $this->labelPaddingX / 2,
            'middle' => $this->x - $rectWidth / 2,
            default => throw new \RuntimeException("$this->textAnchor not implemented"),
        };

        $rectY = $this->y - $characterSize - $rectHeight / 2;

        return new Fragment([
            new Rect(
                x: $rectX,
                y: $rectY,
                width: $rectWidth,
                height: $rectHeight,
                fill: $this->rectFill,
                stroke: $this->rectStroke,
                strokeWidth: $this->rectStrokeWidth,
                rx: $this->rectRx,
                ry: $this->rectRy,
            ),
            new Text(
                content: $this->content,
                x: $this->x + $this->labelLeftMargin,
                y: $this->y + $this->labelTopMargin,
                fontFamily: $this->fontFamily,
                fontSize: $this->fontSize,
                fill: $this->fill,
                textAnchor: $this->textAnchor,
            ),
        ]);
    }
}
