<?php
namespace App\Contracts\Ops;
use App\Contracts\Types\MonoInterface;
use App\Utils\Mono;

interface MonoOpsInterface{
    public static function negative(MonoInterface $mono): Mono;
    public static function derivative(MonoInterface $mono): Mono;
    public static function multiplication(MonoInterface $firstMono, MonoInterface $secondMono): Mono;
}