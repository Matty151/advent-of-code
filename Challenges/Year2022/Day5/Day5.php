<?php

namespace Challenges\Year2022\Day5;

use Challenges\Libraries\File;

class Day5
{
    public function part1()
    {
        $stacks = $this->createStacks();
        $procedures = $this->generateProcedures($stacks);

        foreach ($procedures as $procedure) {
            $procedure->performProcedure();
        }

        $topCrates = array_map(fn($stack) => $stack->readFirst(), $stacks);
        $crateValues = array_map(fn($crate) => $crate->value, $topCrates);

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
     * @return RearrangementProcedure[]
     */
    private function generateProcedures(array $stacks): array
    {
        $proceduresRaw = File::linesToArray(__DIR__ . '/procedures.txt');

        $procedures = [];

        foreach ($proceduresRaw as $procedureString) {
            $numbers = [];

            preg_match_all('/\d+/', $procedureString, $numbers);

            $numbers = $numbers[0];

            $procedures[] = new RearrangementProcedure(
                $stacks[(int)$numbers[1] - 1],
                $stacks[(int)$numbers[2] - 1],
                (int)$numbers[0],
            );
        }

        return $procedures;
    }
}
