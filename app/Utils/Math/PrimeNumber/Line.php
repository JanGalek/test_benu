<?php declare(strict_types = 1);

namespace App\Utils\Math\PrimeNumber;

class Line
{

    public function __construct(protected PrimeNumber $primeNumber, protected PrimeNumber $multiplyNumber)
    {
    }

    public function getPrimeNumber(): PrimeNumber
    {
        return $this->primeNumber;
    }

    public function getMultiplyNumber(): PrimeNumber
    {
        return $this->multiplyNumber;
    }

    public function getNumber(): int
    {
        return $this->primeNumber->multiply($this->multiplyNumber);
    }

}
