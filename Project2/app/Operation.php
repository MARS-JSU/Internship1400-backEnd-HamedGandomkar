<?php

namespace App;

use App\Utils\Poly;


class Operation
{
    public static function calculateByX(Poly $poly, $xVariable): float
    {
        $sum = 0;
        foreach ($poly->getMonos() as &$mono) {
            $sum += $mono->getCoffecent() * ($xVariable ** $mono->getPower());
        }
        return $sum;
    }

    public static function addition(Poly $firstPoly, Poly $secondPoly): Poly
    {
        $outputPoly = new Poly();
        foreach($firstPoly->getMonos() as &$aMono){
            $outputPoly->addMono($aMono);
        }
        foreach($secondPoly->getMonos() as &$bMono){
            $outputPoly->addMono($bMono);
        }
        $outputPoly->categorize();
        return $outputPoly;
    }

    public static function subtraction(Poly $firstPoly, Poly $secondPoly): Poly
    {
        $outputPoly = new Poly();
        foreach($firstPoly->getMonos() as &$aMono){
            $outputPoly->addMono($aMono);
        }
        foreach($secondPoly->getMonos() as &$bMono){
            $outputPoly->addMono($bMono->negative());
        }
        $outputPoly->categorize();
        return $outputPoly;
    }

    public static function multiplication(Poly $firstPoly, Poly $secondPoly): Poly
    {
        $monos = [];
        $outputPoly = new Poly();
        foreach($firstPoly->getMonos() as &$aMono){
            foreach($secondPoly->getMonos() as &$bMono){
                $monos[] = $aMono->multiplication($bMono);
            }
        }
        $outputPoly->setMonos($monos)->categorize();
        return $outputPoly;
    }

    public static function derivative(Poly $poly): Poly
    {
        $monos = [];
        $outputPoly = new Poly();
        foreach($poly->getMonos() as $mono){
            $monos[] = $mono->derivative();
        }
        $outputPoly->setMonos($monos)->categorize();
        return $outputPoly;
    }

}
