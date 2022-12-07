<?php

namespace Challenges\Year2022\Day5;

use Challenges\Libraries\File;

class Day5
{
    public function part1()
    {
        $stacks = $this->createStacks();
        $moves = $this->createMoves($stacks);
        $crateMover = new CrateMover9000($stacks);

        foreach ($moves as $move) {
            $crateMover->performMove($move[0], $move[1], $move[2]);
        }

        $crateValues = array_map(fn($crate) => $crate->value, $crateMover->getTopCratesOfStacks());

        var_dump(implode('', $crateValues));
    }

    /**
     * @return Stack[]
     */
    private function createStacks(): array
    {
        $cratesPerStack = File::linesToArray(__DIR__ . '/stacks.txt');

        $stacks = [];

        foreach ($cratesPerStack as $crates) {
            $stack = new Stack();

            foreach (explode(',', $crates) as $crate) {
                $stack->add(new Crate($crate));
            }

            $stacks[] = $stack;
        }

        return $stacks;
    }

    /**
     * @param Stack[] $stacks
     */
    private function createMoves(array $stacks): array
    {
        $proceduresRaw = File::linesToArray(__DIR__ . '/moves.txt');

        $procedures = [];

        foreach ($proceduresRaw as $procedureString) {
            $numbers = [];

            preg_match_all('/\d+/', $procedureString, $numbers);

            $numbers = $numbers[0];

            $procedures[] = [
                $stacks[(int)$numbers[1] - 1],
                $stacks[(int)$numbers[2] - 1],
                (int)$numbers[0],
            ];
        }

        return $procedures;
    }
}
