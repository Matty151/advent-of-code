<?php

namespace Challenges\Year2022\Day11;

use Challenges\Libraries\File;
use Challenges\Year2022\Day11\WorryLevelInspectionOperations\WorryLevelInspectionOperationFactory;
use Challenges\Year2022\Day11\WorryLevelTestOperations\DivisibleBy;
use Exception;

class Day11
{
    const LINES_PER_MONKEY = 7;
    const NUMBER_OF_ROUNDS = 10000; // Set to 10000 for part 2

    public function part1()
    {
        $monkeys = $this->parseMonkeys();

        $commonDivider = array_product(array_map(fn($monkey) => $monkey->getTestOperation()->getFactor(), $monkeys));

        foreach (range(1, self::NUMBER_OF_ROUNDS) as $round) {
            foreach ($monkeys as $monkeyIndex => $monkey) {
                foreach ($monkey->getItems() as $item) {
                    $monkey->inspectItem($item);
//                    $item->setWorryLevel(floor($item->getWorryLevel() / 3)); // Comment out for part 2
                    $monkey->testAndThrowItem($item);
                    $item->setWorryLevel($item->getWorryLevel() % $commonDivider); // Uncomment for part 2
                }
            }
        }

        $inspections = array_map(fn($monkey) => $monkey->getNrOfInspections(), $monkeys);

        rsort($inspections, SORT_NUMERIC);

        print_r($inspections);
        var_dump(array_product(array_slice($inspections, 0, 2)));
    }

    /**
     * @return Monkey[]
     * @throws Exception
     */
    private function parseMonkeys(): array
    {
        $monkeyLines = File::linesToArray(__DIR__ . '/monkeys.txt');

        $monkeys = [];

        $curMonkeyIndex = 0;

        foreach ($monkeyLines as $index => $monkeyLine) {
            if ($index == 0 || $index % self::LINES_PER_MONKEY == 0) {
                $monkeys[$curMonkeyIndex] = new Monkey("Monkey {$curMonkeyIndex}");
                $curMonkeyIndex++;
            }
        }

        $curMonkeyIndex = 0;
        $monkey = $monkeys[$curMonkeyIndex];

        foreach ($monkeyLines as $index => $line) {
            if ($index == 0) {
                continue;
            }

            if ($index % self::LINES_PER_MONKEY == 0) {
                $curMonkeyIndex++;
                $monkey = $monkeys[$curMonkeyIndex];

                continue;
            }

            $startOfMonkeyIndex = $curMonkeyIndex * self::LINES_PER_MONKEY;

            if ($index == $startOfMonkeyIndex + 1) {
                $matches = [];
                preg_match_all('/\d+/', $line, $matches);

                $monkey->setItems(array_map(fn($worryLevel) => new BackpackItem($worryLevel), $matches[0]));
            } elseif ($index == $startOfMonkeyIndex + 2) {
                $operationString = explode('new = ', $line)[1];
                $operands = explode(' ', $operationString);

                $monkey->setOperation(WorryLevelInspectionOperationFactory::make($operands[1], $operands[2]));
            } elseif ($index == $startOfMonkeyIndex + 3) {
                $matches = [];
                preg_match('/\d+$/', $line, $matches);

                $monkey->setTestOperation(new DivisibleBy($matches[0]));
            } elseif ($index == $startOfMonkeyIndex + 4) {
                $matches = [];
                preg_match('/\d+$/', $line, $matches);

                $monkey->setMonkeyIfTrue($monkeys[$matches[0]]);
            } elseif ($index == $startOfMonkeyIndex + 5) {
                $matches = [];
                preg_match('/\d+$/', $line, $matches);

                $monkey->setMonkeyIfFalse($monkeys[$matches[0]]);
            }
        }

        return $monkeys;
    }

    private function printMonkeys(array $monkeys): void
    {
        echo implode(PHP_EOL, $monkeys);
        echo PHP_EOL;
        echo PHP_EOL;
    }
}
