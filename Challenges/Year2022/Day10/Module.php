<?php

namespace Challenges\Year2022\Day10;

interface Module
{
    public function startCycleHook(CPU6502 $cpu): void;
    public function endCycleHook(CPU6502 $cpu): void;
}
