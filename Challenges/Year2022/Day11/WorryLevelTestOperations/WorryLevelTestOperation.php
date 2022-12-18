<?php

namespace Challenges\Year2022\Day11\WorryLevelTestOperations;

use Challenges\Year2022\Day11\WorryLevelOperation;

abstract class WorryLevelTestOperation extends WorryLevelOperation
{
    public abstract function test(int $input): bool;
}
