<?php

namespace Challenges\Year2022\Day7;

abstract class Node
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public abstract function getSize(): int;
}
