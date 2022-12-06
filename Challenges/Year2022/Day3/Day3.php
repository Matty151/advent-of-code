<?php

namespace Challenges\Year2022\Day3;

use Challenges\Libraries\File;

class Day3
{
    private const ALPHABET = 'abcdefghijklmnopqrstuvwxyz';
    private const UPPERCASE_OFFSET = 26;

    public function part1()
    {
        $rucksacks = File::linesToArray(__DIR__ . '/rucksacks.txt');

        $commonItems = [];

        foreach ($rucksacks as $rucksack) {
            $middleIndex = strlen($rucksack) / 2;
            $firstCompartment = substr($rucksack, 0, $middleIndex);
            $secondCompartment = substr($rucksack, $middleIndex);

            $commonItem = $this->findCommonCharInStrings($firstCompartment, $secondCompartment);

            if (!empty($commonItem)) {
                $commonItems[] = $commonItem;
            }
        }

        $totalPriority = 0;

        foreach ($commonItems as $commonItem) {
            $totalPriority += $this->getItemPriority($commonItem);
        }

        var_dump($totalPriority);
    }

    public function part2()
    {
        $rucksacks = File::linesToArray(__DIR__ . '/rucksacks_2.txt');

        $rucksacksPerGroup = $this->groupRucksacks($rucksacks, 3);

        $badges = [];

        foreach ($rucksacksPerGroup as $rucksacks) {
            $badges[] = $this->findCommonCharInStrings(...$rucksacks);
        }

        var_dump(
            array_sum(
                array_map(function ($item) {
                    return $this->getItemPriority($item);
                }, $badges)
            )
        );
    }

    private function groupRucksacks(array $rucksacks, int $elvesPerGroup): array
    {
        $rucksacksPerGroup = [];

        $curGroupIndex = 0;

        for ($i = 0; $i < count($rucksacks); $i++) {
            if ($i % $elvesPerGroup == 0) {
                $curGroupIndex++;
            }

            $rucksacksPerGroup[$curGroupIndex][] = $rucksacks[$i];
        }

        return $rucksacksPerGroup;
    }

    private function findCommonCharInStrings(...$strings): ?string
    {
        foreach (str_split(array_shift($strings)) as $char) {
            if ($this->stringsContainChar($char, $strings)) {
                return $char;
            }
        }

        return null;
    }

    private function stringsContainChar(string $char, array $strings): bool
    {
        foreach ($strings as $string) {
            if (!str_contains($string, $char)) {
                return false;
            }
        }

        return true;
    }

    private function getItemPriority(mixed $commonItem): int
    {
        $priority = strpos(self::ALPHABET, strtolower($commonItem)) + 1;

        if ($this->stringIsUppercase($commonItem)) {
            $priority += self::UPPERCASE_OFFSET;
        }

        return $priority;
    }

    private function stringIsUppercase(mixed $commonItem): bool
    {
        return $commonItem == strtoupper($commonItem);
    }
}
