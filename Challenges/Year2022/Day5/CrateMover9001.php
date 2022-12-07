<?php

namespace Challenges\Year2022\Day5;

class CrateMover9001 extends CrateMover
{
    public function performMove(Stack $from, Stack $to, int $amount)
    {
        $tempStack = new Stack();

        for ($i = 0; $i < $amount; $i++) {
            $tempStack->add($from->pop());
        }

        for ($i = 0; $i < $amount; $i++) {
            $to->add($tempStack->pop());
        }
    }
}
