<?php

namespace App;

use App\Utils\Poly;


class Operation
{
    private Poly $poly;

    public function __construct(Poly $categor)
    {
        $this->poly = $categor;
    }


    public function calculateByX($xVariable): float
    {
        $sum = 0;
        foreach ($this->poly->categorize() as &$mono) {
            $sum += $mono->getCoffecent() * ($xVariable ** $mono->getPower());
        }
        return $sum;
    }

    public function toString(): string
    {
        $outputString = "";
        foreach ($this->poly->categorize() as &$mono) {
            $outputString .= $mono->display();
        }
        return $outputString;
    }

    public function addition(Poly $secondArg): self
    {
        $this->poly->append($secondArg)->categorize();
        return $this;
    }

    public function subtraction(Poly $secondArg): self
    {
        $this->poly->append($secondArg->negetivePoly())->categorize();
        return $this;
    }

    public function multiplication(Poly $secondArg): self
    {
        $this->poly->multiplication($secondArg);
        $this->poly->categorize();
        return $this;
    }

    public function derivative(): self
    {
        $this->poly->derivativePoly();
        return $this;
    }

    public function reset(): self
    {
        $this->poly->reset();
        return $this;
    }
}
