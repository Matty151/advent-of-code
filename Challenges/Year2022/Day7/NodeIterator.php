<?php

namespace Challenges\Year2022\Day7;

interface NodeIterator
{
    public function getNext(): Node;
    public function hasNext(): bool;
}
