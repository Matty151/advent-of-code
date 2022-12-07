<?php

namespace Challenges\Year2022\Day5;

class CrateMover9000 extends CrateMover
{
    public function performMove(Stack $from, Stack $to, int $amount)
    {
        for ($i = 0; $i < $amount; $i++) {
            $to->add($from->pop());
        }
    }
}
