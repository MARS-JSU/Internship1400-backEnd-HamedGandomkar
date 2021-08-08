<?php

class Preparation
{
    private string $wholeExpression;
    private array $arrayOfExpressions;
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

    public function handleFirstChar()
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

    public function insertRemovedChar()
    {       
        if(isset($this->firstChar)){
            $this->arrayOfExpressions[0] = $this->firstChar.$this->arrayOfExpressions[0];
        }
    }

    public function seperation()
    {
        $temp = str_replace(['+', '-'], [' +', ' -'], $this->wholeExpression);
        $this->arrayOfExpressions = explode(' ', $temp);  
    }

    public function prepare()
    {
        foreach($this->arrayOfExpressions as &$mono)
        {
            if(strpos($mono, 'x') === false){
                $mono = $mono."x^0";
            }
            elseif (strpos($mono, 'x^') === false){
                $mono = $mono."^1";
            } 
        }
    }

    public function getArrayOfExpressions()
    {
        return $this->arrayOfExpressions ?? new Exception("uninitiated instance!");
    }
}

$some = new Preparation("-3x^4-3.5x+3-4.5x^20+4.2x^10+243+234");
$some->init();
var_dump($some->getArrayOfExpressions());