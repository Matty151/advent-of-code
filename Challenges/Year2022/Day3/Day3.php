<?php

namespace Challenges\Year2022\Day3;

use Challenges\Libraries\File;

class Day3
{
    private const ALPHABET = 'abcdefghijklmnopqrstuvwxyz';
    private const UPPERCASE_OFFSET = 26;

    public function run()
    {
        $rucksacks = File::linesToArray(__DIR__ . '/rucksacks.txt');

        $commonItems = [];

        foreach ($rucksacks as $rucksack) {
            $commonItem = $this->findCommonItem($rucksack);

            if (!empty($commonItem)) {
                $commonItems[] = $commonItem;
            }
        }

        $totalPriority = 0;

        foreach ($commonItems as $commonItem) {
            $priority = strpos(self::ALPHABET, strtolower($commonItem)) + 1;

            if ($this->stringIsUppercase($commonItem)) {
                $priority += self::UPPERCASE_OFFSET;
            }

            $totalPriority += $priority;
        }

        var_dump($totalPriority);
    }

    private function findCommonItem(string $rucksack): ?string
    {
        $middleIndex = strlen($rucksack) / 2;
        $firstCompartment = substr($rucksack, 0, $middleIndex);
        $secondCompartment = substr($rucksack, $middleIndex);

        foreach (str_split($firstCompartment) as $itemInFirstCompartment) {
            if (str_contains($secondCompartment, $itemInFirstCompartment)) {
                return $itemInFirstCompartment;
            }
        }

        return null;
    }

    public function stringIsUppercase(mixed $commonItem): bool
    {
        return $commonItem == strtoupper($commonItem);
    }
}
