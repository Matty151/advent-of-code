<?php

namespace Challenges\Year2022\Day7;

use Challenges\Libraries\File;

class Day7
{
    const MAX_DIRECTORY_SIZE = 100000;

    public function part1()
    {
        $disk = new Directory('c');
        $this->mountFilesystem($disk);

        $totalSize = 0;
        $iterator = $disk->getDirectory('/')->getBreadthFirstIterator();

        while ($iterator->hasNext()) {
            $node = $iterator->getNext();

            $size = $node->getSize();

            if ($size <= self::MAX_DIRECTORY_SIZE) {
                $totalSize += $size;
            }
        }

        var_dump($totalSize);
    }

    public function mountFilesystem(Directory $disk): Directory
    {
        $disk->addNode(new Directory('/'));

        $curDir = $disk;

        foreach (File::readLine(__DIR__ . '/input.txt') as $line) {
            if (str_contains($line, '$ ls')) {
                continue;
            }

            if (str_contains($line, '$ cd')) {
                $cdTo = substr($line, 5);

                if ($cdTo == '..') {
                    $curDir = $curDir->getParent();
                } else {
                    $curDir = $curDir->getNode($cdTo);
                }

                continue;
            }

            if (empty($curDir) || !($curDir instanceof Directory)) {
                die('Bruuuh dis should neva happen');
            }

            if ($this->isDir($line)) {
                $curDir->addNode(new Directory(substr($line, 4), $curDir));
            } elseif ($this->isFile($line)) {
                $file = new \Challenges\Year2022\Day7\File($this->getFilename($line), $this->getFilesize($line));

                $curDir->addNode($file);
            }
        }

        return $disk;
    }

    private function isCommand(string $line): bool
    {
        return preg_match('/^\$/', $line) == 1;
    }

    private function isDir(string $line): bool
    {
        return preg_match('/^dir/', $line) == 1;
    }

    private function isFile(string $line): bool
    {
        return preg_match('/^\d+/', $line) == 1;
    }

    private function getFilename(string $line): string
    {
        $matches = [];

        if (preg_match_all('/[^\s\d]+$/', $line, $matches) == 0) {
            return 0;
        }

        return $matches[0][0];
    }

    private function getFilesize(string $line): ?int
    {
        $matches = [];

        if (preg_match_all('/^\d+/', $line, $matches) == 0) {
            return 0;
        }

        return (int)$matches[0][0];
    }
}
