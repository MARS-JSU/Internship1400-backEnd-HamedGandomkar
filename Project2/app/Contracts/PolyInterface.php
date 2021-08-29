<?php
namespace App\Contracts;
use App\Utils\Mono;

interface PolyInterface{
    public function cleanup(): self;
    public function addMono(Mono $mono);
    public function setMonos(array $arrayOfMonos): self;
    public function getMonos(): array;
}