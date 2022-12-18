<?php

namespace Challenges\Year2022\Day11;

use Challenges\Year2022\Day11\WorryLevelTestOperations\WorryLevelTestOperation;
use Challenges\Year2022\Day11\WorryLevelInspectionOperations\WorryLevelInspectionOperation;

class Monkey
{
    private string $name;
    /** @var BackpackItem[] */
    private array $items;
    private WorryLevelInspectionOperation $operation;
    private WorryLevelTestOperation $testOperation;
    private Monkey $monkeyIfTrue;
    private Monkey $monkeyIfFalse;

    private int $nrOfInspections = 0;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function inspectItem(BackpackItem $item): void
    {
        $newWorryLevel = $this->operation->execute($item->getWorryLevel());

        $item->setWorryLevel($newWorryLevel);

        $this->nrOfInspections++;
    }

    public function testAndThrowItem(BackpackItem $item): void
    {
        $monkeyToThrowTo = $this->testOperation->test($item->getWorryLevel()) ? $this->monkeyIfTrue : $this->monkeyIfFalse;

        $this->throwItem($item, $monkeyToThrowTo);
    }

    public function throwItem(BackpackItem $item, Monkey $monkey): void
    {
        $this->removeItem($item);
        $monkey->addItem($item);
    }

    public function addItem(BackpackItem $item): void
    {
        $this->items[] = $item;
    }

    private function removeItem(BackpackItem $item): void
    {
        $key = array_search($item, $this->items);

        if ($key !== false) {
            unset($this->items[$key]);
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function getOperation(): WorryLevelInspectionOperation
    {
        return $this->operation;
    }

    public function setOperation(WorryLevelInspectionOperation $operation): void
    {
        $this->operation = $operation;
    }

    public function getTestOperation(): WorryLevelTestOperation
    {
        return $this->testOperation;
    }

    public function setTestOperation(WorryLevelTestOperation $testOperation): void
    {
        $this->testOperation = $testOperation;
    }

    public function setMonkeyIfTrue(Monkey $monkeyIfTrue): void
    {
        $this->monkeyIfTrue = $monkeyIfTrue;
    }

    public function setMonkeyIfFalse(Monkey $monkeyIfFalse): void
    {
        $this->monkeyIfFalse = $monkeyIfFalse;
    }

    public function getNrOfInspections(): int
    {
        return $this->nrOfInspections;
    }

    public function __toString(): string
    {
        return $this->getName() . ": " . implode(', ', $this->items);
    }
}
