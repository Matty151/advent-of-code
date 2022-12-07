<?php

namespace Challenges\Year2022\Day5;

class Stack
{
    /** @var Crate[] */
    protected array $items = [];

    public function add(Crate $item)
    {
        $this->items[] = $item;
    }

    public function pop(): Crate
    {
        return array_pop($this->items);
    }

    public function readFirst(): Crate
    {
        return $this->items[count($this->items) - 1];
    }
}
