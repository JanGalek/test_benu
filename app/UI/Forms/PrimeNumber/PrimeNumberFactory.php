<?php declare(strict_types = 1);

namespace App\UI\Forms\PrimeNumber;

use App\Utils\Math\PrimeNumber\TableFactory;

class PrimeNumberFactory
{

    public function __construct(private TableFactory $tableFactory)
    {
    }

    public function create(): PrimeNumberControl
    {
        return new PrimeNumberControl($this->tableFactory);
    }

}
