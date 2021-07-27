<?php
$a = "3.5x-2x+3x";

function polynominal($expression){
    $readyToEval = str_replace(['x'], [''], $expression);
    $result = eval("return $readyToEval;");
    if(is_numeric($result)){
        return "$result".'x';
    }
    return "nothing";
}

//Hamed Gandomkar
//1400.05.05


