<?php

namespace Challenges\Year2022\Day11;

abstract class WorryLevelOperation
{
    protected int $factor;

    public function __construct(int $factor)
    {
        $this->factor = $factor;
    }

    public function getFactor(): int
    {
        return $this->factor;
    }
}
