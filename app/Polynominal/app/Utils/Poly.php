<?php

namespace App\Utils;

use App\Contracts\Types\MonoInterface;
use App\Contracts\Types\PolyInterface;
use App\Contracts\Shared\Stringable;

class Poly implements PolyInterface, Stringable
{
    private array $categorizedMonos;
    private array $arrayOfPowers;

    public function __construct(array $expression = [])
    {
        $this->categorizedMonos = $expression;
        $this->cleanup();
    }

    public function cleanup(): self
    {
        $this->simplify();
        $this->sortByPowers();
        return $this;
    }

    public function setMonos(array $arrayOfMonos): self
    {
        $this->categorizedMonos = $arrayOfMonos;
        return $this;
    }

    public function getMonos(): array
    {
        return $this->categorizedMonos;
    }

    private function uniqePowers()
    {
        $allPowers = [];
        foreach ($this->categorizedMonos as &$mono) {
            $allPowers[] = $mono->getPower();
        }
        $this->arrayOfPowers = array_unique($allPowers, SORT_NUMERIC);
    }

    private function simplify()
    {
        $newCategorized = [];
        $this->uniqePowers();
        foreach ($this->arrayOfPowers as &$power) {
            $coffecentSum = 0;
            foreach ($this->categorizedMonos as $mono) {
                if ($mono->getPower() == $power) {
                    $coffecentSum += $mono->getCoffecent();
                }
            }
            $newCategorized[] = new Mono($coffecentSum, $power);
        }
        $this->categorizedMonos = $newCategorized;
    }

    private function sortByPowers()
    {
        rsort($this->arrayOfPowers, SORT_NUMERIC);
        $newCategorized = [];
        foreach ($this->arrayOfPowers as &$power) {
            foreach ($this->categorizedMonos as &$mono) {
                if ($mono->getPower() == $power) {
                    $newCategorized[] = $mono;
                }
            }
        }
        $this->categorizedMonos = $newCategorized;
    }

    public function __toString(): string
    {
        $outputString = "";
        foreach($this->categorizedMonos as &$mono){
            $outputString .= $mono;
        }
        return $outputString;
    }

    public function addMono(MonoInterface $mono)
    {
        array_push($this->categorizedMonos, $mono);
    }

}
