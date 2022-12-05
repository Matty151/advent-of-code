<?php

namespace Challenges\Year2022\Day2;

class RockPaperScissorsGame
{
    private Hand $firstHand;
    private Hand $secondHand;

    public function __construct(Hand $firstHand, Hand $secondHand)
    {
        $this->firstHand = $firstHand;
        $this->secondHand = $secondHand;
    }

    public function calculateResult(): MatchResult
    {
        return match ($this->firstHand) {
            Hand::ROCK => match ($this->secondHand) {
                Hand::ROCK => MatchResult::DRAW,
                Hand::PAPER => MatchResult::LOSS,
                Hand::SCISSORS => MatchResult::WIN,
            },
            Hand::PAPER => match ($this->secondHand) {
                Hand::ROCK => MatchResult::WIN,
                Hand::PAPER => MatchResult::DRAW,
                Hand::SCISSORS => MatchResult::LOSS,
            },
            Hand::SCISSORS => match ($this->secondHand) {
                Hand::ROCK => MatchResult::LOSS,
                Hand::PAPER => MatchResult::WIN,
                Hand::SCISSORS => MatchResult::DRAW,
            },
        };
    }

    public function calculateScore(): int
    {
        return $this->calculateResult()->calculateScore() + $this->firstHand->getScore();
    }
}
