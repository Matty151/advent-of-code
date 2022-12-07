<?php

namespace Challenges\Year2022\Day6;

class Day6
{
    public function part1()
    {
        $signal = file_get_contents(__DIR__ . '/signal.txt');

        var_dump($this->detectStartOfMessageMarker($signal, 4));
        var_dump($this->detectStartOfMessageMarker($signal, 14));
    }

    public function detectStartOfMessageMarker(string $signal, int $packetMarkerSize): int
    {
        $charBuffer = '';

        foreach (str_split($signal) as $index => $char) {
            $charBuffer .= $char;

            if ($index >= $packetMarkerSize - 1) {
                if ($this->stringIsUnique($charBuffer)) {
                    return $index + 1;
                } else {
                    $charBuffer = substr($charBuffer, 1);
                }
            }
        }

        return 0;
    }

    private function stringIsUnique(string $string): bool
    {
        $chars = str_split($string);

        return count(array_unique($chars)) == count($chars);
    }
}
