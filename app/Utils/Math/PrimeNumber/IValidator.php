<?php declare(strict_types = 1);

namespace App\Utils\Math\PrimeNumber;

interface IValidator
{

    public function validate(int $number): bool;

}
