<?php

namespace Challenges\Year2022\Day8;

class Tree
{
    public int $height = 0;

    /** @var Tree[] */
    public array $neighbours = [];

    public function __construct(int $height)
    {
        $this->height = $height;
    }

    public function getNeighbour(TreeNeighbourPosition $position): ?Tree
    {
        return $this->neighbours[$position->name] ?? null;
    }

    public function setNeighbour(TreeNeighbourPosition $position, Tree $tree)
    {
        $this->neighbours[$position->name] = $tree;
    }

    public function isTallerThan(Tree $other): bool
    {
        return $this->height > $other->height;
    }

    public function isVisible(): bool
    {
        if (!$this->isOnInside()) {
            return true;
        }

        foreach (TreeNeighbourPosition::cases() as $direction) {
            if ($this->isVisibleFromDirection($direction)) {
                return true;
            }
        }

        return false;
    }

    public function isVisibleFromDirection(TreeNeighbourPosition $direction): bool
    {
        $neighbour = $this->getNeighbour($direction);

        if (empty($neighbour)) {
            return true;
        }

        $iterator = new TraverseSingleDirectionTreeIterator($neighbour, $direction);

        while ($iterator->hasNext()) {
            $tree = $iterator->getNext();

            if (!$this->isTallerThan($tree)) {
                return false;
            }
        }

        return true;
    }

    public function isOnInside(): bool
    {
        return count(array_filter($this->neighbours)) == count(TreeNeighbourPosition::cases());
    }

    public function calculateScenicScore(): int
    {
        $scorePerDirection = [];



        return array_sum($scorePerDirection);
    }
}
