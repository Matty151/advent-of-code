<?php

namespace Challenges\Year2022\Day9;

use JetBrains\PhpStorm\Pure;

class Vector2d
{
    public int $x = 0;
    public int $y = 0;

    public function __construct(int $x = 0, int $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }

    #[Pure]
    public function plus(Vector2d $other): Vector2d
    {
        return new Vector2d($this->x + $other->x, $this->y + $other->y);
    }

    public function add(Vector2d $other): Vector2d
    {
        $this->x += $other->x;
        $this->y += $other->y;

        return $this;
    }

    #[Pure]
    public function minus(Vector2d $other): Vector2d
    {
        return (new Vector2d($this->x - $other->x, $this->y - $other->y));
    }

    public function subtract(Vector2d $other): Vector2d
    {
        $this->x -= $other->x;
        $this->y -= $other->y;

        return $this;
    }

    #[Pure]
    public function getMagnitude(): float
    {
        return sqrt(pow($this->x, 2) + pow($this->y, 2));
    }

    #[Pure]
    public function getAbsolute(): Vector2d
    {
        return new Vector2d(abs($this->x), abs($this->y));
    }

    public function __toString(): string
    {
        return "{$this->x},{$this->y}";
    }
}
