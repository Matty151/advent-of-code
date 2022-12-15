<?php

namespace Challenges\Year2022\Day10;

class Command
{
    public string $operation;
    public mixed $value;

    public function __construct(string $operation, mixed $value = null)
    {
        $this->operation = $operation;
        $this->value = $value;
    }
}
