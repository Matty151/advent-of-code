<?php

namespace Challenges\Libraries;

use Generator;

class File
{
    public static function linesToArray(string $path): array
    {
        if (!file_exists($path)) {
            return [];
        }

        return array_filter(explode("\n", file_get_contents($path)));
    }

    public static function readLine(string $path): Generator
    {
        $file = fopen($path, 'r');

        while (($line = fgets($file)) !== false) {
            yield trim($line);
        }
    }
}
