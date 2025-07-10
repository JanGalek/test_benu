<?php declare(strict_types = 1);

namespace App\Utils\Math\PrimeNumber;

readonly class TableFactory
{

    public function __construct(private Generator $generator)
    {
    }

    public function create(int $size): Table
    {
        $primeNumbers = $this->generator->generate($size);

        $rows = [];

        foreach ($primeNumbers as $primeNumber) {
            $lines = [];
            foreach ($primeNumbers as $multiplyPrimeNumber) {
                $lines[] = new Line($primeNumber, $multiplyPrimeNumber);
            }

            $rows[] = new Row($primeNumber, $lines);
        }

        return new Table($primeNumbers, $rows);
    }

}
