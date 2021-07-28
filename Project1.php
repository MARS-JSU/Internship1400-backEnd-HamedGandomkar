<?php

function calculation($expression){
    $readyToEval = str_replace(['x'], [''], $expression);
    $result = eval("return $readyToEval;");
    if(is_numeric($result)){
        return "$result".'x';
    }
    return "nothing";
}

echo calculation("2.3x-5.5x+10x");
//Hamed Gandomkar
//1400.05.05


