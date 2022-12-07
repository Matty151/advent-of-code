<?php

namespace Challenges\Year2022\Day7;

class Directory extends Node
{
    /** @var Node[] */
    private array $nodes = [];

    private ?Node $parent;

    public function __construct(string $name, Node $parent = null)
    {
        parent::__construct($name);

        $this->parent = $parent;
    }

    public function getBreadthFirstIterator(): NodeIterator
    {
        return new BreadthFirstDirectoryIterator($this);
    }

    public function addNode(Node $node)
    {
        $this->nodes[$node->getName()] = $node;
    }

    public function getNode(string $dir): ?Node
    {
        return $this->nodes[$dir] ?? null;
    }

    /**
     * @return Node[]
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    public function getParent(): ?Node
    {
        return $this->parent;
    }

    public function getDirectory(string $dir): ?Directory
    {
        $node = $this->getNode($dir);

        if ($node instanceof Directory) {
            return $node;
        }

        return null;
    }

    /**
     * @return Directory[]
     */
    public function getChildDirectories(): array
    {
        return array_filter($this->nodes, fn($node) => $node instanceof Directory);
    }

    public function getSize(): int
    {
        $size = 0;

        foreach ($this->nodes as $node) {
            $size += $node->getSize();
        }

        return $size;
    }
}
