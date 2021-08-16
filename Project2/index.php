<?php

require "vendor/autoload.php";

use App\Operation;
use App\Utils\Poly;
use App\Utils\Preparation;

$prepare = new Preparation("2x^2");
$prepare2 = new Preparation("3x^3+4x+2");
$categorized = new Poly($prepare);
$categorized2 = new Poly($prepare2);

$operate = new Operation($categorized2);
echo $operate->multiplication($categorized)->toString();
echo "\n";
echo $operate->reset()->derivative()->toString();
echo "\n";
echo $operate->reset()->addition($categorized)->toString();
echo "\n";
echo $operate->reset()->subtraction($categorized)->toString();


