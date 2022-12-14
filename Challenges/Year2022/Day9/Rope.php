<?php

namespace Challenges\Year2022\Day9;

class Rope
{
    private const STEP_SIZE = 1;

    private Vector2d $headPosition;
    private Vector2d $tailPosition;

    public function __construct(Vector2d $headPosition = new Vector2d(), Vector2d $tailPosition = new Vector2d())
    {
        $this->headPosition = $headPosition;
        $this->tailPosition = $tailPosition;
    }

    /**
     * @throws \Exception
     */
    public function step(string $direction): void
    {
        $this->headPosition->add($this->calculateStep($direction));

        $diff = $this->headPosition->minus($this->tailPosition);

        if ($diff->getMagnitude() >= 2) {
            if (abs($diff->x) > abs($diff->y)) {
                $diff->x -= sign($diff->x);
            } else {
                $diff->y -= sign($diff->y);
            }

            $this->tailPosition->add($diff);
        }
    }

    /**
     * @throws \Exception
     */
    private function calculateStep(string $direction): Vector2d
    {
        return match ($direction) {
            'U' => new Vector2d(0, self::STEP_SIZE),
            'R' => new Vector2d(self::STEP_SIZE, 0),
            'D' => new Vector2d(0, -self::STEP_SIZE),
            'L' => new Vector2d(-self::STEP_SIZE, 0),
            default => throw new \Exception("Direction {$direction} not supported."),
        };
    }

    public function getHeadPosition(): Vector2d
    {
        return $this->headPosition;
    }

    public function getTailPosition(): Vector2d
    {
        return $this->tailPosition;
    }
}
