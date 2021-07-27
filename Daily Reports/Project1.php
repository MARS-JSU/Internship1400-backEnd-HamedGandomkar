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
echo polynominal("sdsdf");

// $splitByNegetive = explode("-", $b);
// $negetiveSum = 0;
// foreach ($splitByNegetive as $expression){
//     $positiveSum = 0;
//     $splitByPositive = explode('+', $expression);
//     foreach ($splitByPositive as $pexpression){
//         //echo "$pexpression\n";
//         $positiveSum += $pexpression;
//     }
//     $negetiveSum -= $positiveSum;
//     echo "$negetiveSum\n";
// }
// echo $negetiveSum;

