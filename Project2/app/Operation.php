<?php

namespace App;

use App\Utils\Poly;


class Operation
{
    private Poly $Poly;

    public function __construct(Poly $categor)
    {
        $this->Poly = $categor;
    }


    public function calculateByX($xVariable): float
    {
        $sum = 0;
        foreach ($this->Poly->categorize() as &$mono) {
            $sum += $mono->getCoffecent() * ($xVariable ** $mono->getPower());
        }
        return $sum;
    }

    public function toString(): string
    {
        $outputString = "";
        foreach ($this->Poly->categorize() as &$mono) {
            $outputString .= $mono->display();
        }
        return $outputString;
    }

    public function addition(Poly $secondArg): self
    {
        $this->Poly->append($secondArg)->categorize();
        return $this;
    }

    public function subtraction(Poly $secondArg): self
    {
        $this->Poly->append($secondArg->negetivePoly())->categorize();
        return $this;
    }

    public function multiplication(Poly $secondArg): self
    {
        $this->Poly->multiplication($secondArg);
        $this->Poly->categorize();
        return $this;
    }

    public function derivative(): self
    {
        $this->Poly->derivativePoly();
        return $this;
    }

    public function reset(): self
    {
        $this->Poly->reset();
        return $this;
    }
}
