<?php

namespace Challenges\Year2022\Day10;

class CrtMonitor implements Module
{
    private const ROW_LENGTH = 40;

    private int $row = 0;
    private int $scanPos = 0;
    private int $imageCenterPos = 1;

    private array $pixels = [];

    public function startOfCycle(CPU6502 $cpu): void
    {
        $pixel = '.';

        if ($this->scanPos >= $this->imageCenterPos - 1 && $this->scanPos <= $this->imageCenterPos + 1) {
            $pixel = '#';
        }

        $this->pixels[$this->row][$this->scanPos] = $pixel;

        $this->scanPos++;

        if ($this->scanPos % self::ROW_LENGTH == 0) {
            $this->row++;
            $this->scanPos = 0;
        }
    }

    public function endOfCycle(CPU6502 $cpu): void
    {
        $this->imageCenterPos = $cpu->getX();
    }

    public function render(): void
    {
        foreach ($this->pixels as $row) {
            foreach ($row as $pixels) {
                echo $pixels;
            }

            echo PHP_EOL;
        }

        echo PHP_EOL;
    }
}
