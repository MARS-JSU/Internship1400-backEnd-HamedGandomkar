<?php
namespace App\Contracts;

interface PolyInterface{
    public function cleanup(): self;
    public function addMono(MonoInterface $mono);
    public function setMonos(array $arrayOfMonos): self;
    public function getMonos(): array;
}