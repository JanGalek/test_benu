<?php declare(strict_types = 1);

namespace App\Utils\Math\PrimeNumber;

use App\Utils\Arrayable;

readonly class Table implements Arrayable
{

    /**
     * @param PrimeNumber[] $primeNumbers
     * @param Row[] $rows
     */
    public function __construct(public array $primeNumbers, public array $rows)
    {
    }

    /**
     * @return array<int, array<int, int>>
     */
    public function toArray(): array
    {
        $list = [];
        foreach ($this->rows as $row) {
            foreach ($row->lines as $line) {
                $list[$line->getPrimeNumber()->get()][$line->getMultiplyNumber()->get()] = $line->getNumber();
            }
        }

        return $list;
    }

}
