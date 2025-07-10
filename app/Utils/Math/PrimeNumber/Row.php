<?php declare(strict_types = 1);

namespace App\Utils\Math\PrimeNumber;

class Row
{

    /**
     * @param Line[] $lines
     */
    public function __construct(public PrimeNumber $primeNumber {
        get {
            return $this->primeNumber;
        }
    }, public array $lines {
        get {
            return $this->lines;
        }
    })
    {
    }

}
