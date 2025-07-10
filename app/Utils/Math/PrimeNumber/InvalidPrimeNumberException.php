<?php declare(strict_types = 1);

namespace App\Utils\Math\PrimeNumber;

class InvalidPrimeNumberException extends \Exception
{

    public function __construct(int $number)
    {
        parent::__construct(sprintf('Number %d is not prime number', $number));
    }

}
