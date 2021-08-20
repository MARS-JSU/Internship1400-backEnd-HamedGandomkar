<?php

namespace App\Utils;


class Mono
{
    private $coffecent;
    private $power;

    public function __construct($coffecent, $power)
    {
        $this->coffecent = $coffecent;
        $this->power = $power;
    }

    public function __toString()
    {
        if ($this->power != -1) {
            if ($this->power == 1) {
                if ($this->coffecent > 0) {
                    return "+$this->coffecent" . "x";
                } else {
                    return "$this->coffecent" . "x";
                }
            } elseif ($this->power == 0) {
                if ($this->coffecent > 0) {
                    return "+$this->coffecent";
                } else {
                    return "$this->coffecent";
                }
            } else {
                if ($this->coffecent > 0) {
                    return "+$this->coffecent" . "x^" . "$this->power";
                } else {
                    return "$this->coffecent" . "x^" . "$this->power";
                }
            }
        }
        return "";
    }

    public function getPower(): int
    {
        return $this->power;
    }

    public function getCoffecent(): float
    {
        return $this->coffecent;
    }

    public function negative(): self
    {
        return new Mono(
            $this->coffecent * -1,
            $this->power
        );
    }

    public function derivative(): self
    {
        return new Mono(
            $this->coffecent * $this->power,
            $this->power - 1
        );
    }

    public function multiplication(self $secondMono): self
    {
        return new Mono(
            $this->getCoffecent() * $secondMono->getCoffecent(),
            $this->getPower() + $secondMono->getPower()
        );
    }
}
