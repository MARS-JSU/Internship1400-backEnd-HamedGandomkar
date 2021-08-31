<?php

namespace App;

use App\Utils\Poly;
use App\Contracts\Types\PolyInterface;
use App\Contracts\Operations\OperationsInterface;
use App\Utils\MonoOperations;

class Operation implements OperationsInterface
{
    public static function calculateByX(PolyInterface $poly, $xVariable): float
    {
        $sum = 0;
        foreach ($poly->getMonos() as &$mono) {
            $sum += $mono->getCoffecent() * ($xVariable ** $mono->getPower());
        }
        return $sum;
    }

    public static function addition(PolyInterface $firstPoly, PolyInterface $secondPoly): Poly
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

    public static function subtraction(PolyInterface $firstPoly, PolyInterface $secondPoly): Poly
    {
        $outputPoly = new Poly();
        foreach($firstPoly->getMonos() as &$aMono){
            $outputPoly->addMono($aMono);
        }
        foreach($secondPoly->getMonos() as &$bMono){
            $outputPoly->addMono(MonoOperations::negative($bMono));
        }
        $outputPoly->cleanup();
        return $outputPoly;
    }

    public static function multiplication(PolyInterface $firstPoly, PolyInterface $secondPoly): Poly
    {
        $outputPoly = new Poly();
        foreach($firstPoly->getMonos() as &$aMono){
            foreach($secondPoly->getMonos() as &$bMono){
                $outputPoly->addMono(MonoOperations::multiplication($aMono, $bMono));
            }
        }
        return $outputPoly;
    }

    public static function derivative(PolyInterface $poly): Poly
    {
        $outputPoly = new Poly();
        foreach($poly->getMonos() as $mono){
            $outputPoly->addMono(MonoOperations::derivative($mono));
        }
        return $outputPoly;
    }
}
