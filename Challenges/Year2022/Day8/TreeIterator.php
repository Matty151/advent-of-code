<?php

namespace Challenges\Year2022\Day8;

interface TreeIterator
{
    public function getNext(): Tree;
    public function hasNext(): bool;
}
