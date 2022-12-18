<?php

namespace Challenges\Year2022\Day11\WorryLevelInspectionOperations;

class PowerOperation extends WorryLevelInspectionOperation
{
    public function execute(int $input): int
    {
        return pow($input, $this->factor);
    }
}
