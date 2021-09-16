<?php

namespace App\Utils;

use App\Contracts\Types\AnalyzerInterface;

class Analyzer implements AnalyzerInterface
{
    private string $rawString;
    private array $strings;
    private array $arrayOfMonos;

    public function __construct(string $expression)
    {
        $this->rawString = $expression;
    }

    public function init()
    {
        $this->makeCoefficientOne();
        $this->seperation();
        $this->analyzer();
        $this->packToMono();
        return $this->arrayOfMonos;
    }


    private function makeCoefficientOne()
    {
        $this->rawString = str_replace(['-x', '+x'], ['-1x', '+1x'], $this->rawString);
    }

    private function seperation()
    {
        $temp = str_replace(['+', '-'], [' +', ' -'], $this->rawString);
        if($temp[0] == ' '){
            $temp = ltrim($temp, ' ');
        }
        $this->strings = explode(' ', $temp);
    }
    
    private function analyzer()
    {
        foreach ($this->strings as &$mono) {
            if (strpos($mono, 'x') === false) {
                $mono = $mono . "x^0";
            } elseif (strpos($mono, 'x^') === false) {
                $mono = $mono . "^1";
            }
        }
    }

    private function packToMono()
    {
        $generatedMonos = [];
        foreach ($this->strings as &$mono) {
            $temp = explode('x^', $mono);
            $temp[0] = (float)$temp[0];
            $temp[1] = (float)$temp[1];
            $generatedMonos[] = new Mono($temp[0], $temp[1]);
        }
        $this->arrayOfMonos = $generatedMonos;
    }
}
