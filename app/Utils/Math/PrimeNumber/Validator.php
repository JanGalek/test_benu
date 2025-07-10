<?php declare(strict_types = 1);

namespace App\Utils\Math\PrimeNumber;

class Validator implements IValidator
{

    public function validate(int $number): bool
    {
        if ($number === 2) {
            return true;
        }

        if ($number < 2 || $number % 2 === 0) {
            return false;
        }

        $rootNumber = (int) sqrt($number);

        for ($i = 3; $i <= $rootNumber; $i += 2) {
            $v = $number / $i;
            $f = fmod($v, 1.0);
            if (!is_float($v) && $f === 0.0) {
                return false;
            }
        }

        return true;
    }

}
