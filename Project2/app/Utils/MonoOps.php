<?php
namespace App\Utils;

use App\Utils\Mono;

class MonoOps{
    public static function negative(Mono $mono): Mono
    {
        return new Mono(
            $mono->getCoffecent() * -1,
            $mono->getPower()
        );
    }

    public static function derivative(Mono $mono): Mono
    {
        return new Mono(
            $mono->getCoffecent() * $mono->getPower(),
            $mono->getPower() - 1
        );
    }

    public static function multiplication(Mono $firstMono, Mono $secondMono): Mono
    {
        return new Mono(
            $firstMono->getCoffecent() * $secondMono->getCoffecent(),
            $firstMono->getPower() + $secondMono->getPower()
        );
    }
}