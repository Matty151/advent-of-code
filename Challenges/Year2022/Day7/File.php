<?php

namespace Challenges\Year2022\Day7;

class File extends Node
{
    private int $size;

    public function __construct(string $name, int $size)
    {
        parent::__construct($name);

        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size;
    }
}
