<?php

namespace Challenges\Libraries;

use Generator;

class File
{
    public static function readLine(string $path): Generator
    {
        $file = fopen($path, 'r');

        while (($line = fgets($file)) !== false) {
            yield $line;
        }
    }
}
