<?php

namespace Challenges\Year2022\Day7;

class BreadthFirstDirectoryIterator implements NodeIterator
{
    /** @var Directory[] */
    private array $queue = [];

    public function __construct(Directory $node)
    {
        $this->queue[] = $node;
    }

    public function getNext(): Node
    {
        $next = array_shift($this->queue);

        foreach ($next->getChildDirectories() as $childNode) {
            $this->queue[] = $childNode;
        }

        return $next;
    }

    public function hasNext(): bool
    {
        return !empty($this->queue);
    }
}
