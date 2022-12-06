<?php

namespace Challenges\Year2022\Day4;

class Assignment
{
    public int $lowerBound;
    public int $upperBound;

    public function __construct(string $assignment)
    {
        [$this->lowerBound, $this->upperBound] = $this->getBoundsOfAssignment($assignment);
    }

    public function envelopes(Assignment $other): bool
    {
        return $other->lowerBound >= $this->lowerBound && $other->upperBound <= $this->upperBound;
    }

    public function overlapsWith(Assignment $other): bool
    {
        return
            (
                $other->lowerBound >= $this->lowerBound
                &&
                $other->lowerBound <= $this->upperBound
            )
            ||
            (
                $this->lowerBound >= $other->lowerBound
                &&
                $this->lowerBound <= $other->upperBound
            );
    }

    private function getBoundsOfAssignment(string $assignment): array
    {
        return array_map(function ($bound) {
            return (int)$bound;
        }, explode('-', $assignment));
    }
}
