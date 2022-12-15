<?php

namespace Challenges\Year2022\Day10;

use SplQueue;
use SplStack;

class CPU6502
{
    /** @var Module[] */
    private array $modules;

    private SplStack $xRegister;
    private SplStack $accumulator;
    private SplQueue $commands;

    private int $cycle = 1;

    public function __construct(array $commands, array $modules = [])
    {
        $this->modules = $modules;

        $this->xRegister = new SplStack();
        $this->xRegister->push(1);

        $this->accumulator = new SplStack();

        $this->commands = new SplQueue();

        foreach ($commands as $command) {
            if (str_contains($command, 'addx')) {
                $matches = [];
                preg_match('/-?\d+/', $command, $matches);
                $value = $matches[0];

                $this->commands->enqueue(new Command('ldx'));
                $this->commands->enqueue(new Command('adc', $value));
            } elseif (str_contains($command, 'noop')) {
                $this->commands->enqueue(new Command('noop'));
            }
        }
    }

    public function step(): void
    {
        $command = $this->commands->dequeue();

        foreach ($this->modules as $module) {
            $module->startOfCycle($this);
        }

        switch ($command->operation) {
            case 'ldx':
                $this->accumulator->push($this->getX());

                break;
            case 'adc':
                $this->accumulator->push($command->value);

                $num1 = $this->accumulator->pop();
                $num2 = $this->accumulator->pop();

                $this->xRegister->pop();
                $this->xRegister->push($num1 + $num2);

                break;
            case 'noop':
            default:
                break;
        }

        foreach ($this->modules as $module) {
            $module->endOfCycle($this);
        }

        $this->cycle++;
    }

    public function getCycle(): int
    {
        return $this->cycle;
    }

    public function getX(): mixed
    {
        return $this->xRegister->top();
    }

    public function hasCommands(): bool
    {
        return !$this->commands->isEmpty();
    }
}
