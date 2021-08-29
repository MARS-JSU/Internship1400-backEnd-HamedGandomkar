<?php
namespace App\Utils;
use App\Contracts\MonoInterface;
use App\Utils\Mono;

class MonoOps{
    public static function negative(MonoInterface $mono): Mono
    {
        return new Mono(
            $mono->getCoffecent() * -1,
            $mono->getPower()
        );
    }

    public static function derivative(MonoInterface $mono): Mono
    {
        return new Mono(
            $mono->getCoffecent() * $mono->getPower(),
            $mono->getPower() - 1
        );
    }

    public static function multiplication(MonoInterface $firstMono, MonoInterface $secondMono): Mono
    {
        return new Mono(
            $firstMono->getCoffecent() * $secondMono->getCoffecent(),
            $firstMono->getPower() + $secondMono->getPower()
        );
    }
}