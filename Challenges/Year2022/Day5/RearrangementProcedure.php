<?php

namespace Challenges\Year2022\Day5;

class RearrangementProcedure
{
    private Stack $from;
    private Stack $to;
    private int $iterations;

    public function __construct(Stack $from, Stack $to, int $iterations)
    {
        $this->from = $from;
        $this->to = $to;
        $this->iterations = $iterations;
    }

    public function performProcedure()
    {
        for ($i = 0; $i < $this->iterations; $i++) {
            $this->to->add($this->from->pop());
        }
    }
}
