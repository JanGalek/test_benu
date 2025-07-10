<?php declare(strict_types = 1);

namespace App\Utils\Math\PrimeNumber;

readonly class PrimeNumber implements \JsonSerializable
{

    public function __construct(private int $number)
    {
    }

    public function get(): int
    {
        return $this->number;
    }

    public function multiply(PrimeNumber $primeNumber): int
    {
        return $this->number * $primeNumber->get();
    }

    public function jsonSerialize(): int
    {
         return $this->number;
    }

}
