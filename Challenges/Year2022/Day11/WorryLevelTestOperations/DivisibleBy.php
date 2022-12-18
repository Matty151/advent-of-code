<?php

namespace Challenges\Year2022\Day11\WorryLevelTestOperations;

class DivisibleBy extends WorryLevelTestOperation
{
    public function test(int $input): bool
    {
        return $input % $this->factor == 0;
    }
}
