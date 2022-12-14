<?php

namespace Challenges\Year2022\Day9;

use Challenges\Libraries\File;

class Day9
{
    public function part1()
    {
        $rope = $this->createRope(1);
        $tail = $rope->getTail();

        $visitedPositions = [];

        foreach ($this->parseMoves() as $index => $move) {
            [$direction, $distance] = $move;

            foreach (range(1, $distance) as $step) {
                $rope->move($direction);

                $tailPosition = $tail->position;

                if (!array_key_exists((string)$tailPosition, $visitedPositions)) {
                    $visitedPositions[(string)$tailPosition] = $tailPosition;
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

    private function createRope(int $amountOfKnots): Rope
    {
        $head = new Knot('head');

        $prevKnot = $head;

        foreach (range(1, $amountOfKnots) as $index) {
            $knot = new Knot("Knot-{$index}", $prevKnot);
            $prevKnot->next = $knot;

            $prevKnot = $knot;
        }

        return new Rope($head);
    }
}
