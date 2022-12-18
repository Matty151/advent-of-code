<?php

require_once '../vendor/autoload.php';

function sign(int|float $number): int
{
    return $number <=> 0;
}

(new \Challenges\Year2022\Day11\Day11())->part1();
