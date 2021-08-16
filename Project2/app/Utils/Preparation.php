<?php

namespace App\Utils;

class Preparation
{
    private string $wholeExpression;
    private array $arrayOfExpressions;
    private string $firstChar;

    public function __construct($expression)
    {
        $this->wholeExpression = $expression;
    }

    public function init()
    {
        $this->makeCoefficientOne();
        $this->handleFirstChar();
        $this->seperation();
        $this->prepare();
        $this->insertRemovedChar();
        return $this->arrayOfExpressions ?? new \Exception("uninitiated instance!");
    }

    private function handleFirstChar()
    {
        if ($this->wholeExpression[0] == '-') {
            $this->firstChar = '-';
            $this->wholeExpression = ltrim($this->wholeExpression, '-');
        } elseif ($this->wholeExpression[0] == '+') {
            $this->firstChar = '+';
            $this->wholeExpression = ltrim($this->wholeExpression, '+');
        } else {
            $this->firstChar = '+';
        }
    }

    private function insertRemovedChar()
    {
        if (isset($this->firstChar)) {
            $this->arrayOfExpressions[0] = $this->firstChar . $this->arrayOfExpressions[0];
        }
    }

    private function makeCoefficientOne()
    {
        $this->wholeExpression = str_replace(['-x', '+x'], ['-1x', '+1x'], $this->wholeExpression);
    }

    private function seperation()
    {
        $temp = str_replace(['+', '-'], [' +', ' -'], $this->wholeExpression);
        $this->arrayOfExpressions = explode(' ', $temp);
    }

    private function prepare()
    {
        foreach ($this->arrayOfExpressions as &$mono) {
            if (strpos($mono, 'x') === false) {
                $mono = $mono . "x^0";
            } elseif (strpos($mono, 'x^') === false) {
                $mono = $mono . "^1";
            }
        }
    }
}
