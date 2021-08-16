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


    public function calculateByX($xVariable)
    {
        $sum = 0;
        foreach ($this->Poly->categorize() as &$mono) {
            $sum += $mono->getCoffecent() * ($xVariable ** $mono->getPower());
        }
        return $sum;
    }

    public function toString()
    {
        $outputString = "";
        foreach ($this->Poly->categorize() as &$mono) {
            $outputString .= $mono->display();
        }
        return $outputString;
    }

    public function addition(Poly $secondArg)
    {
        $this->Poly->append($secondArg)->categorize();
        return $this;
    }

    public function subtraction(Poly $secondArg)
    {
        $this->Poly->append($secondArg->negetivePoly())->categorize();
        return $this;
    }

    public function multiplication(Poly $secondArg)
    {
        $this->Poly->multiplication($secondArg);
        $this->Poly->categorize();
        return $this;
    }

    public function derivative()
    {
        $this->Poly->derivativePoly();
        return $this;
    }

    public function reset()
    {
        $this->Poly->reset();
        return $this;
    }
}
