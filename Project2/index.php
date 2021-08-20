<?php

require "vendor/autoload.php";

use App\Operation;
use App\Utils\Poly;
use App\Utils\Preparation;

$prep1 = new Preparation("10x^2+3x+4");
$prep2 = new Preparation("2x^2+6x+6");
$poly1 = new Poly($prep1->init());
$poly2 = new Poly($prep2->init());

echo Operation::derivative($poly1)->toString();
echo "\n";
echo Operation::addition($poly1, $poly2)->toString();
echo "\n";
echo Operation::subtraction($poly1, $poly2)->toString();
echo "\n";
echo Operation::multiplication($poly1, $poly2)->toString();
echo "\n";
echo Operation::calculateByX($poly1, 2);

//var_dump($poly1);