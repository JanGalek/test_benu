<?php declare(strict_types = 1);

namespace AppTests\Utils\Math;

use App\Utils\Math\PrimeNumber\Generator;
use App\Utils\Math\PrimeNumber\IValidator;
use App\Utils\Math\PrimeNumber\PrimeNumber;
use App\Utils\Math\PrimeNumber\Validator;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{

    protected Generator $generator;
    protected IValidator $validator;

    public function testList(): void
    {
        $cases = [
            [
                'value' => 3,
                'expected' => [2, 3, 5],
            ],
            [
                'value' => 6,
                'expected' => [2, 3, 5, 7, 11, 13],
            ],
            [
                'value' => 8,
                'expected' => [2, 3, 5, 7, 11, 13, 17, 19],
            ],
            [
                'value' => 11,
                'expected' => [2, 3, 5, 7, 11, 13, 17, 19, 23, 29, 31],
            ],
        ];

        foreach ($cases as $case) {
            $this->assertEquals(
                $case['expected'],
                array_map(fn (PrimeNumber $n) => $n->get(), $this->generator->generate($case['value']))
            );
        }
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new Validator();
        $this->generator = new Generator($this->validator);
    }

}
