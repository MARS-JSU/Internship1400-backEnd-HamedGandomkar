<?php

namespace App\Utils;


class Poly
{
    private array $monos;
    private array $categorizedMonos;
    private array $backupCategorizedMonos;
    private array $arrayOfPowers;

    public function __construct(Preparation $expression)
    {
        $this->monos = $expression->init();
        $this->packToMono();
    }

    public function categorize(): array
    {
        $this->simplify();
        $this->sortByPowers();
        return $this->categorizedMonos;
    }

    public function reset()
    {
        $this->categorizedMonos = $this->backupCategorizedMonos;
    }

    private function packToMono()
    {
        foreach ($this->monos as &$mono) {
            $temp = explode('x^', $mono);
            $temp[0] = (float)$temp[0];
            $temp[1] = (float)$temp[1];
            $this->categorizedMonos[] = new Mono($temp[0], $temp[1]);
            $this->backupCategorizedMonos[] = new Mono($temp[0], $temp[1]);
        }
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

    public function multiplication(self $anotherPoly)
    {
        $firstPoly = $this->categorize();
        $secondPoly = $anotherPoly->categorize();
        $resultPoly = [];
        foreach ($firstPoly as &$aMono) {
            foreach ($secondPoly as &$bMono) {
                $resultPoly[] = $aMono->multiplication($bMono);
            }
        }
        $this->categorizedMonos = $resultPoly;
    }

    public function append(self $categorationB): self
    {
        $this->categorizedMonos = array_merge(
            $this->categorizedMonos,
            $categorationB->categorize()
        );
        return $this;
    }

    public function negetivePoly(): self
    {
        foreach ($this->categorizedMonos as &$mono) {
            $mono->negetive();
        }
        return $this;
    }

    public function derivativePoly()
    {
        foreach ($this->categorizedMonos as &$mono) {
            $mono->derivative();
        }
    }
}
