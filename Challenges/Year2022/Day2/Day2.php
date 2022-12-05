<?php

namespace Challenges\Year2022\Day2;

use Challenges\Libraries\File;

class Day2
{
    public function run()
    {
        $strategies = File::linesToArray(__DIR__ . '/strategies.txt');

        $games = [];

        foreach ($strategies as $strategy) {
            $hands = explode(' ', $strategy);

            $firstHand = Hand::createFromString($hands[1]);
            $secondHand = Hand::createFromString($hands[0]);

            $game = (new RockPaperScissorsGame($firstHand, $secondHand));

            $games[] = [
                'game' => $game,
                'result' => $game->calculateResult(),
                'points' => $game->calculateScore(),
            ];
        }

        prettyPrintR(array_sum(array_column($games, 'points')));
    }
}
