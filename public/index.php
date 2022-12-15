<?php

require_once '../vendor/autoload.php';

function sign(int|float $number): int
{
    return $number <=> 0;
}

(new \Challenges\Year2022\Day10\Day10())->part1();
