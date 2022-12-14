<?php

namespace Challenges\Year2022\Day9;

class Knot
{
    public string $name = '';
    public Vector2D $position;
    public ?Knot $previous;
    public ?Knot $next;

    public function __construct(string $name, ?Knot $previous = null, ?Knot $next = null, Vector2D $position = new Vector2D())
    {
        $this->name = $name;
        $this->position = $position;
        $this->previous = $previous;
        $this->next = $next;
    }

    public function move(int $distance)
    {
        $diff = $this->previous->position->minus($this->position);

        if ($diff->getMagnitude() >= 2) {
            $move = $this->calculateMove($diff, $distance);

            $this->applyMove($move);

            if (!empty($this->next)) {
                $this->next->move($distance);
            }
        }
    }

    public function getTail(): Knot
    {
        if (empty($this->next)) {
            return $this;
        }

        return $this->next->getTail();
    }

    private function calculateMove(Vector2D $diff, int $distance): Vector2D
    {
        $absX = abs($diff->x);
        $absY = abs($diff->y);

        $stepX = sign($diff->x) * $distance;
        $stepY = sign($diff->y) * $distance;

        if ($absX == $absY && $absX == 2) {
            return $diff->minus(new Vector2D($stepX, $stepY));
        } elseif ($absX > $absY) {
            return new Vector2D($diff->x - $stepX, $diff->y);
        } else {
            return new Vector2D($diff->x, $diff->y - $stepY);
        }
    }

    private function applyMove(Vector2D $move)
    {
        $this->position->add($move);
    }
}
