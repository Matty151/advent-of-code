<?php

namespace Challenges\Year2022\Day10;

use Challenges\Libraries\File;

class Day10
{
    public function part1()
    {
        $commands = File::linesToArray(__DIR__ . '/commands.txt');

        $cpu = new CPU6502($commands);

        $signalStrengths = [];

        while ($cpu->hasCommands()) {
            $cpu->step();

            $cycle = $cpu->getCycle();

            if ($cycle == 20 || ($cycle - 20) % 40 == 0) {
                var_dump("{$cycle}: {$cpu->getX()}");

                $signalStrengths[] = $cycle * $cpu->getX();
            }
        }

        print_r($signalStrengths);
        var_dump(array_sum($signalStrengths));
    }
}
