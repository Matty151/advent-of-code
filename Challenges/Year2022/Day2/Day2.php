<?php

namespace Challenges\Year2022\Day2;

use Challenges\Libraries\File;

class Day2
{
    public function run()
    {
        $strategies = File::linesToArray(__DIR__ . '/strategies.txt');

        $this->part1($strategies);

        printHr();

        $this->part2($strategies);
    }

    private function part1(array $strategies)
    {
        $games = [];

        foreach ($strategies as $strategy) {
            [$opponentsHandCode, $yourHandCode] = explode(' ', $strategy);

            $yourHand = Hand::createFromString($yourHandCode);
            $opponentsHand = Hand::createFromString($opponentsHandCode);

            $game = new RockPaperScissorsGame($yourHand, $opponentsHand);

            $games[] = [
                'game' => $game,
                'result' => $game->calculateResult(),
                'points' => $game->calculateScore(),
            ];
        }

        prettyPrintR(array_sum(array_column($games, 'points')));
    }

    private function part2(array $strategies)
    {
        $games = [];

        foreach ($strategies as $strategy) {
            [$opponentsHandCode, $desiredResultCode] = explode(' ', $strategy);

            $opponentsHand = Hand::createFromString($opponentsHandCode);
            $desiredResult = MatchResult::createFromString($desiredResultCode);
            $yourHand = $opponentsHand->getHandForDesiredResult($desiredResult);

            $game2 = new RockPaperScissorsGame($yourHand, $opponentsHand);

            $games[] = [
                'game' => $game2,
                'result' => $game2->calculateResult(),
                'points' => $game2->calculateScore(),
            ];
        }

        prettyPrintR(array_sum(array_column($games, 'points')));
    }
}
