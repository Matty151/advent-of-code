<?php

namespace Challenges\Year2022\Day2;

enum MatchResult
{
    case LOSS;
    case DRAW;
    case WIN;

    public static function createFromString(string $matchResult): MatchResult
    {
        return match ($matchResult) {
            'X' => MatchResult::LOSS,
            'Y' => MatchResult::DRAW,
            'Z' => MatchResult::WIN,
        };
    }

    public function getScore(): int
    {
        return match ($this) {
            MatchResult::LOSS => 0,
            MatchResult::DRAW => 3,
            MatchResult::WIN => 6,
        };
    }
}
