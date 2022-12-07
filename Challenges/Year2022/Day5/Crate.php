<?php

namespace Challenges\Year2022\Day5;

class Crate
{
    public string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
