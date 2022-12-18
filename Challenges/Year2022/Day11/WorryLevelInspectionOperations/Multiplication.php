<?php

namespace Challenges\Year2022\Day11\WorryLevelInspectionOperations;

class Multiplication extends WorryLevelInspectionOperation
{
    public function execute(int $input): int
    {
        return $input * $this->factor;
    }
}
