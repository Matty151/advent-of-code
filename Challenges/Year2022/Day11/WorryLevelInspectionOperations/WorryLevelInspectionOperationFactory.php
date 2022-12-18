<?php

namespace Challenges\Year2022\Day11\WorryLevelInspectionOperations;

use Exception;

abstract class WorryLevelInspectionOperationFactory
{
    /**
     * @throws Exception
     */
    public static function make(string $operation, ?string $input = null): WorryLevelInspectionOperation
    {
        if ($input == 'old') {
            return new PowerOperation(2);
        }

        return match ($operation) {
            '*' => new Multiplication((int)$input),
            '+' => new Addition((int)$input),
            default => throw new Exception("Operation \"{$operation}\" not supported."),
        };
    }
}
