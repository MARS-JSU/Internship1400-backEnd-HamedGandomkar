<?php

namespace App;

use App\Utils\Poly;
use App\Utils\MonoOps;

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
        $outputPoly->cleanup();
        return $outputPoly;
    }

    public static function subtraction(Poly $firstPoly, Poly $secondPoly): Poly
    {
        $outputPoly = new Poly();
        foreach($firstPoly->getMonos() as &$aMono){
            $outputPoly->addMono($aMono);
        }
        foreach($secondPoly->getMonos() as &$bMono){
            $outputPoly->addMono(MonoOps::negative($bMono));
        }
        $outputPoly->cleanup();
        return $outputPoly;
    }

    public static function multiplication(Poly $firstPoly, Poly $secondPoly): Poly
    {
        $outputPoly = new Poly();
        foreach($firstPoly->getMonos() as &$aMono){
            foreach($secondPoly->getMonos() as &$bMono){
                $outputPoly->addMono(MonoOps::multiplication($aMono, $bMono));
            }
        }
        return $outputPoly;
    }

    public static function derivative(Poly $poly): Poly
    {
        $outputPoly = new Poly();
        foreach($poly->getMonos() as $mono){
            $outputPoly->addMono(MonoOps::derivative($mono));
        }
        return $outputPoly;
    }

}
