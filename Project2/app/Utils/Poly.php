<?php

namespace App\Utils;


class Poly
{
    private array $categorizedMonos;
    private array $arrayOfPowers;

    public function __construct(array $expression = [])
    {
        $this->categorizedMonos = $expression;
        $this->categorize();
    }

    public function categorize()
    {
        $this->simplify();
        $this->sortByPowers();
    }

    public function setMonos(array $arrayOfMonos)
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

    public function toString(): string
    {
        $outputString = "";
        $this->categorize();
        foreach($this->categorizedMonos as &$mono){
            $outputString .= $mono;
        }
        return $outputString;
    }

    public function addMono(Mono $mono)
    {
        array_push($this->categorizedMonos, $mono);
    }

}
