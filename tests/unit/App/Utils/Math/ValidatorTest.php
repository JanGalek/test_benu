<?php declare(strict_types = 1);

namespace AppTests\Utils\Math;

use App\Utils\Math\PrimeNumber\IValidator;
use App\Utils\Math\PrimeNumber\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{

    protected IValidator $validator;

    public function testValidate(): void
    {
        self::assertFalse($this->validator->validate(1));
        self::assertTrue($this->validator->validate(2));
        self::assertTrue($this->validator->validate(3));
        self::assertFalse($this->validator->validate(4));
        self::assertTrue($this->validator->validate(5));
        self::assertFalse($this->validator->validate(6));
        self::assertTrue($this->validator->validate(7));
        self::assertFalse($this->validator->validate(8));
        self::assertFalse($this->validator->validate(9));
        self::assertFalse($this->validator->validate(10));
        self::assertTrue($this->validator->validate(11));
        self::assertFalse($this->validator->validate(12));
        self::assertTrue($this->validator->validate(13));
        self::assertFalse($this->validator->validate(14));
        self::assertFalse($this->validator->validate(15));
        self::assertFalse($this->validator->validate(16));
        self::assertTrue($this->validator->validate(17));
        self::assertFalse($this->validator->validate(18));
        self::assertTrue($this->validator->validate(19));
        self::assertFalse($this->validator->validate(20));
    }

    public function testValidateNotPrimeNumbers(): void
    {
        self::assertFalse($this->validator->validate(1));
        self::assertFalse($this->validator->validate(4));
        self::assertFalse($this->validator->validate(6));
        self::assertFalse($this->validator->validate(8));
        self::assertFalse($this->validator->validate(9));
        self::assertFalse($this->validator->validate(10));
        self::assertFalse($this->validator->validate(12));
        self::assertFalse($this->validator->validate(14));
        self::assertFalse($this->validator->validate(15));
        self::assertFalse($this->validator->validate(16));
        self::assertFalse($this->validator->validate(18));
        self::assertFalse($this->validator->validate(20));
    }

    public function testValidatePrimeNumbers(): void
    {
        self::assertTrue($this->validator->validate(2));
        self::assertTrue($this->validator->validate(3));
        self::assertTrue($this->validator->validate(5));
        self::assertTrue($this->validator->validate(7));
        self::assertTrue($this->validator->validate(11));
        self::assertTrue($this->validator->validate(13));
        self::assertTrue($this->validator->validate(17));
        self::assertTrue($this->validator->validate(19));
        self::assertTrue($this->validator->validate(23));
        self::assertTrue($this->validator->validate(29));
        self::assertTrue($this->validator->validate(31));
        self::assertTrue($this->validator->validate(37));
        self::assertTrue($this->validator->validate(41));
        self::assertTrue($this->validator->validate(43));
        self::assertTrue($this->validator->validate(47));
        self::assertTrue($this->validator->validate(53));
        self::assertTrue($this->validator->validate(59));
        self::assertTrue($this->validator->validate(61));
        self::assertTrue($this->validator->validate(67));
        self::assertTrue($this->validator->validate(71));
        self::assertTrue($this->validator->validate(73));
        self::assertTrue($this->validator->validate(79));
        self::assertTrue($this->validator->validate(83));
        self::assertTrue($this->validator->validate(89));
        self::assertTrue($this->validator->validate(97));
        self::assertTrue($this->validator->validate(101));
        self::assertTrue($this->validator->validate(103));
        self::assertTrue($this->validator->validate(109));
        self::assertTrue($this->validator->validate(113));
        self::assertTrue($this->validator->validate(127));
        self::assertTrue($this->validator->validate(131));
        self::assertTrue($this->validator->validate(137));
        self::assertTrue($this->validator->validate(139));
        self::assertTrue($this->validator->validate(149));
        self::assertTrue($this->validator->validate(151));
        self::assertTrue($this->validator->validate(157));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new Validator();
    }

}
