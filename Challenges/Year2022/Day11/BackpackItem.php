<?php

namespace Challenges\Year2022\Day11;

class BackpackItem
{
    private int $worryLevel;

    public function __construct(int $worryLevel)
    {
        $this->worryLevel = $worryLevel;
    }

    public function getWorryLevel(): int
    {
        return $this->worryLevel;
    }

    public function setWorryLevel(int $worryLevel): void
    {
        $this->worryLevel = $worryLevel;
    }

    public function __toString(): string
    {
        return $this->worryLevel;
    }
}
