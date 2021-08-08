<?php

class Preparation
{
    private string $wholeExpression;
    private array $arrayOfMonos;
    private $firstChar;
    public function __construct($expression)
    {
        $this->wholeExpression = $expression;
    }

    public function init(){
        $this->handleFirstChar();
        $this->seperation();
        $this->prepare();
        $this->insertRemovedChar();
    }

    private function handleFirstChar()
    {
        if($this->wholeExpression[0] == '-'){
            $this->firstChar = '-';
            $this->wholeExpression = ltrim($this->wholeExpression, '-');
        }

        elseif($this->wholeExpression[0] == '+'){
            $this->firstChar = '+';
            $this->wholeExpression = ltrim($this->wholeExpression, '+');
        }
        else{
            $this->firstChar = '+';
        }
    }

    private function insertRemovedChar(){       
        $this->arrayOfMonos[0] = $this->firstChar.$this->arrayOfMonos[0];
    }

    private function seperation()
    {
        $temp = str_replace(['+', '-'], [' +', ' -'], $this->wholeExpression);
        $this->arrayOfMonos = explode(' ', $temp);  
    }

    private function prepare()
    {
        foreach($this->arrayOfMonos as &$mono)
        {
            if(strpos($mono, 'x') === false){
                $mono = $mono."x^0";
            }
            elseif (strpos($mono, 'x^') === false){
                $mono = $mono."^1";
            } 
        }
    }

    public function getarrayOfMonos()
    {
        return $this->arrayOfMonos ?? new Exception("Uninitiated instance!");
    }
}

$some = new Preparation("-3x^4-3.5x+3-4.5x^20+4.2x^10+243+234");
$some->init();
var_dump($some->getarrayOfMonos());