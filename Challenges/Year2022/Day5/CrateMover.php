<?php

namespace Challenges\Year2022\Day5;

abstract class CrateMover
{
    /** @var Stack[] */
    protected array $stacks;

    /** @var StackMove[] */
    protected array $moves;

    /**
     * @param Stack[] $stacks
     * @param StackMove[] $moves
     */
    public function __construct(array $stacks, array $moves)
    {
        $this->stacks = $stacks;
        $this->moves = $moves;
    }

    public abstract function performMoves();

    /**
     * @return Crate[]
     */
    public function getTopCratesOfStacks(): array
    {
        return array_map(fn($stack) => $stack->readFirst(), $this->stacks);
    }
}
