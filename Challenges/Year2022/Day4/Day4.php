<?php

namespace Challenges\Year2022\Day4;

use Challenges\Libraries\File;

class Day4
{
    public function part1()
    {
        $assignmentPairs = File::linesToArray(__DIR__ . '/assignment_pairs.txt');

        $totalEnvelopes = 0;

        foreach ($assignmentPairs as $pair) {
            $assignments = explode(',', $pair);

            $elf1 = new Assignment($assignments[0]);
            $elf2 = new Assignment($assignments[1]);

            if ($elf1->envelopes($elf2) || $elf2->envelopes($elf1)) {
                $totalEnvelopes++;
            }
        }

        var_dump($totalEnvelopes);
    }

    public function part2()
    {
        $assignmentPairs = File::linesToArray(__DIR__ . '/assignment_pairs.txt');

        $totalOverlaps = 0;

        foreach ($assignmentPairs as $pair) {
            $assignments = explode(',', $pair);

            $elf1 = new Assignment($assignments[0]);
            $elf2 = new Assignment($assignments[1]);

            if ($elf1->overlapsWith($elf2)) {
                $totalOverlaps++;
            }
        }

        var_dump($totalOverlaps);
    }
}
