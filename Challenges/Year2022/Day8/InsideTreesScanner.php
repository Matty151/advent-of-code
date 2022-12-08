<?php

namespace Challenges\Year2022\Day8;

class InsideTreesScanner implements TreeIterator
{
    private ?Tree $startTree;

    /** @var Tree[] */
    private array $queue = [];

    public function __construct(Tree $topLeftTree)
    {
        $this->startTree = $topLeftTree
            ->getNeighbour(TreeNeighbourPosition::RIGHT)
            ->getNeighbour(TreeNeighbourPosition::BOTTOM);
        $this->enqueueTrees();
    }

    public function getNext(): Tree
    {
        $nextTree = array_shift($this->queue);

        if (!$this->hasNext()) {
            $this->startTree = $this->startTree->getNeighbour(TreeNeighbourPosition::BOTTOM);

            if (!empty($this->startTree)) {
                $this->enqueueTrees();
            }
        }

        return $nextTree;
    }

    public function hasNext(): bool
    {
        return !empty($this->queue);
    }

    private function enqueueTrees()
    {
        $iterator = new TraverseSingleDirectionTreeIterator($this->startTree, TreeNeighbourPosition::RIGHT);

        while ($iterator->hasNext()) {
            $tree = $iterator->getNext();

            if ($tree->isOnInside()) {
                $this->queue[] = $tree;
            }
        }
    }
}
