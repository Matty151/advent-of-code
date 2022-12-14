<?php

namespace Challenges\Year2022\Day1;

use Challenges\Libraries\File;

class Day1
{
    public function run()
    {
        $totalCaloriesPerElf = $this->calculateTotals();

        $elfWithMostCalories = array_key_first($totalCaloriesPerElf);
        $mostCalories = $totalCaloriesPerElf[$elfWithMostCalories];

        var_dump('Part 1');
        var_dump("Elf {$elfWithMostCalories} has food items with a total of {$mostCalories} calories.");

        var_dump('Part 2');

        $top3Elves = array_slice($totalCaloriesPerElf, 0, 3, true);

        foreach ($top3Elves as $elf => $totalCalories) {
            var_dump("Elf {$elf} has food items with a total of {$totalCalories} calories.");
        }

        var_dump('Total of top 3: ' . array_sum($top3Elves));
    }

    private function calculateTotals(): array
    {
        $totalCaloriesPerElf = [];

        $currentElf = 1;

        foreach (File::readLine(__DIR__ . '/calories.txt') as $line) {
            if (!array_key_exists($currentElf, $totalCaloriesPerElf)) {
                $totalCaloriesPerElf[$currentElf] = 0;
            }

            $calorie = trim($line);

            if (!empty($calorie)) {
                $totalCaloriesPerElf[$currentElf] += (int)$calorie;
            } else {
                $currentElf++;
            }
        }

        arsort($totalCaloriesPerElf, SORT_NUMERIC);

        return $totalCaloriesPerElf;
    }
}
