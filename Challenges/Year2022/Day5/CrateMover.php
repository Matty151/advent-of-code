<?php

namespace Challenges\Year2022\Day5;

abstract class CrateMover
{
    /** @var Stack[] */
    protected array $stacks;

    /**
     * @param Stack[] $stacks
     */
    public function __construct(array $stacks)
    {
        $this->stacks = $stacks;
    }

    public abstract function performMove(StackMove $move);

    /**
     * @return Crate[]
     */
    public function getTopCratesOfStacks(): array
    {
        return array_map(fn($stack) => $stack->readFirst(), $this->stacks);
    }
}
