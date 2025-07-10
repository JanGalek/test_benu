<?php declare(strict_types = 1);

namespace AppTests\Utils\Math;

use App\Utils\Math\PrimeNumber\Generator;
use App\Utils\Math\PrimeNumber\IValidator;
use App\Utils\Math\PrimeNumber\TableFactory;
use App\Utils\Math\PrimeNumber\Validator;
use PHPUnit\Framework\TestCase;

class TableTest extends TestCase
{

    protected Generator $generator;
    protected IValidator $validator;
    protected TableFactory $tableFactory;

    public function testTable(): void
    {
        $res = [
            2 => [
                2 => 4,
                3 => 6,
                5 => 10,
            ],
            3 => [
                2 => 6,
                3 => 9,
                5 => 15,
            ],
            5 => [
                2 => 10,
                3 => 15,
                5 => 25,
            ],
        ];
        $this->assertSame($res, $this->tableFactory->create(3)->toArray());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new Validator();
        $this->generator = new Generator($this->validator);
        $this->tableFactory = new TableFactory($this->generator);
    }

}
