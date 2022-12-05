<?php

namespace Challenges\Year2022\Day2;

enum Hand
{
    case ROCK;
    case PAPER;
    case SCISSORS;

    public static function createFromString(string $hand): Hand
    {
        return match ($hand) {
            'A', 'X' => Hand::ROCK,
            'B', 'Y' => Hand::PAPER,
            'C', 'Z' => Hand::SCISSORS,
        };
    }

    public function getHandForDesiredResult(MatchResult $desiredResult): Hand
    {
        return match ($this) {
            Hand::ROCK => match ($desiredResult) {
                MatchResult::LOSS => Hand::SCISSORS,
                MatchResult::DRAW => Hand::ROCK,
                MatchResult::WIN => Hand::PAPER,
            },
            Hand::PAPER => match ($desiredResult) {
                MatchResult::LOSS => Hand::ROCK,
                MatchResult::DRAW => Hand::PAPER,
                MatchResult::WIN => Hand::SCISSORS,
            },
            Hand::SCISSORS => match ($desiredResult) {
                MatchResult::LOSS => Hand::PAPER,
                MatchResult::DRAW => Hand::SCISSORS,
                MatchResult::WIN => Hand::ROCK,
            },
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
