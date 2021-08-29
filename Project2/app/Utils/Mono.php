<?php

namespace App\Utils;
use App\Contracts\MonoInterface;

class Mono implements MonoInterface
{
    private float $coffecent;
    private int $power;

    public function __construct($coffecent, $power)
    {
        $this->coffecent = $coffecent;
        $this->power = $power;
    }

    public function __toString()
    {
        if ($this->power > 0 || $this->coffecent != 0) {
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
}
