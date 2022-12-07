<?php

namespace Challenges\Year2022\Day5;

class CrateMover9000 extends CrateMover
{
    public function performMoves()
    {
        foreach ($this->moves as $move) {
            $move->performMove();
        }
    }
}
