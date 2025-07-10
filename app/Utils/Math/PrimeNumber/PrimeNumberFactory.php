<?php declare(strict_types = 1);

namespace App\Utils\Math\PrimeNumber;

class PrimeNumberFactory
{

    public function __construct(private IValidator $validator)
    {
    }

    /**
     * @throws InvalidPrimeNumberException
     */
    public function create(int $number): PrimeNumber
    {
        if ($this->validator->validate($number)) {
            return new PrimeNumber($number);
        }

        throw new InvalidPrimeNumberException($number);
    }

}
