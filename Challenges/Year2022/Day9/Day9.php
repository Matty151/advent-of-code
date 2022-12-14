<?php

namespace Challenges\Year2022\Day9;

use Challenges\Libraries\File;

class Day9
{
    public function part1()
    {
        $moves = File::linesToArray(__DIR__ . '/moves.txt');

        $rope = new Rope();

        $visitedPositions = [];

        foreach ($moves as $move) {
            [$direction, $distance] = explode(' ', $move);

            foreach (range(1, $distance) as $step) {
                $rope->step($direction);

                $tailPosition = $rope->getTailPosition();

                if (!array_key_exists((string)$tailPosition, $visitedPositions)) {
                    $visitedPositions[(string)$tailPosition] = $rope->getTailPosition();
                }
            }
        }

        var_dump(count($visitedPositions));
    }
}
