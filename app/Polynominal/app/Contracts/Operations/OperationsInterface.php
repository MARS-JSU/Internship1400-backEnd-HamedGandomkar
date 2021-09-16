<?php
namespace App\Contracts\Operations;
use App\Contracts\Types\PolyInterface;
use App\Utils\Poly;

interface OperationsInterface{
    public static function calculateByX(PolyInterface $poly, $xVariable): float;
    public static function addition(PolyInterface $firstPoly, PolyInterface $secondPoly): Poly;
    public static function subtraction(PolyInterface $firstPoly, PolyInterface $secondPoly): Poly;
    public static function multiplication(PolyInterface $firstPoly, PolyInterface $secondPoly): Poly;
    public static function derivative(PolyInterface $poly): Poly;
}