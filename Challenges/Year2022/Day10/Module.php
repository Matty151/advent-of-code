<?php

namespace Challenges\Year2022\Day10;

interface Module
{
    public function startOfCycle(CPU6502 $cpu): void;
    public function endOfCycle(CPU6502 $cpu): void;
}
