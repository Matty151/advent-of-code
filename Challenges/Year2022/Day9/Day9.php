<?php

namespace Challenges\Year2022\Day9;

use Challenges\Libraries\File;

class Day9
{
    public function part1()
    {
        $moves = $this->parseMoves();

        $rope = new Rope();

        $visitedPositions = [];

        foreach ($moves as $move) {
            [$direction, $distance] = $move;

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

    private function parseMoves(): array
    {
        $moves = [];

        foreach (File::readLine(__DIR__ . '/moves_small.txt') as $move) {
            $moves[] = explode(' ', $move);
        }

        return $moves;
    }
}
