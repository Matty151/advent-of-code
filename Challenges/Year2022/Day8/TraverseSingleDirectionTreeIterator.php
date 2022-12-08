<?php

namespace Challenges\Year2022\Day8;

class TraverseSingleDirectionTreeIterator implements TreeIterator
{
    private ?Tree $next;
    private TreeNeighbourPosition $direction;

    public function __construct(Tree $tree, TreeNeighbourPosition $direction)
    {
        $this->next = $tree;
        $this->direction = $direction;
    }

    public function getNext(): Tree
    {
        $next = $this->next;

        $this->next = $next->getNeighbour($this->direction);

        return $next;
    }

    public function hasNext(): bool
    {
        return !empty($this->next);
    }
}
