<?php

namespace Challenges\Year2022\Day1;

use Challenges\Libraries\File;

class Day1
{
    private int $elfCounter = 0;

    public function run()
    {
        [
            $totalCaloriesPerElf,
            $elfWithMostCalories,
            $mostCalories,
        ] = $this->calculateTotals();

        prettyPrintR('Part 1');
        prettyPrintR("{$elfWithMostCalories} has food items with a total of {$mostCalories} calories.");

        printHr();

        prettyPrintR('Part 2');
        arsort($totalCaloriesPerElf, SORT_NUMERIC);

        $top3Elves = array_slice($totalCaloriesPerElf, 0, 3);

        foreach ($top3Elves as $elf => $totalCalories) {
            prettyPrintR("{$elf} has food items with a total of {$totalCalories} calories.");
        }

        printHr();

        prettyPrintR('Total of top 3: ' . array_sum($top3Elves));
    }

    private function calculateTotals(): array
    {
        $totalCaloriesPerElf = [];
        $elfWithMostCalories = '';
        $mostCalories = 0;

        $currentElfName = $this->getNextElfName();

        foreach (File::readLine(__DIR__ . '/calories.txt') as $line) {
            if (!array_key_exists($currentElfName, $totalCaloriesPerElf)) {
                $totalCaloriesPerElf[$currentElfName] = 0;
            }

            $calorie = trim($line);

            if (!empty($calorie)) {
                $totalCaloriesPerElf[$currentElfName] += (int)$calorie;
            } else {
                if ($totalCaloriesPerElf[$currentElfName] > $mostCalories) {
                    $elfWithMostCalories = $currentElfName;
                    $mostCalories = $totalCaloriesPerElf[$currentElfName];
                }

                $currentElfName = $this->getNextElfName();
            }
        }

        return [
            $totalCaloriesPerElf,
            $elfWithMostCalories,
            $mostCalories,
        ];
    }

    private function getNextElfName(): string
    {
        $this->elfCounter++;

        return "Elf {$this->elfCounter}";
    }
}
