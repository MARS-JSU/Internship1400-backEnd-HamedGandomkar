<?php

namespace App;

use App\Utils\Categorization;


class Operation
{
    private Categorization $categorization;

    public function __construct(Categorization $categor)
    {
        $this->categorization = $categor;
    }


    public function calculateByX($xVariable)
    {
        $sum = 0;
        foreach ($this->categorization->categorize() as &$mono) {
            $sum += $mono->getCoffecent() * ($xVariable ** $mono->getPower());
        }
        return $sum;
    }

    public function toString()
    {
        $outputString = "";
        foreach ($this->categorization->categorize() as &$mono) {
            $outputString .= $mono->display();
        }
        return $outputString;
    }

    public function addition(Categorization $secondArg)
    {
        $this->categorization->append($secondArg)->categorize();
        return $this;
    }

    public function subtraction(Categorization $secondArg)
    {
        $this->categorization->append($secondArg->negetivePoly())->categorize();
        return $this;
    }

    public function multiplication(Categorization $secondArg)
    {
        $this->categorization->multiplication($secondArg);
        $this->categorization->categorize();
        return $this;
    }

    public function derivative()
    {
        $this->categorization->derivativePoly();
        return $this;
    }

    public function reset()
    {
        $this->categorization->reset();
        return $this;
    }
}
