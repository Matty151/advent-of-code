<?php

namespace Challenges\Year2022\Day9;

class Rope
{
    private const STEP_SIZE = 1;

    private Knot $head;

    public function __construct(Knot $head)
    {
        $this->head = $head;
    }

    public function move(string $direction)
    {
        $this->head->position->add($this->calculateStep($direction));

        if (!empty($this->head->next)) {
            $this->head->next->move(self::STEP_SIZE);
        }
    }

    public function getTail(): Knot
    {
        return $this->head->getTail();
    }

    /**
     * @throws \Exception
     */
    private function calculateStep(string $direction): Vector2D
    {
        return match ($direction) {
            'U' => new Vector2D(0, self::STEP_SIZE),
            'R' => new Vector2D(self::STEP_SIZE, 0),
            'D' => new Vector2D(0, -self::STEP_SIZE),
            'L' => new Vector2D(-self::STEP_SIZE, 0),
            default => throw new \Exception("Direction {$direction} not supported."),
        };
    }
}
