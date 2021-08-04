<?php

class Expression
{
    private $expression;
    private $number;
    private $power;
    public function __construct($expression)
    {
        $this->expression = $expression;
        $this->number = floatval($expression);
        $this->power = substr($expression, $this->getOffset()+1);
        
    }
    
    private function getOffset()
    {
        $offset = 0;
        for($i=0; $i<4; $i++)
        {
            if(is_numeric($this->expression[$i]))
            {
                $offset = $i;
            }
        }
        return $offset;
    }
    
    public function getNumberPart(){
        return $this->number;
    }
    public function getPowerPart()
    {
        return $this->power;
    }
}


class PolyNominal{
    private $expression;
    public function __construct($expression)
    {
        $this->expression = $expression;
    }
    
    public function calculateByX($x)
    {
        $copied_expression = $this->expression;
        
        for($i=2; $i<10; $i++)
        {
            $to_be_replaced = "x^$i";
            if(str_contains($copied_expression, $to_be_replaced))
            {
                $copied_expression = 
                        str_replace($to_be_replaced, "*pow($x, $i)", $copied_expression);
            }
        }
        $copied_expression = str_replace('x', "*$x", $copied_expression);
        
        $result = eval("return $copied_expression ;");
        if(is_numeric($result))
            return $result;
        else
            throw new Exception("Not a valid expression");    
    }
    
}