<?php

namespace Challenges\Year2022\Day2;

enum Hand
{
    case ROCK;
    case PAPER;
    case SCISSORS;

    public static function createFromString(string $hand): self
    {
        return match ($hand) {
            'A', 'X' => Hand::ROCK,
            'B', 'Y' => Hand::PAPER,
            'C', 'Z' => Hand::SCISSORS,
        };
    }

    public function getScore(): int
    {
        return match ($this) {
            Hand::ROCK => 1,
            Hand::PAPER => 2,
            Hand::SCISSORS => 3,
        };
    }
}
