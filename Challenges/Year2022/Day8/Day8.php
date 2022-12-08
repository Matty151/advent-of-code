<?php

namespace Challenges\Year2022\Day8;

use Challenges\Libraries\File;

class Day8
{
    public function part1()
    {
        $treeHeights = $this->parseTreeInto2dArray();
        $trees = $this->getTrees($treeHeights);

        $visibleTrees = [];

        $iterator = new InsideTreesScanner($trees[0][0]);

        while ($iterator->hasNext()) {
            $tree = $iterator->getNext();

            if ($tree->isVisible()) {
                $visibleTrees[] = $tree;
            }
        }

        $nrOfRows = count($trees);
        $nrOfCols = count($trees[0]);
        $nrOfTreesOnEdge = ($nrOfRows * 2) + (($nrOfCols - 2) * 2);

        var_dump($nrOfTreesOnEdge + count($visibleTrees));
    }

    public function part2()
    {
        $treeHeights = $this->parseTreeInto2dArray();
        $trees = $this->getTrees($treeHeights);
    }

    private function parseTreeInto2dArray(): array
    {
        $treeHeights = File::linesToArray(__DIR__ . '/trees.txt');

        foreach ($treeHeights as &$treeRowString) {
            $treeRowString = str_split($treeRowString);
        }

        return $treeHeights;
    }

    /**
     * @return Tree[][]
     */
    public function getTrees(array $treeHeights): array
    {
        /** @var Tree[][] $trees */
        $trees = [];

        for ($rowI = 0; $rowI < count($treeHeights[0]); $rowI++) {
            $treeRow = $treeHeights[$rowI];

            for ($colI = 0; $colI < count($treeRow); $colI++) {
                if (empty($trees[$rowI][$colI])) {
                    $trees[$rowI][$colI] = new Tree($treeRow[$colI]);
                }

                $curTree = $trees[$rowI][$colI];

                // Has top
                if ($rowI > 0) {
                    $topTree = $trees[$rowI - 1][$colI];

                    $curTree->setNeighbour(TreeNeighbourPosition::TOP, $topTree);
                    $topTree->setNeighbour(TreeNeighbourPosition::BOTTOM, $curTree);
                }

                // Has left
                if ($colI > 0) {
                    $leftTree = $trees[$rowI][$colI - 1];

                    $curTree->setNeighbour(TreeNeighbourPosition::LEFT, $leftTree);
                    $leftTree->setNeighbour(TreeNeighbourPosition::RIGHT, $curTree);
                }
            }
        }

        return $trees;
    }
}
