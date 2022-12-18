<?php

namespace Challenges\Year2022\Day11\WorryLevelInspectionOperations;

use Challenges\Year2022\Day11\WorryLevelOperation;

abstract class WorryLevelInspectionOperation extends WorryLevelOperation
{
    public abstract function execute(int $input): int;
}
